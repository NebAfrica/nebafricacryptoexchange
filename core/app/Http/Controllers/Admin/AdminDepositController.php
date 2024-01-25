<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\ManualDepositMethod;

class AdminDepositController extends Controller
{
    //return index of deposits
    public function index()
    {
        $page_title  = 'Deposits';
        $all = Deposit::orderBy('id', 'DESC')->get();
        $deposits = $all;
        if (request()->has('user_id')) {
            $deposits = $all->where('user_id', request()->user_id);
        }

        return view('admin.deposits.index', compact(
            'page_title',
            'deposits',
        ));
    }

    //return single deposit
    public function viewDeposit(Request $request)
    {
        $page_title = 'Manage Deposit';
        $deposit = Deposit::where('id', $request->route('id'))->first();

        return view('admin.deposits.view', compact(
            'page_title',
            'deposit'
        ));
    }

    //approve or reject deposit 
    public function processDeposit(Request $request)
    {
        //validate input
        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'action' => 'required',
            'additional_info' => 'required'
        ]);

        //process payment 
        $process = processDeposit($request->id, $request->user_id, $request->action, $request->additional_info);

        return back()->with('success', 'Deposit has been processed');
    }


    //delete deposit
    public function deleteDeposit(Request $request)
    {
        $delete = Deposit::find($request->id)->delete();

        return redirect(route('admin.deposits.index'))->with('success', 'Deposit Deleted');
    }

    public function bulkDelete(Request $request)
    {
        //validate input
        $request->validate([
            'ids' => 'required',
            'action' => 'required',
        ]);


        //delete deposits
        foreach ($request->ids as $id) {
            $delete = Deposit::find($id)->delete();
        }

        return redirect(route('admin.deposits.index'))->with('success', 'Deposits Deleted');
    }
}
