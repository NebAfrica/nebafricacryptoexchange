<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawalWallet;
use App\Models\Withdrawal;
use App\Models\User;


class WithdrawalController extends Controller
{
    //return withdrawal page index
    public function index()
    {
        $page_title = 'My Withdrawals';
        $withdrawals  = Withdrawal::where('user_id', user('id'))->orderBy('id', 'DESC')->get();
        //dd($withdrawals);

        //total
        $total_withdrawals_count = $withdrawals->count();
        $total_withdrawals_value = $withdrawals->sum('amount');

        //pending
        $pending_withdrawals_value = $withdrawals->where('status', 'pending')->sum('amount');
        $pending_withdrawals_count = $withdrawals->where('status', 'pending')->count();

        //approved
        $approved_withdrawals_value = $withdrawals->where('status', 'approved')->sum('amount');
        $approved_withdrawals_count = $withdrawals->where('status', 'approved')->count();

        //rejected
        $rejected_withdrawals_value = $withdrawals->where('status', 'rejected')->sum('amount');
        $rejected_withdrawals_count = $withdrawals->where('status', 'rejected')->count();

        return view('themes.' . websiteInfo('theme') . '.user.withdrawal.index', compact(
            'page_title',
            'withdrawals',
            'total_withdrawals_count',
            'total_withdrawals_value',
            'pending_withdrawals_value',
            'pending_withdrawals_count',
            'approved_withdrawals_value',
            'approved_withdrawals_count',
            'rejected_withdrawals_value',
            'rejected_withdrawals_count'
        ));
    }

    //view withdrawal
    public function view(Request $request)
    {
        $page_title = 'View Withdrawal';
        $withdrawal = Withdrawal::where('id', $request->id)->first();
        if (!$withdrawal) {
            return redirect(route('user.withdrawals.index'))->with('fail', 'Withdrawal Not found');
        }

        //check if the withdrawal belongs to the viewing user
        if ($withdrawal->user_id != user('id')) {
            return redirect(route('user.withdrawals.index'))->with('fail', 'Not Authorized');
        }

        return view('themes.' . websiteInfo('theme') . '.user.withdrawal.view', compact(
            'page_title',
            'withdrawal'
        ));
    }

    //new withdrawal
    public function new()
    {
        $page_title = 'Request Withdrawal';
        $wallets = WithdrawalWallet::where('user_id', user('id'))->orderBy('id', 'DESC')->get();

        //check if the user has added wallets for withdrawal
        if ($wallets->count() == 0){
            return redirect(route('user.wallets.new'))->with('fail', 'Wallet is required to make a withdrawal');
        }

        return view('themes.' . websiteInfo('theme') . '.user.withdrawal.new', compact(
            'page_title',
            'wallets'
        ));
    }

    //validate new withdrawal
    public function newValidate(Request $request)
    {
        //validation based on session value
        if (session()->has('amount') && session()->has('wallet') && session()->has('total') && session()->has('fee')) {
            //retrieve variables from session
            $wallet = session()->get('wallet');
            $amount = session()->get('amount');
            $fee = session()->get('fee');
            $total = session()->get('total');

            //check if the amount exceeds min and max
            if ($amount > websiteInfo('max_withdrawal')) {
                //clear session data
                session()->pull('wallet');
                session()->pull('amount');
                session()->pull('fee');
                session()->pull('total');
                session()->pull('otp');
                session()->pull('expires');
                return back()->with('fail', 'Maximum withdrawal amount is ' . formatAmount(websiteInfo('max_withdrawal')));
            } elseif ($amount < websiteInfo('min_withdrawal')) {
                //clear session data
                session()->pull('wallet');
                session()->pull('amount');
                session()->pull('fee');
                session()->pull('total');
                session()->pull('otp');
                session()->pull('expires');
                return back()->with('fail', 'Mimimum withdrawal amount is ' . formatAmount(websiteInfo('min_withdrawal')));
            }

            //check if the user balance is enough to foot withdrawal
            if ($total > user('account_bal')) {
                //clear session data
                session()->pull('wallet');
                session()->pull('amount');
                session()->pull('fee');
                session()->pull('total');
                session()->pull('otp');
                session()->pull('expires');

                return back()->with('fail', 'Insufficent Balance!');
            }

            if (websiteInfo('withdrawal_otp') == 'enabled') {
                $request->validate([
                    'otp' => 'required'
                ]);

                //check if the otp matcahes
                if ($request->otp != session()->get('otp')) {
                    return back()->with('fail', 'Invalid otp');
                } elseif (time() > session()->get('expires')) {
                    return back('fail', 'Your OTP Code has expired, request a new one');
                }
            }



            //debit the user
            $new_bal = user('account_bal') - $total;
            $debit = User::find(user('id'));
            $debit->account_bal = $new_bal;
            $save = $debit->save();

            if ($save) {
                //log in withdrawal table  
                $txn_id = uniqid();
                $withdrawal = new Withdrawal();
                $withdrawal->user_id = user('id');
                $withdrawal->amount = $amount;
                $withdrawal->fee = $fee;
                $withdrawal->total = $total;
                $withdrawal->wallet_name = $wallet->name;
                $withdrawal->wallet_type = $wallet->type;
                $withdrawal->info = $wallet->info;
                $withdrawal->status = 'pending';
                $withdrawal->txn_id = $txn_id;
                $withdrawal->save();

                //send notification email

                sendNewWithdrawalEmail($amount, $fee, $total, $wallet->name, $wallet->type, $wallet->info, $txn_id, 'pending');

                //record new transaction
                recordNewTransaction(user('id'), 'debit', $total, 'Withdrawal', $new_bal, 'Withdrawal Request');

                //clear session data
                session()->pull('wallet');
                session()->pull('amount');
                session()->pull('fee');
                session()->pull('total');
                session()->pull('otp');
                session()->pull('expires');
                return back()->with('success', 'Withdrawal Request placed successfully');
            } else {
                //clear session data
                session()->pull('wallet');
                session()->pull('amount');
                session()->pull('fee');
                session()->pull('total');
                session()->pull('otp');
                session()->pull('expires');
                return back()->with('fail', 'Something went wrong, try again later');
            }
        } else {
            $request->validate([
                'amount' => 'required',
                'wallet_id' => 'required'
            ]);

            $amount = $request->amount;
            $wallet = WithdrawalWallet::where('id', $request->wallet_id)->first();
            if (!$wallet->id) {
                return back()->with('fail', 'Invalid Wallet Selected');
            }

            //check if the wallet belongs to the user
            if ($wallet->user_id != user('id')) {
                return back()->with('fail', 'Invalid Wallet');
            }
            //calculate withdrawal fee
            $fee = websiteInfo('withdrawal_fee');
            $fee_type = websiteInfo('withdrawal_fee_type');
            if ($fee_type == 'fixed') {
                $calculated_fee =  $fee;
                $total = $amount + $fee;
            } elseif ($fee_type == 'percent') {
                $calculated_fee = round(($fee / 100 * $amount), 2);
                $total = $amount + $calculated_fee;
            } else {
                return back()->with('fail', 'Error Calculating fee, try again later');
            }

            //send otp
            if (websiteInfo('withdrawal_otp') == 'enabled') {
                $send_otp = sendOtp(user('email'), 'user');
                if ($send_otp) {
                    session()->put('otp', $send_otp['otp']);
                    session()->put('expires', $send_otp['expires']);
                }
            }

            //store variables in session
            session()->put('amount', $amount);
            session()->put('total', $total);
            session()->put('fee', $calculated_fee);
            session()->put('wallet', $wallet);

            return back();
        }
    }

    //
}
