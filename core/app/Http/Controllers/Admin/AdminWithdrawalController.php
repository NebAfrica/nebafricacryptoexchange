<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;

class AdminWithdrawalController extends Controller
{
    //index 
    public function index()
    {
        $page_title = 'Withdrawals';
        $all = Withdrawal::orderby('id', 'DESC')->get();
        $withdrawals = $all;
        if (request()->has('user_id')) {
            $withdrawals = $all->where('user_id', request()->user_id);
            $all = $withdrawals;
        }

        return view('admin.withdrawals.index', compact(
            'page_title',
            'withdrawals',
            'all'
        ));
    }

    //pending withdrawals
    public function pending()
    {
        $page_title = 'Pending Withdrawals';
        $all = Withdrawal::orderby('id', 'DESC')->get();
        $withdrawals = $all->where('status', 'pending');

        return view('admin.withdrawals.index', compact(
            'page_title',
            'withdrawals',
            'all'
        ));
    }

    //view withdrawal
    public function view(Request $request)
    {

        $page_title = 'Withdrawal';
        $withdrawal = Withdrawal::where('id', $request->id)->first();

        //check if the withdrawal exist
        if (!$withdrawal) {
            return redirect(route('admin.withdrawals.index'))->with('fail', 'Withdrawal not found');
        }

        return view('admin.withdrawals.view', compact(
            'page_title',
            'withdrawal'
        ));
    }

    //process withdrawal
    public function process(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'action' => 'required',
            'additional_info' => 'required'
        ]);

        $withdrawal = Withdrawal::where('id', $request->id)->first();
        //check if the withdrawal exist
        if (!$withdrawal) {
            return redirect(route('admin.withdrawals.index'))->with('fail', 'Withdrawal not found');
        }

        $action = $request->action;
        $additional_info = $request->additional_info;

        //process 
        $process = processWithdrawal($withdrawal, $action, $additional_info);

        if ($process == true) {
            return back()->with('success', 'Withdrawal processed');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }


    //delete withdrawal 
    public function delete(Request $request)
    {
        $withdrawal = Withdrawal::where('id', $request->id)->first();
        if ($withdrawal) {
            $delete = $withdrawal->delete();
            if ($delete) {
                return redirect(route('admin.withdrawals.index'))->with('success', 'Withdrawal Deleted successfully');
            } else {
                return redirect(route('admin.withdrawals.index'))->with('fail', 'Something went wrong');
            }
        } else {
            return redirect(route('admin.withdrawals.index'))->with('fail', 'Withdrawl does not exist');
        }
    }
}
