<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;

class AdminInvestmentController extends Controller
{
    //retrieve investments
    public function index()
    {
        $page_title = 'Investments';
        $all = Investment::orderBy('id', 'DESC')->get();
        $investments = $all;

        if (request()->has('user_id')) {
            $investments = $all->where('user_id', request()->user_id);
        }

        return view('admin.investments.index', compact(
            'page_title',
            'investments'
        ));
    }

    //suspend
    public function suspend(Request $request)
    {
        $suspend = Investment::find($request->route('id'));
        $suspend->status = 'suspended';
        $suspend->save();
        return redirect(route('admin.investments.index'))->with('success', 'Investment suspended successfully');
    }

    //reactivate 
    public function reactivate(Request $request)
    {
        $reactivate = Investment::find($request->route('id'));
        $reactivate->status = 'active';
        $reactivate->save();
        return redirect(route('admin.investments.index'))->with('success', 'Investment reactivated successfully');
    }

    //delete 
    public function delete(Request $request)
    {
        $delete = Investment::find($request->route('id'))->delete();
        return redirect(route('admin.investments.index'))->with('success', 'Investment deleted successfully');
    }

    //action
    public function action(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'action' => 'required'
        ]);

        //delete plans
        if ($request->action == 'delete'){
            foreach ($request->ids as $id){
                $delete = Investment::find($id)->delete();
            }

            //return response
            return back()->with('success', 'Investments deleted successfully');
        }elseif ($request->action == 'suspend') {
            foreach ($request->ids as $id){
                $suspend = Investment::find($id);
                $suspend->status = 'suspended';
                $suspend->save();
            }
            //return response
            return back()->with('success', 'Investments suspended successfully');

        }elseif ($request->action == 'reactivate') {
            foreach ($request->ids as $id){
                $reactivate = Investment::find($id);
                $reactivate->status = 'active';
                $reactivate->save();
            }
            //return response
            return back()->with('success', 'Investments reactivated successfully');
        }else {
            return back('fail', 'Unrecognized action');
        }
    }
}
