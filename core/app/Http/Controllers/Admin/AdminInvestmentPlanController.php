<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentPlan;

class AdminInvestmentPlanController extends Controller
{
    //return the investment plan index page

    public function index()
    {
        $page_title = 'All Investment Plans';
        $plans = InvestmentPlan::get();

        return view('admin.investment-plans.index', compact(
            'page_title',
            'plans'
        ));
    }

    //return single plan edit page
    public function edit(Request $request)
    {
        //check if the investment exists
        $plan = InvestmentPlan::where('id', $request->route('id'))->first();
        if (!$plan) {
            return redirect(route('admin.investment-plans.index'))->with('fail', 'The investment plan you are trying to access does not exist');
        }

        $page_title = 'Edit Investment Plan';

        return view('admin.investment-plans.edit', compact(
            'page_title',
            'plan'
        ));
    }

    //valudate plan edit
    public function editValidate(Request $request)
    {
        //validate input
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'amount_type' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'return_type' => 'required',
            'return' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'return_interval' => 'required',
            'status' => 'required'
        ]);

        //save changes
        $plan = InvestmentPlan::find($request->id);
        $plan->name = $request->name;
        $plan->amount_type = $request->amount_type;
        $plan->min_amount = $request->min_amount;
        $plan->max_amount = $request->max_amount;
        $plan->return_type = $request->return_type;
        $plan->return = $request->return;
        $plan->duration = $request->duration;
        $plan->duration_type = $request->duration_type;
        $plan->return_interval = $request->return_interval;
        $plan->label = $request->label;
        $plan->status = $request->status;
        $plan->save();

        return back()->with('success', 'Plan Edited Successfully');
    }

    //create new plan
    public function new()
    {
        $page_title = 'Add New Plan';

        return view('admin.investment-plans.new', compact(
            'page_title'
        ));
    }

    //validate plan creation
    public function newValidate(Request $request)
    {
        //validate input
        $request->validate([
            //'id' => 'required',
            'name' => 'required',
            'amount_type' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'return_type' => 'required',
            'return' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'return_interval' => 'required',
            'status' => 'required'
        ]);

        //save changes
        $plan = new InvestmentPlan();
        $plan->name = $request->name;
        $plan->amount_type = $request->amount_type;
        $plan->min_amount = $request->min_amount;
        $plan->max_amount = $request->max_amount;
        $plan->return_type = $request->return_type;
        $plan->return = $request->return;
        $plan->duration = $request->duration;
        $plan->duration_type = $request->duration_type;
        $plan->return_interval = $request->return_interval;
        $plan->label = $request->label;
        $plan->status = $request->status;
        $plan->save();

        //$url = '/admin/investment-plans/edit/' . $plan->id;
		$url = route('admin.investment-plans.edit', $plan->id);

        return redirect($url)->with('success', 'Plan Added Successfully');
    }

    //delete plan
    public function delete(Request $request)
    {
        $delete = InvestmentPlan::where('id', $request->route('id'))->delete();
        return redirect(route('admin.investment-plans.index'))->with('success', 'Plan Deleted Successfully');
    }
}
