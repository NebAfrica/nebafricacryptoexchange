<?php
use App\Models\WebsiteSetting;
use App\Models\User;
use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\PasswordReset;
use App\Models\VerifyToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Mail\EmailNoQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;


//send verification email
if (!function_exists('sendVerificationEmail')) {
    function sendVerificationEmail()
    {
        //generate verification code
        //create a new token
        $str = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $verify_token = substr(str_shuffle($str), 20);
        $expires = strtotime('+ 15 minute', time());
        //save token
        $save_token = new VerifyToken();
        $save_token->user_id = user('id');
        $save_token->token = $verify_token;
        $save_token->expires = $expires;
        $result = $save_token->save();

        $verification_link = URL::to('/verify') . '/' . $verify_token;
        $email_template = EmailTemplate::where('name', 'verification_mail')->first();
        $subject = $email_template->subject;

        $email = user('email');
        $first_name = user('first_name');
        $last_name = user('last_name');
        $body = Blade::render(
            $email_template->body,
            [
                'verification_link' => $verification_link,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]
        );

        if ($result && $email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }
            return true;
        } else {
            return false;
        }

    }
}


//send Welcome email  
if (!function_exists('sendWelcomeEmail')) {
    function sendWelcomeEmail()
    {
        $email_template = EmailTemplate::where('name', 'welcome_mail')->first();
        $subject = Blade::render(
            $email_template->subject,
            [
                'website_name' => websiteInfo('website_name')
            ]
        );

        $email = user('email');
        $first_name = user('first_name');
        $last_name = user('last_name');
        $body = Blade::render(
            $email_template->body,
            [
                'website_name' => websiteInfo('website_name'),
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

        //notify referrer

        if (user('referred_by')) {
            $referrer = User::where('account_id', user('referred_by'))->first();
            if ($referrer) {
                $email_template = EmailTemplate::where('name', 'new_referral_mail')->first();
                $subject = $email_template->subject;
                $first_name = $referrer->first_name;
                $last_name = $referrer->last_name;
                //referred
                $name = user('first_name') . ' ' . user('last_name');
                $email = user('email');
                $account_id = user('account_id');
                $body = Blade::render(
                    $email_template->body,
                    [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'name' => $name,
                        'email' => $email,
                        'account_id' => $account_id
                    ]
                );

                if ($email_template->status == 'enabled') {
                    if (websiteInfo('email_queue' == 'enabled')) {
                        Mail::to($referrer->email)->queue(new Email($body, $subject));
                    } else {
                        Mail::to($referrer->email)->send(new EmailNoQueue($body, $subject));
                    }

                }


            }


        }


        return true;

    }
}

//send password reset email  
if (!function_exists('sendPasswordResetEmail')) {
    function sendPasswordResetEmail($email)
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

        $reset_link = URL::to('/reset') . '/' . $reset_token;
        $email_template = EmailTemplate::where('name', 'password_reset_mail')->first();
        $subject = $email_template->subject;
        $user = User::where('email', $email)->first();
        $first_name = $user->first_name;
        $last_name = $user->last_name;
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


//send temp password  
if (!function_exists('sendTempPassword')) {
    function sendTempPassword($email)
    {
        //generate reset code        
        $str = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()}{?';
        $temp_password = substr(str_shuffle($str), 63);
        //save the password
        $user = User::where('email', $email)->first();
        $save_password = User::find($user->id);
        $save_password->password = Hash::make($temp_password);
        $save = $save_password->save();

        if ($save) {
            $email_template = EmailTemplate::where('name', 'temp_password_mail')->first();
            $subject = $email_template->subject;

            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $body = Blade::render(
                $email_template->body,
                [
                    'temp_password' => $temp_password,
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
}

//send email to user and admin after id upload 
if (!function_exists('sendNewIdUpload')) {
    function sendNewIdUpload()
    {
        //send to the user        
        $email_template = EmailTemplate::where('name', 'new_id_upload_user')->first();
        $subject = $email_template->subject;
        $first_name = user('first_name');
        $last_name = (user('last_name'));
        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => $first_name,
                'last_name' => $last_name
            ]
        );

        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to(user('email'))->queue(new Email($body, $subject));
            } else {
                Mail::to(user('email'))->send(new EmailNoQueue($body, $subject));
            }
        }

        //notify admin
        $admins = Admin::get();
        foreach ($admins as $admin) {
            $email_template = EmailTemplate::where('name', 'new_id_upload_admin')->first();
            $subject = $email_template->subject;
            $first_name = $admin->first_name;
            $last_name = $admin->last_name;
            $admin_email = $admin->email;
            $user = user('first_name') . ' ' . user('last_name');

            $body = Blade::render(
                $email_template->body,
                [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'user' => $user,
                ]
            );

            if ($email_template->status == 'enabled') {
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($admin_email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($admin_email)->send(new EmailNoQueue($body, $subject));
                }
            }

        }

        return true;



    }
}


//send transaction notification
if (!function_exists('sendTransactionNotification')) {
    function sendTransactionNotification($user_id, $type, $amount, $balance, $method, $remark, $txn_id)
    {
        if (!$user_id || !$type || !$amount || !$balance || !$method || !$remark || !$txn_id) {
            return false;
        }

        $email_template = EmailTemplate::where('name', 'new_transaction_mail')->first();
        $user = User::where('id', $user_id)->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'amount' => formatAmount($amount),
                'type' => $type,
                'method' => $method,
                'balance' => formatAmount($balance),
                'txn_id' => $txn_id,
                'remark' => $remark,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );

        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($user->email)->queue(new Email($body, $subject));
            } else {
                Mail::to($user->email)->send(new EmailNoQueue($body, $subject));
            }

        }

        return true;
    }
}



//sendNewDepositEmail

if (!function_exists('sendNewDepositEmail')) {
    function sendNewDepositEmail($amount, $converted_amount, $currency, $charge, $method, $status)
    {
        if (!$amount || !$converted_amount || !$currency || !$charge || !$method || !$status) {
            return false;
        }

        $email_template = EmailTemplate::where('name', 'new_deposit_mail')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'method' => $method,
                'converted_amount' => $converted_amount . ' ' . $currency,
                'charge' => formatAmount($charge),
                'status' => $status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to(user('email'))->queue(new Email($body, $subject));
            } else {
                Mail::to(user('email'))->send(new EmailNoQueue($body, $subject));
            }

        }



        //send email to admins
        $email_template = EmailTemplate::where('name', 'new_deposit_mail_admin')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'method' => $method,
                'converted_amount' => $converted_amount . ' ' . $currency,
                'charge' => formatAmount($charge),
                'status' => $status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        $admins = Admin::get();
        if ($email_template->status == 'enabled') {
            foreach ($admins as $admin) {
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($admin->email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($admin->email)->send(new EmailNoQueue($body, $subject));
                }
            }
        }

        return true;
    }
}


//send otp
if (!function_exists('sendOtp')) {
    function sendOtp($email, $type)
    {
        //create a new token
        $str = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $otp = strtoupper(substr(str_shuffle($str), 57));
        $expires = strtotime('+ 15 minute', time());

        $email_template = EmailTemplate::where('name', 'otp_mail')->first();
        $subject = $email_template->subject;

        //get the user details based on user role
        if ($type == 'admin') {
            $user = Admin::where('email', $email)->first();
        } elseif ($type == 'user') {
            $user = User::where('email', $email)->first();
        } else {
            return false;
        }


        // dd($type);

        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $body = Blade::render(
            $email_template->body,
            [
                'otp' => $otp,
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


        $otp_detail = [
            'otp' => $otp,
            'expires' => $expires
        ];

        return $otp_detail;


    }
}

if (!function_exists('sendNewLoanRequestEmail')) {
    function sendNewLoanRequestEmail($amount, $interest, $repayment_date)
    {
        $email_template = EmailTemplate::where('name', 'new_loan_request_mail')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'interest' => formatAmount($interest),
                'repayment_date' => date('d-m-y H:i:s', $repayment_date),
                'status' => 'pending',
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to(user('email'))->queue(new Email($body, $subject));
            } else {
                Mail::to(user('email'))->send(new EmailNoQueue($body, $subject));
            }
        }



        //send email to admins
        $email_template = EmailTemplate::where('name', 'new_loan_request_mail_admin')->first();
        $subject = $email_template->subject;

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'interest' => formatAmount($interest),
                'repayment_date' => date('d-m-y H:i:s', $repayment_date),
                'status' => 'pending',
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        $admins = Admin::get();
        if ($email_template->status == 'enabled') {
            foreach ($admins as $admin) {
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($admin->email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($admin->email)->send(new EmailNoQueue($body, $subject));
                }
            }
        }

        return true;

    }
}

//sendNewWithdrawalEmail

if (!function_exists('sendNewWithdrawalEmail')) {
    function sendNewWithdrawalEmail($amount, $fee, $total, $wallet, $wallet_type, $wallet_info, $txn_id, $status)
    {
        if (!$amount || !$fee || !$fee || !$wallet || !$wallet_info || !$status || !$wallet_type || !$txn_id) {
            return false;
        }

        $email_template = EmailTemplate::where('name', 'new_withdrawal_mail')->first();
        $subject = $email_template->subject;

        if ($wallet_type == 'crypto') {
            $info = json_decode($wallet_info);
            $wallet_address = $info->wallet_address;
            $network_type = $info->network_type;
            $payment_info = '<b>Wallet Address:</b> ' . $wallet_address . '<br>' . '<b>Network Type:</b> ' . $network_type . '<br>';
        } elseif ($wallet_type == 'bank') {
            $info = json_decode($wallet_info);
            $bank_name = $info->bank_name;
            $account_name = $info->account_name;
            $account_no = $info->account_no;
            $payment_info = '<b>Bank Name:</b> ' . $bank_name . '<br>' . '<b>Account Name:</b> ' . $account_name . '<br>' . '<b>Account No:</b> ' . $account_no . '<br>';
        } else {
            $info = json_decode($wallet_info);
            $payment_info = '<b>Detail:</b> ' . $info->payment_info . '<br>';
        }

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'fee' => formatAmount($fee),
                'total' => formatAmount($total),
                'wallet' => $wallet,
                'wallet_info' => $payment_info,
                'txn_id' => $txn_id,
                'status' => $status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );


        if ($email_template->status == 'enabled') {
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to(user('email'))->queue(new Email($body, $subject));
            } else {
                Mail::to(user('email'))->send(new EmailNoQueue($body, $subject));
            }

        }

        //send email to admins
        $email_template = EmailTemplate::where('name', 'new_withdrawal_mail_admin')->first();
        $subject = $email_template->subject;

        if ($wallet_type == 'crypto') {
            $info = json_decode($wallet_info);
            $wallet_address = $info->wallet_address;
            $network_type = $info->network_type;
            $payment_info = '<b>Wallet Address:</b> ' . $wallet_address . '<br>' . '<b>Network Type:</b> ' . $network_type . '<br>';
        } elseif ($wallet_type == 'bank') {
            $info = json_decode($wallet_info);
            $bank_name = $info->bank_name;
            $account_name = $info->account_name;
            $account_no = $info->account_no;
            $payment_info = '<b>Bank Name:</b> ' . $bank_name . '<br>' . '<b>Account Name:</b> ' . $account_name . '<br>' . '<b>Account No:</b> ' . $account_no . '<br>';
        } else {
            $info = json_decode($wallet_info);
            $payment_info = '<b>Detail:</b> ' . $info->payment_info . '<br>';
        }

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => user('first_name'),
                'last_name' => user('last_name'),
                'amount' => formatAmount($amount),
                'fee' => formatAmount($fee),
                'total' => formatAmount($total),
                'wallet' => $wallet,
                'wallet_info' => $payment_info,
                'txn_id' => $txn_id,
                'status' => $status,
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        $admins = Admin::get();

        if ($email_template->status == 'enabled') {
            foreach ($admins as $admin) {
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($admin->email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($admin->email)->send(new EmailNoQueue($body, $subject));
                }
            }
        }

        return true;
    }
}

//sendNewSupportTicketEmail($ticket_id)
//send New Ticket 
if (!function_exists('sendNewSupportTicketEmail')) {
    function sendNewSupportTicketEmail($ticket)
    {
        if (!$ticket) {
            return false;
        }

        $email_template = EmailTemplate::where('name', 'new_ticket_mail')->first();
        //$subject = $email_template->subject;
        $subject = Blade::render(
            $email_template->subject,
            [
                'ticket_id' => $ticket->ticket_id,

            ]
        );

        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($ticket->user_id, 'first_name'),
                'last_name' => adminUser($ticket->user_id, 'last_name'),
                'ticket_id' => $ticket->ticket_id,
                'subject' => $ticket->title,
                'message' => json_decode($ticket->message),
                'date' => date('d-m-Y H:i:s', time())

            ]
        );


        if ($email_template->status == 'enabled') {
            $email = adminUser($ticket->user_id, 'email');
            if (websiteInfo('email_queue' == 'enabled')) {
                Mail::to($email)->queue(new Email($body, $subject));
            } else {
                Mail::to($email)->send(new EmailNoQueue($body, $subject));
            }


        }

        //send email to admins
        $email_template = EmailTemplate::where('name', 'new_ticket_mail_admin')->first();
        $subject = Blade::render(
            $email_template->subject,
            [
                'ticket_id' => $ticket->ticket_id,

            ]
        );



        $body = Blade::render(
            $email_template->body,
            [
                'first_name' => adminUser($ticket->user_id, 'first_name'),
                'last_name' => adminUser($ticket->user_id, 'last_name'),
                'ticket_id' => $ticket->ticket_id,
                'subject' => $ticket->title,
                'message' => json_decode($ticket->message),
                'date' => date('d-m-Y H:i:s', time())

            ]
        );
        $admins = Admin::get();
        if ($email_template->status == 'enabled') {
            foreach ($admins as $admin) {
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($admin->email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($admin->email)->send(new EmailNoQueue($body, $subject));
                }
            }
        }


        return true;
    }
}


//sendNewSupportTicketReplyEmail
//send New Ticket 
if (!function_exists('sendNewSupportTicketReplyEmail')) {
    function sendNewSupportTicketReplyEmail($ticket, $from, $reply)
    {
        if (!$ticket || !$from || !$reply) {
            return false;
        }

        if ($from == 'user') {
            //send email notification to admin
            $email_template = EmailTemplate::where('name', 'new_ticket_reply_mail_admin')->first();
            $subject = Blade::render(
                $email_template->subject,
                [
                    'ticket_id' => $ticket->ticket_id,

                ]
            );



            $body = Blade::render(
                $email_template->body,
                [
                    'first_name' => adminUser($ticket->user_id, 'first_name'),
                    'last_name' => adminUser($ticket->user_id, 'last_name'),
                    'ticket_id' => $ticket->ticket_id,
                    'subject' => $ticket->title,
                    'message' => $reply,
                    'date' => date('d-m-Y H:i:s', time())

                ]
            );
            $admins = Admin::get();
            if ($email_template->status == 'enabled') {
                foreach ($admins as $admin) {
                    if (websiteInfo('email_queue' == 'enabled')) {
                        Mail::to($admin->email)->queue(new Email($body, $subject));
                    } else {
                        Mail::to($admin->email)->send(new EmailNoQueue($body, $subject));
                    }

                }
            }



            //also notify the user

            $email_template = EmailTemplate::where('name', 'new_ticket_reply_mail')->first();
            $subject = Blade::render(
                $email_template->subject,
                [
                    'ticket_id' => $ticket->ticket_id,

                ]
            );



            $body = Blade::render(
                $email_template->body,
                [
                    'first_name' => adminUser($ticket->user_id, 'first_name'),
                    'last_name' => adminUser($ticket->user_id, 'last_name'),
                    'ticket_id' => $ticket->ticket_id,
                    'subject' => $ticket->title,
                    'message' => $reply,
                    'date' => date('d-m-Y H:i:s', time())

                ]
            );


            if ($email_template->status == 'enabled') {
                $email = adminUser($ticket->user_id, 'email');
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($email)->send(new EmailNoQueue($body, $subject));
                }
            }

            return true;

        } elseif ($from == 'admin') {
            //send email notification to the user only

            //also notify the user

            $email_template = EmailTemplate::where('name', 'new_ticket_reply_mail')->first();
            $subject = Blade::render(
                $email_template->subject,
                [
                    'ticket_id' => $ticket->ticket_id,

                ]
            );



            $body = Blade::render(
                $email_template->body,
                [
                    'first_name' => adminUser($ticket->user_id, 'first_name'),
                    'last_name' => adminUser($ticket->user_id, 'last_name'),
                    'ticket_id' => $ticket->ticket_id,
                    'subject' => $ticket->title,
                    'message' => $reply,
                    'date' => date('d-m-Y H:i:s', time())

                ]
            );


            if ($email_template->status == 'enabled') {
                $email = adminUser($ticket->user_id, 'email');
                if (websiteInfo('email_queue' == 'enabled')) {
                    Mail::to($email)->queue(new Email($body, $subject));
                } else {
                    Mail::to($email)->send(new EmailNoQueue($body, $subject));
                }
            }

            return true;

        } else {
            return false;
        }

    }
}