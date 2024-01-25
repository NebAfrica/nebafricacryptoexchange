<?php

namespace App\Http\Controllers\GateWays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\ManualDepositMethod;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use Paystack;


class PaystackController extends Controller
{
    //get paystack payment index
    public function index()
    {
        if (session()->has('amount') && session()->has('method_id') && session()->has('converted_amount')) {
            $page_title = 'Pay With PayStack';
            $amount = session()->get('amount');
            $method_id = session()->get('method_id');
            $converted_amount = session()->get('converted_amount');
            $payment_method = ManualDepositMethod::where('id', $method_id)->first();
            $currency = session()->get('currency');
            $charge = session()->get('charge');
            return view('themes.' . websiteInfo('theme') . '.user.payment.gateways.paystack', compact(
                'page_title',
                'amount',
                'converted_amount',
                'payment_method',
                'currency',
                'charge'

            ));
        } else {
            return redirect(route('user.deposit.new'))->with('fail', 'Please select payment method first');
        }
    }


    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function pay()
    {
        $converted_amount = round(session()->get('converted_amount'), 2);
        try {

            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->with('fail', 'The paystack token has expired. Please refresh the page and try again.');
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function callback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $reference = $paymentDetails['data']['reference'];
        $paid = ($paymentDetails['data']['amount'] / 100);

        //check if transaction reference exists before and the payment amount matches 
        $transaction_reference = Deposit::where('txn_id', $reference)->first();

        if (!$transaction_reference && $paid == round(session()->get('converted_amount'), 2)) {
            // Save Deposit data into the database
            $deposit = new Deposit();
            $deposit->user_id = user('id');
            $deposit->amount = session()->get('amount');
            $deposit->converted_amount = round(session()->get('converted_amount'), 2);
            $deposit->currency = paymentCurrency('paystack');
            $deposit->charge = session()->get('charge');
            $deposit->method = 'Paystack';
            $deposit->status  = 'approved';
            $deposit->txn_id = $reference;
            $deposit->additional_info = 'Your Payment was successful. Here is your transaction Id: ' . $reference;
            $deposit->save();

            //Credit depositor

            $credit_amount = round(session()->get('amount'), websiteInfo('decimal_places'));
            $new_bal = (user('account_bal') + $credit_amount);
            $credit_depositor = User::find(user('id'));
            $credit_depositor->account_bal = $new_bal;
            $credit_depositor->save();

            //record transaction                             
            recordNewTransaction(user('id'), 'credit', $credit_amount,  'Deposit', $new_bal, 'Paystack Deposit');

            //credit referrer
            if (websiteInfo('ref_bonus') > 0) {
                $referrer = User::where('account_id', user('referred_by'))->first();

                if ($referrer) {
                    //calculate bonus
                    $credit_amount = (websiteInfo('ref_bonus') / 100 * round(session()->get('amount'), 2));
                    $credit_bonus  = User::find($referrer->id);
                    $credit_bonus->account_bal = ($referrer->account_bal + $credit_amount);
                    $credit_bonus->save();

                    //record transaction
                    $new_bal = ($referrer->account_bal + $credit_amount);
                    recordNewTransaction($referrer->id, 'credit', $credit_amount,  'Bonus', $new_bal, 'Referal Bonus');
                }
            }

            //send deposit email
            $amount = session()->get('amount');
            $converted_amount = round(session()->get('converted_amount'), 2);
            $currency = strtoupper(session()->get('currency'));
            $charge = session()->get('charge');
            $method = 'Paystack';
            $status = 'Approved';

            sendNewDepositEmail($amount, $converted_amount, $currency, $charge, $method, $status);

            //delete params from session
            session()->pull('amount');
            session()->pull('converted_amount');
            session()->pull('currency');
            session()->pull('charge');

            return redirect(route('user.deposit.index'))->with('success', 'Your Deposit was successful. Your payment ID is ' . $reference);
        } else {
            //delete params from session                
            if (session()->has('amount')) {
                session()->pull('amount');
                session()->pull('converted_amount');
                session()->pull('currency');
                session()->pull('charge');
            }
            return redirect(route('user.deposit.index'))->with('fail', 'Your Deposit request failed');
        }
    }
}
