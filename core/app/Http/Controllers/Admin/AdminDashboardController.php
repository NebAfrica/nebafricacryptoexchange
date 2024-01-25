<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Loan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //return the dashboard view
    public function dashboard()
    {
        $page_title = 'Admin Dashboard';
        $deposits = Deposit::orderBy('id', 'DESC')->get();
        $withdrawals = Withdrawal::sum('amount');      
        $earnings =  Transaction::where('method', 'ROI')->sum('amount');
        $investments = Investment::sum('amount');
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.dashboard', compact(
            'page_title',
            'deposits',
            'withdrawals',
            'earnings',
            'investments',
            'users',
        ));
    }
}