<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;



class UserManagerController extends Controller
{
    //index
    public function index(Request $request)
    {
        $page_title = 'Users';
        $all_users = User::get();
        $users = $all_users;

        //users by query
        $allowed_queries= [
            'referred_by',
            'status',
            'id_verified',
            'email_verified'
        ];

        if ($request->has('users_query') && $request->has('users_by')) {
            
            //avoid exception errors for wrong column
            $users_query = $request->users_query;
            $users_by = $request->users_by;
            if(in_array($users_query, $allowed_queries)) {
                $users = $all_users->where($users_query, $users_by);
            } else {
                return redirect('admin.users.index')->with('fail', 'Invalid Query');
            }
            
        }        

        //infograpics
        $total_users = $all_users->count();
        $active_users = $all_users->where('status', 'active')->count();
        $suspended_users = $all_users->where('status', 'suspended')->count();
        $email_verified = $all_users->where('email_verified', 'verified')->count();
        $pending_email_verification = $all_users->where('email_verified', '!=', 'verified')->count();
        $id_verified = $all_users->where('id_verified', 'verified')->count();
        $pending_id_verification = $all_users->where('id_verified', '!=', 'verified')->count();

        return view('admin.users.index', compact(
            'page_title',
            'users',
            'total_users',
            'active_users',
            'suspended_users',
            'email_verified',
            'pending_email_verification',
            'id_verified',
            'pending_id_verification'
        ));
    }

    //View User
    public function view(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        //check if the user exist 
        if (!$user) {
            return redirect(route('admin.users.index'))->with('fail', 'This user does not exist');
        }

        $page_title = $user->first_name . ' ' . $user->last_name;

        //summary
        $total_deposits = Deposit::where('user_id', $user->id)->sum('amount');
        $total_withdrawals = Withdrawal::where('user_id', $user->id)->sum('amount');
        $total_investments = Investment::where('user_id', $user->id)->sum('amount');
        $total_profits = Investment::where('user_id', $user->id)->sum('total_profit_earned');
        $total_referrals = User::where('referred_by', $user->account_id)->count();
        $total_referral_earnings = Transaction::where('user_id', $user->id)->where('method', 'Referral Bonus')->sum('amount');


        return view('admin.users.view', compact(
            'page_title',
            'user',
            'total_deposits',
            'total_withdrawals',
            'total_investments',
            'total_profits',
            'total_referrals',
            'total_referral_earnings',
        ));
    }

    //credit / debit user
    public function creditDebit(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'action' => 'required'
        ]);

        //get the user
        $user = User::where('id', $request->user_id)->first();
        if (!$user) {
            return back()->with('fail', 'This user does not exist');
        }

        $amount = $request->amount;
        $user_id = $request->user_id;
        $action = $request->action;

        //check action type
        if ($request->action == 'debit') {
            //check if the user's balance is more than the debit amount
            if ($user->account_bal < $amount) {
                return back()->with('fail', 'Insufficient balance for the debit amount specified');
            }

            //debit the user
            $new_bal = $user->account_bal - $amount;
            $debit = User::find($user->id);
            $debit->account_bal = $new_bal;
            $save_debit = $debit->save();

            if ($save_debit) {
                //Record Transaction
                $user_id = $user->id;
                $type = $action;
                $method = 'Manual Debit';
                $remark = 'Manaul Debit';

                recordNewTransaction($user_id, $type, $amount, $method, $new_bal, $remark);
                return back()->with('success', $user->first_name . ' has been debited');
            } else {
                return back()->with('fail', 'Something went wrong, try again later');
            }
        } elseif ($request->action == 'credit') {

            //credit the user
            $new_bal = $user->account_bal + $amount;
            $credit = User::find($user->id);
            $credit->account_bal = $new_bal;
            $save_credit = $credit->save();

            if ($save_credit) {
                //Record Transaction
                $user_id = $user->id;
                $type = $action;
                $method = 'Manual Credit';
                $remark = 'Manaul Credit';

                recordNewTransaction($user_id, $type, $amount, $method, $new_bal, $remark);
                return back()->with('success', $user->first_name . ' has been credited');
            } else {
                return back()->with('fail', 'Something went wrong, try again later');
            }
        } else {
            return back()->with('fail', 'Unrecognized action type');
        }
    }

    //edit user 
    public function edit(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        //check if the user exist
        if (!$user) {
            return redirect(route('admin.users.index'))->with('fail', 'The user you are trying to access does not exist');
        }

        $page_title = 'Edit ' . $user->first_name;
        $countries = countryList()['countries'] ?? [];

        return view('admin.users.edit', compact(
            'page_title',
            'user',
            'countries'
        ));
    }

    //validate user Edit

    public function editValidate(Request $request)
    {
        //input validation
        $request->validate([
            'user_id' => 'required|numeric',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'email_verified' => 'required',
            'id_verified' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'g2fa' => 'required',

        ]);

        //check if the user exists 
        $user = User::where('id', $request->user_id)->first();
        if (!$user) {
            return redirect(route('admin.users.index'))->with('fail', 'The user you are trying to edit does not exist');
        }

        $profile_picture = $user->profile_picture;

        //check if a new profile is added
        if ($request->file('profile_picture')) {
            $upload  = uploadImage($request->profile_picture, 'profile');
            $profile_picture = $upload;
        }


        //save to database
        $edit = User::find($user->id);
        $edit->first_name = $request->first_name;
        $edit->last_name = $request->last_name;
        $edit->email = $request->email;
        $edit->phone_no = $request->phone_no;
        $edit->email_verified = $request->email_verified;
        $edit->id_verified = $request->id_verified;
        $edit->status = $request->status;
        $edit->gender = $request->gender;
        $edit->dob = $request->dob;
        $edit->street_address = $request->street_address;
        $edit->state = $request->state;
        $edit->country = $request->country;
        $edit->g2fa = $request->g2fa;
        $edit->profile_picture = $profile_picture;

        $save_edit = $edit->save();

        if ($save_edit) {
            return back()->with('success', $edit->first_name . ' editted successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    //status change
    public function status(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        //check if the user exist
        if (!$user) {
            return redirect(route('admin.users.index'))->with('fail', 'The user you are trying to edit does not exist');
        }

        $action = $request->action;
        //perfrm action
        if ($action == 'suspend') {
            $suspend = User::find($user->id);
            $suspend->status = 'suspended';
            $suspend->save();

            return back()->with('success', $user->first_name . ' has been suspended');
        } elseif ($action ==  'reactivate') {
            $reactivate = User::find($user->id);
            $reactivate->status = 'active';
            $reactivate->save();

            return back()->with('success', $user->first_name . ' has been reactivated');
        } else {
            return back()->with('fail', ' Unrecognized operation');
        }
    }

    //delete user
    public function delete(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        //check if the user exist
        if (!$user) {
            return redirect(route('admin.users.index'))->with('fail', 'The user you are trying to edit does not exist');
        }

        $delete = $user->delete();

        if ($delete) {
            return redirect(route('admin.users.index'))->with('success', 'User deleted successfully');
        } else {
            return redirect(route('admin.users.index'))->with('fail', 'Something went wrong!');
        }
    }

    //send email to users
    public function sendEmail(Request $request)
    {
        $page_title = 'Email Users';

        $users = User::get();

        return view('admin.users.email', compact(
            'page_title',
            'users'
        ));
    }

    //validate email sending
    public function sendEmailValidate(Request $request)
    {
        //validate basedon single or mulitple emails
        if ($request->email) {
            $request->validate([
                'email' => 'required|email'
            ]);
            $emails = [
                $request->email

            ];
        } elseif ($request->emails) {
            $emails = $request->emails;
        } elseif (session()->has('eamils')) {
            $emails = session()->get('emails');
        }

        //check if the subject and messsage is set
        if (!$request->subject || !$request->message) {
            session()->put('emails', $emails);

            return redirect(route('admin.users.email'));
        }

        $message = $request->message;
        $subject = $request->subject;



        //send email 
        $send_emails = bulkEmail($emails, $message, $subject);
        session()->pull('emails');

        $url = $request->return_url ?? route('admin.users.index');

        return redirect($url)->with('success', "Email Sent");
    }

    //change users password
    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);
        $user->password  = Hash::make($request->password);
        $save = $user->save();


        if ($save) {
            return back()->with('success', "User password changed successfully");
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    //login as user
    public function loginAsUser(Request $request)
    {
        $request->session()->put('loginId', $request->user_id);
        $request->session()->put('login_otp', 'verified');
        $request->session()->put('login_as_user', 'admin');
        $request->session()->put('admin_url', urldecode($request->admin_url));

        return redirect(route('user.dashboard'));
    }

    //return to admin

    public function adminGoBack(Request $request)
    {
        $admin_go_url = session()->get('admin_url');
        $request->session()->pull('loginId');
        $request->session()->pull('login_otp');
        $request->session()->pull('login_as_user');
        $request->session()->pull('admin_url');

        return redirect($admin_go_url);
    }

    //actions
    public function actions(Request $request)
    {
        $request->validate([
            'action' => 'required',
            'emails' => 'required'
        ], [
            'emails.required' => 'Select at least one user'
        ]);

        $action = $request->action;
        $emails = $request->emails;
        if ($action == 'send_email') {
            //send to the selected users
            session()->put('emails', $emails);
            return redirect(route('admin.users.email'));
        } elseif ($action == 'suspend') {
            //suspend selected users
            foreach ($emails as $email) {
                $user = User::where('email', $email)->first();

                $suspend = User::find($user->id);
                $suspend->status = 'suspended';
                $save = $suspend->save();
            }

            return back()->with('success', 'Users has been suspended');
        } elseif ($action == 'reactivate') {
            //reactivate selected users
            foreach ($emails as $email) {
                $user = User::where('email', $email)->first();

                $reactivate = User::find($user->id);
                $reactivate->status = 'active';
                $save = $reactivate->save();
            }

            return back()->with('success', 'Users has been reactivated');
        } elseif ($action == 'delete') {
            //delete selected users
            foreach ($emails as $email) {
                $user = User::where('email', $email)->first();
                $user->delete();
            }

            return back()->with('success', 'Users has been deleted');
        }
    }
}
