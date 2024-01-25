<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Loan;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //return the dashboard view
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $deposits = Deposit::where('user_id', user('id'))
            ->where('status', 'approved')
            ->orderBy('id', 'DESC')
            ->get();
        $withdrawals = Withdrawal::where('user_id', user('id'))->orderBy('id', 'DESC')->get();
        $transactions = Transaction::where('user_id', user('id'))->orderBy('id', 'DESC')->get();
        $earnings = $transactions->where('method', 'ROI')->sum('amount');
        $investments = Investment::where('user_id', user('id'))->get();
        $referrals = User::where('referred_by', user('account_id'))->get();
        return view('themes.' . websiteInfo('theme') . '.user.dashboard', compact(
            'page_title',
            'deposits',
            'withdrawals',
            'earnings',
            'investments',
            'referrals',
            'transactions'
        ));
    }
}
