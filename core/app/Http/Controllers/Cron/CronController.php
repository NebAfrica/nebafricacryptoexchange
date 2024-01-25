<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investment;
use App\Models\Blog;
use Modules\CryptoLoan\Entities\Loan;

class CronController extends Controller
{
    //Cron jobs
    public function cron()
    {


        //check if the loan addon is installed
        if (isAddonEnabled('cryptoloan')) {
            //check for due loans and debit user
            $loans = Loan::where('repayment_date', '<', time())->where('status', 'unpaid')->get();
            //dd($loans);
            foreach ($loans as $loan) {
                //debit the owing user
                $amount = $loan->amount + $loan->interest;
                $new_bal = adminUser($loan->user_id, 'account_bal') - $amount;
                if ($new_bal > 0) {
                    $debit = User::find(adminUser($loan->user_id, 'id'));
                    $debit->account_bal = $new_bal;
                    $debit->save();

                    //change loan status to paid
                    $update_loan = Loan::find($loan->id);
                    $update_loan->status = 'paid';
                    $update_loan->save();

                    //record new transaction notification
                    recordNewTransaction($loan->user_id, 'debit', $amount, 'Loan Repayment', $new_bal, 'Loan Paid');
                }
            }
        }
        /**
         * Give profit
         */

        $investments = Investment::where('status', 'active')->where('next_profit_time', '<', time())->get();
        foreach ($investments as $invt) {
            //compare total intervals and total intervals given
            if ($invt->total_intervals > $invt->total_intervals_given) {
                //credit the user
                $new_bal = (adminUser($invt->user_id, 'account_bal') + $invt->profit_per_interval);
                $credit = User::find($invt->user_id);
                $credit->account_bal = $new_bal;
                $credit->save();

                //update investment
                $next_profit_time = strtotime($invt->interval, time());
                $total_intervals_given = $invt->total_intervals_given + 1;
                $total_profit_earned = $invt->total_profit_earned + $invt->profit_per_interval;


                $update = Investment::find($invt->id);
                $update->next_profit_time = $next_profit_time;
                $update->last_profit_time = time();
                $update->total_intervals_given = $total_intervals_given;
                $update->total_profit_earned = $total_profit_earned;
                $update->save();

                //send notification
                recordNewTransaction($invt->user_id, 'credit', $invt->profit_per_interval, 'ROI', $new_bal, 'Investment Earning from - ' . $invt->plan_name);
            }
        }

        //mark investment as expired
        $expired_checks = Investment::where('status', 'active')->get();
        foreach ($expired_checks as $check) {
            //check if the given total intervals has been given
            $total_intervals = $check->total_intervals;
            $given = $check->total_intervals_given;
            if ($given >= $total_intervals) {
                $expired = Investment::find($check->id);
                $expired->status = 'expired';
                $expired->save();
            }
        }

        //auto delete expired investments
        if (websiteInfo('auto_delete_expired_investments') == 'enabled') {
            $expired_investments = Investment::where('status', 'expired')->delete();
        }

        //fetch blogs
        if (websiteInfo('auto_blog') == 'enabled') {
            $blogs = fetchBlogs();
            $blogs = $blogs['blogs'] ?? [];
            foreach ($blogs as $blog) {
                //check if the blog has been saved previously                
                $blog_check = Blog::where('uuid', $blog['uuid'])->first();
                if (!$blog_check) {
                    //save the blog
                    $detail = json_decode($blog['detail']);
                    //dd($detail);
                    $new_blog = new Blog();
                    $new_blog->type = 'auto';
                    $new_blog->author = 'Admin';
                    $new_blog->title = $detail->title;
                    $new_blog->snippet = $detail->snippet;
                    $new_blog->detail = json_encode($detail->description);
                    $new_blog->category = 'Finance';
                    $new_blog->slug = $detail->url;
                    $new_blog->img = $detail->image_url;
                    $new_blog->uuid = $blog['uuid'];
                    $new_blog->save();
                }
            }
        }

        //check for expired investments and change the status
        $expireds = Investment::where('status', 'active')->get();
        foreach ($expireds as $expired) {
            if ($expired->total_intervals <= $expired->total_intervals_given) {
                $change = Investment::find($expired);
                $change->status = 'expired';
                $change->save();
            }
        }

        //update last cron job
        websiteInfoUpdate('cron', time());
    }
}
