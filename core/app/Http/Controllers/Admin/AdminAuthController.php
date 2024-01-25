<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;



class AdminAuthController extends Controller
{
    //login
    public function login()
    {
        $page_title = 'Admin Login';

        return view('admin.auth.login', compact('page_title'));
    }

    //validate login
    public function validateLogin(Request $request)
    {
        // check if google recaptcha is enabled
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'g-recaptcha-response' => 'recaptcha'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot'
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //check if email is valid
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->with('fail', 'Login details does not match our record');
        } else {
            //check password
            $password_check = Hash::check($request->password, $admin->password);
            if (!$password_check) {
                return back()->with('fail', 'Login details does not match our record');
            } else {
                $request->session()->put('adminLoginId', $admin->id);
                if (session()->has('go_back_admin')) {
                    $url =  session()->get('go_back_admin'); //
                    session()->pull('go_back_admin');
                    return redirect($url);
                } else {
                    return redirect(route('admin.dashboard'));
                }
            }
        }
    }




    //forget password form
    public function resetPassword()
    {
        $page_title = 'Forgot Password';

        return view('admin.auth.forgot-password', compact(
            'page_title'
        ));
    }

    //send new password link

    public function validateResetPassword(Request $request)
    {
        //validate input
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'g-recaptcha-response' => 'recaptcha',
                'email' => 'required|email|max:255|min:3'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot'
            ]);
        } else {
            $request->validate([
                'email' => 'required|email|max:255|min:3'
            ]);
        }

        //check if email exisits

        $email_check = Admin::where('email', $request->email)->first();
        if (!$email_check) {
            return back()->with('fail', 'Email does not match our record');
        } else {
            $send_reset_email = sendPasswordResetEmailAdmin($request->email);
            return back()->with('success', 'Password Reset link has been sent to your email');
        }
    }


    //validate link
    public function validateResetPasswordLink(Request $request)
    {

        if (!$request->route('token')) {
            return redirect(route('admin.login'))->with('fail', 'Password reset token does not exist');
        }

        $token = $request->route('token');
        //check if token exists
        $check_token = PasswordReset::where('token', $token)->orderBy('id', 'DESC')->first();
        if (!$check_token) {
            return redirect(route('admin.login'))->with('fail', 'Your password reset link is not valid, please request a new reset link');
        }


        //check if it has expired
        if ($check_token->expires < time()) {
            return redirect(route('admin.login'))->with('fail', 'Your password reset link has expired, please request a new reset link');
        }

        //store the token in the session;
        $request->session()->put('passwordResetToken', $check_token->email);
        return redirect(route('admin.reset.new-password'));
    }


    //new password page
    public function setNewPassword(Request $request)
    {
        if (session()->has('passwordResetToken')) {
            $page_title = 'Set New Password';
            return view('admin.auth.set-new-password', compact('page_title'));
        } else {
            return redirect(route('admin.login'))->with('fail', 'You do not have acess to this page');
        }
    }


    //validate new password
    public function setNewPasswordValidate(Request $request)
    {
        //validate input
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'g-recaptcha-response' => 'recaptcha',
                'password' => 'required|confirmed|max:255|min:8'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot'
            ]);
        } else {
            $request->validate([
                'password' => 'required|confirmed|max:255|min:8'
            ]);
        }

        $admin = Admin::where('email', session()->get('passwordResetToken'))->first();
        $new_admin_password = Admin::find($admin->id);
        $new_admin_password->password = Hash::make($request->password);
        $save_new_password = $new_admin_password->save();
        //notify the admin  that his/her email has been changed.

        $notify_admin = sendPasswordChangedAdmin($admin->email);
        //delete the token from session;
        session()->pull('passwordResetToken');
        return redirect(route('admin.login'))->with('success', 'Your password was changed successfully');
    }

    //logout
    public function logout()
    {
        session()->pull('adminLoginId');
        session()->pull('admin_login_otp');
        return redirect(route('admin.login'))->with('sucess', 'You have logged out successfully');
    }

    //otp
    public function otp()
    {
        $page_title = 'OTP Verification';
        return view('admin.auth.login-otp', compact([
            'page_title'
        ]));
    }

    //validate otp
    public function otpValidate(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        //check if the otp has expired
        if (!session()->has('otp')) {
            return back()->with('fail', 'Request new Otp');
        }

        if (session()->get('otp') != $request->otp) {
            return back()->with('fail', 'Invalid Otp');
        } elseif (session()->get('expires') < time()) {
            return back('fail', 'Your One time password has expired, please request a new one');
        }

        session()->put('admin_login_otp', 'verified');
        session()->pull('otp');
        session()->pull('expires');

        //redirect to privous url
        return redirect(session()->get('go_back_otp'));
    }
}
