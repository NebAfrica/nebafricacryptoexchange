<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    //index
    public function index(Request $request)
    {
        $page_title = 'All Transactions';
        $all = Transaction::orderBy('id', 'DESC')->get();
        $transactions = $all;

        //check if the request has a specific user
        if ($request->has('user_id')) {
            $transactions = $all->where('user_id', $request->user_id);
        }

        return view('admin.transactions', compact(
            'all',
            'page_title',
            'transactions'
        ));
    }

    //delete transaction
    public function delete(Request $request)
    {
        $transaction = Transaction::where('id', $request->id)->first();
        if ($transaction) {
            $delete = $transaction->delete();
            return redirect(route('admin.transactions.index'))->with('success', 'Transaction Deleted Successfully');
        } else {
            return redirect(route('admin.transactions.index'))->with('fail', 'The transaction you are trying to delete does not exist');
        }
    }

    //bulk action
    public function action(Request $request)
    {
        $request->validate([
            'action' => 'required',
            'transaction_ids' => 'required'
        ], [
            'transaction_ids.required' => 'Select at least one transaction',
        ]);

        if ($request->action == 'delete') {
            foreach ($request->transaction_ids as $transaction) {

                $delete = Transaction::where('id', $transaction)->delete();
            }

            return back()->with('success', 'Transactions deleted');
        } else {
            return back('fail', 'Unrecognized Operation');
        }
    }
}
