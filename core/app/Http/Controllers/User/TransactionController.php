<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //return transactions belonging to the user
    public function transactions()
    {
        $page_title = 'My Transactions';
        $transactions = Transaction::where('user_id', user('id'))->orderBy('id', 'DESC')->get();

        //for infographics
        //credit
        $total_credits = $transactions->where('type', 'credit')->sum('amount');
        $credits_count = $transactions->where('type', 'credit')->count();

        //debit
        $total_debits = $transactions->where('type', 'debit')->sum('amount');
        $debits_count = $transactions->where('type', 'debit')->count();

        return view('themes.' . websiteInfo('theme') . '.user.transactions', compact(
            'page_title',
            'transactions',
            'total_credits',
            'credits_count',
            'total_debits',
            'debits_count',
        ));
    }
}
