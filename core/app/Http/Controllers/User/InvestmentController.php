<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\InvestmentPlan;


class InvestmentController extends Controller
{
    //return index
    public function index()
    {
        $page_title = 'My Investments';
        $investments = Investment::where('user_id', user('id'))->orderBy('status', 'ASC')->get();
        $all = Investment::where('user_id', user('id'))->get();

        //total earnings
        $total_earnings = $all->sum('total_profit_earned');
        //total invested 
        $total_invested = $all->sum('amount');

        //total plans
        $total_plans = $all->count();
        $active_plans = $all->where('status', 'active')->count();
        $expired_plans = $all->where('status', 'expired')->count();
        $suspended_plans = $all->where('status', 'suspended')->count();


        return view('themes.' . websiteInfo('theme') . '.user.investments.index', compact(
            'page_title',
            'investments',
            'total_earnings',
            'total_invested',
            'total_plans',
            'active_plans',
            'expired_plans',
            'suspended_plans',
        ));
    }

    public function new()
    {
        $page_title = 'New Investment';
        if (session()->has('plan_id')) {
            $plan = InvestmentPlan::where('id', session()->get('plan_id'))->first();
            return view('themes.' . websiteInfo('theme') . '.user.investments.new', compact(
                'page_title',
                'plan'
            ));
        } else {
            $plans = InvestmentPlan::get();

            return view('themes.' . websiteInfo('theme') . '.user.investments.new', compact(
                'page_title',
                'plans'
            ));
        }
    }

    public function newValidate(Request $request)
    {
        if (session()->has('plan_id')) {
            //check if the plan exist
            $plan = InvestmentPlan::where('id', session()->get('plan_id'))->first();
            if (!$plan) {
                session()->pull('plan_id');
                return back()->with('fail', 'This plan is not valid');
            }



            //check the plan amount type
            if ($plan->amount_type == 'fixed') {
                $amount = $plan->max_amount;
            } else {
                //check if the entered amount matches min and max
                $request->validate([
                    'amount' => 'required',
                ]);

                if ($request->amount < $plan->min_amount) {
                    return back()->with('fail', 'Minimum amount is ' . formatAmount($plan->min_amount));
                } elseif ($request->amount > $plan->max_amount) {
                    return back()->with('fail', 'Maximum amount is ' . formatAmount($plan->max_amount));
                }

                $amount = $request->amount;
            }

            //check if user balance is able to cover the cost
            if ($amount > user('account_bal')) {
                return back()->with('fail', 'Insufficient Balance! Deposit money into your account to purchase this plan');
            }

            //debit the user
            $debit = User::find(user('id'));
            $new_bal = user('account_bal') - $amount;
            $debit->account_bal = $new_bal;
            $debit->save();

            //calculate expiry date for investment
            $duration = '+' . $plan->duration . ' ' . $plan->duration_type;
            $expires = strtotime($duration, time());

            //calculate next profit time
            $interval = $plan->return_interval;
            if ($interval == 'hourly') {
                $next_profit_time = strtotime('+1 hour', time());
                $interval_to_time = 60 * 60;
                $interval_n = '+1 hour';
            } elseif ($interval == 'daily') {
                $next_profit_time = strtotime('+1 day', time());
                $interval_to_time = 24 * 60 * 60;
                $interval_n = '+1 day';
            } elseif ($interval == 'weekly') {
                $next_profit_time = strtotime('+1 week', time());
                $interval_to_time = 7 * 24 * 60 * 60;
                $interval_n = '+1 week';
            } elseif ($interval == 'monthly') {
                $next_profit_time = strtotime('+1 month', time());
                $interval_to_time =  30 * 24 * 60 * 60;
                $interval_n = '+1 month';
            } elseif ($interval == 'yearly') {
                $next_profit_time = strtotime('+1 year', time());
                $interval_to_time = 365 * 24 * 60 * 60;
                $interval_n = '+1 year';
            }


            //calculate total profit
            if ($plan->return_type == 'fixed') {
                $total_profit = $amount + $plan->return;
            } else {
                $total_profit = (($plan->return / 100 * $amount) + $amount);
            }

            //calculate number of intervals
            $number_of_intervals = ($expires - time()) / $interval_to_time;

            //calculate profit per interval
            $profit_per_interval = $total_profit / $number_of_intervals;

            // $test = [
            //     'interval' => $interval,
            //     'interval_to_time' => $interval_to_time,
            //     'expires' => $expires,
            //     'total profit' =>$total_profit,
            //     'number of intervals' => $number_of_intervals,
            //     'profit per interval' => $profit_per_interval
            // ];



            //save investment 
            $investment = new Investment();
            $investment->user_id = user('id');
            $investment->plan_name = $plan->name;
            $investment->amount = $amount;
            $investment->expires = $expires;
            $investment->interval = $interval_n;
            $investment->next_profit_time = $next_profit_time;
            $investment->last_profit_time = $next_profit_time;
            $investment->profit_per_interval = $profit_per_interval;
            $investment->total_intervals = $number_of_intervals;
            $investment->total_intervals_given = 0;
            $investment->total_profit_earned = 0;
            $investment->status = 'active';
            $investment->save();

            //record new transaction
            recordNewTransaction(user('id'), 'debit', $amount, 'Plan Purchase', $new_bal, 'Investment Plan Purchase - ' . $plan->name);
            session()->pull('plan_id');
            return redirect(route('user.investments.index'))->with('success', 'You have successfully purchased ' . $plan->name);
        } else {
            //validate input
            $request->validate([
                'plan_id' => 'required'
            ]);

            //add plan_id to session
            session()->put('plan_id', $request->plan_id);
            return back();
        }
    }

    public function cancel()
    {
        session()->pull('plan_id');
        return redirect(route('user.investments.new'))->with('success', 'Investment cancelled');
    }
}
