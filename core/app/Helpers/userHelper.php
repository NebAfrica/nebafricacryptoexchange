<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;


//get logged in user details;
if (!function_exists('user')) {
    function user($info)
    {
        if ($info == NULL) {
            return 'no info matches';
        }
        //get the logged in admin id from session;

        $user = User::where('id', session()->get('loginId'))->first();
        return $user->$info;
    }
}

//give welcome bonus
if (!function_exists('giveWelcomeBonus')) {
    function giveWelcomeBonus($account_id)
    {
        $bonus = floatval(websiteInfo('register_bonus'));
        $user = User::where('account_id', $account_id)->first();
        $new_balance = floatval($user->amount) + floatval(websiteInfo('register_bonus'));
        $give_bonus = User::find($user->id);
        $give_bonus->account_bal = $new_balance;
        $save = $give_bonus->save();

        if ($save) {

            //log transaction and send email notification if register bonus is not 0
            if (floatval(websiteInfo('register_bonus')) > 0) {
                $user_id = $user->id;
                $type = 'credit';
                $amount =  floatval(websiteInfo('register_bonus'));
                $balance = $new_balance;
                $method = 'Bonus';
                $remark = 'Signup Bonus';
                $txn_id = bin2hex(random_bytes(16));

                $save_transaction = new Transaction();
                $save_transaction->user_id = $user_id;
                $save_transaction->type = $type;
                $save_transaction->amount = $amount;
                $save_transaction->balance_after_transaction = $new_balance;
                $save_transaction->method = $method;
                $save_transaction->txn_id = $txn_id;
                $save_transaction->remark = $remark;
                $save_new_transaction = $save_transaction->save();

                sendTransactionNotification($user_id, $type, $amount, $balance, $method, $remark, $txn_id);
            }
        }

        return true;
    }
}
