<?php

use App\Mail\EmailNoQueue;
use App\Models\WebsiteSetting;
use App\Models\User;
use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\PasswordReset;
use App\Models\VerifyToken;
use App\Models\Deposit;
use Modules\CryptoLoan\Entities\Loan;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;


//send password reset email  for admin
if (!function_exists('sendPasswordResetEmailAdmin')) {
    function sendPasswordResetEmailAdmin($email)
    {
        //generate reset code        
        $str = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $reset_token = substr(str_shuffle($str), 20);
        $expires = strtotime('+ 15 minute', time());
        //save token
        $save_token = new PasswordReset();
        $save_token->email = $email;
        $save_token->token = $reset_token;
        $save_token->expires = $expires;
        $result = $save_token->save();

        $reset_link = URL::to('/admin/reset') . '/' . $reset_token;
        $email_template = EmailTemplate::where('name', 'password_reset_mail')->first();
        $subject =  $email_template->subject;
        $admin  = Admin::where('email', $email)->first();
        $first_name = $admin->first_name;
        $last_name = $admin->last_name;
        $body = Blade::render(
            $email_template->body,
            [
                'reset_link' => $reset_link,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]
        );

        
        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
            
        }
        return true;
    }
}

//send  password changed to admin 
if (!function_exists('sendPasswordChangedAdmin')) {
    function sendPasswordChangedAdmin($email)
    {
        $email_template = EmailTemplate::where('name', 'password_changed_mail')->first();
        $subject =  $email_template->subject;
        $admin = Admin::where('email', $email)->first();
        $first_name = $admin->first_name;
        $last_name = $admin->last_name;
        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => $first_name,
                'last_name' => $last_name
            ]
        );

        
        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }
        //delete all tokens
        $delete_tokens = PasswordReset::where('email', $email)->delete();
        return true;
    }
}


//send  password changed to admin 
if (!function_exists('sendIdProcessedEmail')) {
    function sendIdProcessedEmail($user_id, $status, $comment)
    {
        $email_template = EmailTemplate::where('name', 'id_processed_mail')->first();
        $subject =  $email_template->subject;
        $user = User::where('id', $user_id)->first();
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $email = $user->email;
        $subject = Blade::render(
            $email_template->subject,
            [
                'status' => $status
            ]
        );
        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'status' => $status,
                'comment' => $comment,
                'date' => date('d-m-Y H:i:s', time())
            ]
        );

        
        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}



//send  deposit rejected 
if (!function_exists('sendDepositRejectedEmail')) {
    function sendDepositRejectedEmail($deposit_id)
    {
        //get deposit details 
        $deposit = Deposit::where('id', $deposit_id)->first();

        //get email template
        $email_template = EmailTemplate::where('name', 'deposit_rejected_mail')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($deposit->user_id, 'first_name'),
                'last_name' => adminUser($deposit->user_id, 'last_name'),
                'amount' => formatAmount($deposit->amount),
                'method' => $deposit->method,
                'converted_amount' => $deposit->converted_amount . ' ' . $deposit->currency,
                'charge' => formatAmount($deposit->charge),
                'status' => $deposit->status,
                'date' => date('d-m-Y H:i:s', time()),
                'additional_info' => $deposit->additional_info,

            ]
        );


        
        if ($email_template->status == 'enabled') {
            $email = adminUser($deposit->user_id, 'email');
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}


//send  deposit approved 
if (!function_exists('sendDepositApprovedEmail')) {
    function sendDepositApprovedEmail($deposit_id)
    {
        //get deposit details 
        $deposit = Deposit::where('id', $deposit_id)->first();

        //get email template
        $email_template = EmailTemplate::where('name', 'deposit_approved_mail')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($deposit->user_id, 'first_name'),
                'last_name' => adminUser($deposit->user_id, 'last_name'),
                'amount' => formatAmount($deposit->amount),
                'method' => $deposit->method,
                'converted_amount' => $deposit->converted_amount . ' ' . $deposit->currency,
                'charge' => formatAmount($deposit->charge),
                'status' => $deposit->status,
                'date' => date('d-m-Y H:i:s', time()),
                'additional_info' => $deposit->additional_info,

            ]
        );


        
        if ($email_template->status == 'enabled') {
            $email = adminUser($deposit->user_id, 'email');
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}

//sendLoanProcessedEmail($resp['loan_id'])
//send  deposit approved 
if (!function_exists('sendLoanProcessedEmail')) {
    function sendLoanProcessedEmail($loan_id)
    {
        //get deposit details 
        $loan = Loan::where('id', $loan_id)->first();

        //get email template
        $email_template = EmailTemplate::where('name', 'loan_processed_mail')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($loan->user_id, 'first_name'),
                'last_name' => adminUser($loan->user_id, 'last_name'),
                'amount' => formatAmount($loan->amount),
                'interest' => formatAmount($loan->interest),
                'repayment_date' => date('d-m-y H:i:s', $loan->repayment_date),
                'status' => $loan->status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );


        
        if ($email_template->status == 'enabled') {
            $email = adminUser($loan->user_id, 'email');
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}

//sendWithdrawalProcessedEmail($withdrawal, $resp['status'])

//send  withdrawal processed email
if (!function_exists('sendWithdrawalProcessedEmail')) {
    function sendWithdrawalProcessedEmail($withdrawal, $status)
    {
        if (!$withdrawal || !$status) {
            return false;
        }

        $email_template = EmailTemplate::where('name', 'withdrawal_processed_mail')->first();
        $subject = $email_template->subject;

        if ($withdrawal->wallet_type == 'crypto') {
            $info = json_decode($withdrawal->info);
            $wallet_address = $info->wallet_address;
            $network_type = $info->network_type;
            $payment_info = '<b>Wallet Address:</b> ' . $wallet_address . '<br>' . '<b>Network Type:</b> ' . $network_type . '<br>';
        } elseif ($withdrawal->wallet_type == 'bank') {
            $info = json_decode($withdrawal->info);
            $bank_name = $info->bank_name;
            $account_name = $info->account_name;
            $account_no = $info->account_no;
            $payment_info = '<b>Bank Name:</b> ' . $bank_name . '<br>' . '<b>Account Name:</b> ' . $account_name . '<br>' . '<b>Account No:</b> ' . $account_no . '<br>';
        } else {
            $info = json_decode($withdrawal->info);
            $payment_info = '<b>Detail:</b> ' . $info->payment_info . '<br>';
        }

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($withdrawal->user_id, 'first_name'),
                'last_name' => adminUser($withdrawal->user_id, 'last_name'),
                'amount' => formatAmount($withdrawal->amount),
                'fee' => formatAmount($withdrawal->fee),
                'total' => formatAmount($withdrawal->total),
                'wallet' => $withdrawal->wallet_name,
                'wallet_info' => $payment_info,
                'txn_id' => $withdrawal->txn_id,
                'status' => $status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );


        
        if ($email_template->status == 'enabled') {
            $email = adminUser($withdrawal->user_id, 'email');
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}

//bulkEmail($emails, $message, $subject);
//send  mass email to users
if (!function_exists('bulkEmail')) {
    function bulkEmail($emails, $message, $subject)
    {
        $body = $message;
        
        foreach ($emails as $email) {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }

        return true;
    }
}

//contact form submission

if (!function_exists('sendContactFormSubmissionEmail')) {
    function sendContactFormSubmissionEmail($name, $email, $subject, $message)
    {
        $body = '<p>Name: ' . $name . '</p> <p>Email: ' . $email .'</p> <p>Message: <br>' . $message . '</p>';
        $subject = 'New Contact Form Submission: ' . $subject;

        //get admins
        $admins = Admin::get();
        foreach ($admins as $admin){
            $email = $admin->email;
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
        }      
        
        return true;
    }
}

