<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManualDepositMethod;
use App\Models\Deposit;


class DepositController extends Controller
{
    //get the deposit index page
    public function index()
    {
        $page_title = 'My Deposits';
        $deposits = Deposit::where('user_id', user('id'))->orderBy('id', 'DESC')->get();
        // For infograpics
        $total_deposits_count = $deposits->count();
        $total_deposits_value = $deposits->sum('amount');

        $pending_deposits = Deposit::where('user_id', user('id'))->where('status', 'pending')->get();
        $pending_deposits_count = $pending_deposits->count();
        $pending_deposits_value = $pending_deposits->sum('amount');

        $rejected_deposits = Deposit::where('user_id', user('id'))->where('status', 'rejected')->get();
        $rejected_deposits_count = $rejected_deposits->count();
        $rejected_deposits_value = $rejected_deposits->sum('amount');

        $approved_deposits = Deposit::where('user_id', user('id'))->where('status', 'approved')->get();
        $approved_deposits_count = $approved_deposits->count();
        $approved_deposits_value = $approved_deposits->sum('amount');


        return view('themes.' . websiteInfo('theme') . '.user.deposit.index', compact(
            'page_title',
            'deposits',
            'total_deposits_count',
            'total_deposits_value',
            'pending_deposits_count',
            'pending_deposits_value',
            'rejected_deposits_count',
            'rejected_deposits_value',
            'approved_deposits_count',
            'approved_deposits_value'
        ));
    }

    //get single deposit page
    public function view(Request $request)
    {
        //check if deposit belongs to the user
        if ($request->route('user_id') != user('id')) {
            return redirect(route('user.deposit.index'))->with('fail', 'Unauthorized access');
        }

        //get the deposit detail
        $deposit = Deposit::where('id', $request->route('id'))->first();
        $page_title = 'View Deposit';

        return view('themes.' . websiteInfo('theme') . '.user.deposit.view', compact(
            'page_title',
            'deposit'
        ));
    }

    //make new deposit page
    public function deposit()
    {
        $page_title = 'New Deposit';
        //get all manual crypto 
        $methods = ManualDepositMethod::where('status', 'active')->get();

        return view('themes.' . websiteInfo('theme') . '.user.deposit.new-deposit', compact(
            'page_title',
            'methods'
        ));
    }

    //process payment 

    public function pay(Request $request)
    {
        //validate form inputs
        //amount and method name

        $request->validate([
            'method_id' => 'required',
            'amount' => 'required'
        ]);

        //get the method type from databse [crypto/gateway/bank/others]

        $method = ManualDepositMethod::where('id', $request->method_id)->first();
        //calculate charge 
        if ($method->charge_type ==  'fixed') {
            $charge = $method->charge;
        } elseif ($method->charge_type == 'percent') {
            $charge = ($method->charge / 100 * $request->amount);
        }

        //check for min and max
        if ($request->amount < $method->min_amount) {
            return back()->with('fail', 'Minimum deposit amount for ' . $method->name . ' is ' .  formatAmount($method->min_amount));
        } elseif ($request->amount > $method->max_amount) {
            return back()->with('fail', 'Maximum deposit amount for ' . $method->name . ' is ' .  formatAmount($method->max_amount));
        }

        //convert to method currency
        $converted = currencyConverter(websiteInfo('general_currency'), $method->currency, ($request->amount + $charge));
        $amount = $request->amount;
        $converted_amount = $converted['amount'];
        $currency = $converted['currency'];

        //store the method id, amount and converted amount  in session
        $request->session()->put('amount', $amount);
        $request->session()->put('method_id', $method->id);
        $request->session()->put('converted_amount', $converted_amount);
        $request->session()->put('currency', $currency);
        $request->session()->put('charge', $charge);

        //process manual payment
        if ($method->type == 'crypto' || $method->type == 'bank' || $method->type == 'others') {
            return redirect(route('user.deposit.pay.manual'));
        } else {
            //process gateway payment
            $route = 'gateway.' . $method->type . '.index';
            return redirect(route($route));
        }
    }


    //return view for manaul payment
    public function manualPay()
    {
        if (session()->has('amount') && session()->has('method_id') && session()->has('converted_amount')) {
            $page_title = 'Manual Payment';
            $amount = session()->get('amount');
            $method_id = session()->get('method_id');
            $converted_amount = session()->get('converted_amount');
            $payment_method = ManualDepositMethod::where('id', $method_id)->first();
            $currency = session()->get('currency');
            $charge = session()->get('charge');
            return view('themes.' . websiteInfo('theme') . '.user.payment.manual', compact(
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

    //save manual payment
    public function saveManualPayment(Request $request)
    {
        //validate form data
        $request->validate([
            'payment_screenshot' => 'required|mimes:jpg,jpeg,png|max:10000'
        ]);

        //get the method id and check the type of manaul payment method
        $method = ManualDepositMethod::where('id', session()->get('method_id'))->first();

        //retrieve crypto specific params and save to database
        $amount = session()->get('amount');
        $converted_amount = session()->get('converted_amount');
        $currency = session()->get('currency');
        $charge = session()->get('charge');

        //upload  payment screenshot
        $payment_screenshot = uploadImage($request->file('payment_screenshot'), 'deposits');

        //save deposit table
        $save_deposit = new Deposit();
        $save_deposit->user_id = user('id');
        $save_deposit->amount = $amount;
        $save_deposit->converted_amount = $converted_amount;
        $save_deposit->currency = $currency;
        $save_deposit->charge = $charge;
        $save_deposit->method = $method->name;
        $save_deposit->status = 'pending';
        $save_deposit->payment_screenshot = $payment_screenshot;
        $save_deposit->additional_info = $request->additional_info;
        $save = $save_deposit->save();

        if ($save) {
            //send email
            sendNewDepositEmail($amount, $converted_amount, $currency, $charge, $method->name, 'pending');

            //delete params from session
            session()->pull('amount');
            session()->pull('converted_amount');
            session()->pull('currency');
            session()->pull('charge');



            //redirect with success
            return redirect(route('user.deposit.index'))->with('success', 'Your deposit request has been received, please wait while an admin varifies your payment');
        } else {
            return back()->with('fail', 'Your deposit failed, please try again');
        }
    }

    //cancel manaul payment
    public function cancelManualPayment(Request $request)
    {
        //get the method id and check the type of manaul payment method
        $method = ManualDepositMethod::where('id', session()->get('method_id'))->first();

        //retrieve crypto specific params and save to database
        $amount = session()->get('amount');
        $converted_amount = session()->get('converted_amount');
        $currency = session()->get('currency');
        $charge = session()->get('charge');

        //save deposit table
        $save_deposit = new Deposit();
        $save_deposit->user_id = user('id');
        $save_deposit->amount = $amount;
        $save_deposit->converted_amount = $converted_amount;
        $save_deposit->currency = $currency;
        $save_deposit->charge = $charge;
        $save_deposit->method = $method->name;
        $save_deposit->status = 'cancelled';

        $save = $save_deposit->save();

        if ($save) {
            //delete params from session
            session()->pull('amount');
            session()->pull('converted_amount');
            session()->pull('currency');
            session()->pull('charge');


            //redirect with success
            return redirect(route('user.deposit.index'))->with('success', 'Your deposit request has been cancelled');
        } else {
            return back()->with('fail', 'Your deposit cancellation failed, please try again');
        }
    }
}
