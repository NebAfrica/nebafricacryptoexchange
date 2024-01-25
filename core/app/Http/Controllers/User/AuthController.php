<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyToken;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    //return the register view
    public function register()
    {
        $page_title = 'Create Account';
        $countries = countryList()['countries'] ?? [];
        return view('themes.' . websiteInfo('theme') . '.user.auth.register', compact(
            'page_title',
            'countries'
        ));
    }

    //get the referral code and pass it in session
    public function ref(Request $request)
    {
        $ref_code = $request->route('code');
        $request->session()->put('ref_code', $request->route('code'));
        return redirect(route('register')); //->with('ref_code', $ref_code);
    }

    //Validate user registration
    public function registerValidate(Request $request)
    {

        //check if google bot verification is enabled by admin
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'first_name' => 'required|max:255|min:3',
                'last_name' => 'required|max:255|min:3',
                'email' => 'required|email|unique:users|max:255|min:5',
                'phone_no' => 'required|max:255|min:8',
                'password' => 'required|max:255|min:8|confirmed',
                //'street_address' => 'required|min:3',
                //'state' => 'required|max:255|min:3',
                //'gender' => 'required|max:255|min:3',
                //'dob' => 'required|max:255|min:3',
                'country' => 'required|max:255|min:3',
                'g-recaptcha-response' => 'recaptcha'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot',
                'dob.required' => 'Date of Birth is required',

            ]);
        } else {
            $request->validate([
                'first_name' => 'required|max:255|min:3',
                'last_name' => 'required|max:255|min:3',
                'email' => 'required|email|unique:users|max:255|min:5',
                'phone_no' => 'required|max:255|min:8',
                'password' => 'required|max:255|min:8|confirmed',
                //'street_address' => 'required|min:3',
                //'state' => 'required|max:255|min:3',
                //'gender' => 'required|max:255|min:3',
                //'dob' => 'required|max:255|min:3',
                'country' => 'required|max:255|min:3',

            ], [

                'dob.required' => 'Date of Birth is required',

            ]);
        }

        //check if email verification is enabled by admin
        if (websiteInfo('email_verification') == 'enabled') {
            $email_verified = 'pending';
        } else {
            $email_verified = 'verified';
        }

        //check if referral code is valid
        $ref_code = $request->referred_by;
        $ref_code_check = User::where('account_id', $ref_code)->first();
        if(!$ref_code_check){
            $ref_code = NULL;
        }

        //generate account id;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str_id = substr(str_shuffle($str), 26);
        $last_user = User::orderBy('id', 'DESC')->first();
        $last_user = $last_user->id ?? 0 + 1;
        $account_id = $str_id . $last_user;





        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->account_id = $account_id;
        $user->password = Hash::make($request->password);
        $user->phone_no = $request->phone_no;
        $user->account_bal = 0;
        $user->email_verified = $email_verified;
        $user->status = 'active';
        $user->dob = $request->dob ?? 'Not Set';
        $user->gender = $request->gender ?? 'Not Set';
        $user->street_address = $request->street_address ?? 'Not Set';
        $user->state = $request->state ?? 'Not Set';
        $user->country = $request->country;
        $user->referred_by = $ref_code;
        $save_user = $user->save();

        if ($save_user) {
            $request->session()->put('loginId', $user->id);
            $request->session()->put('login_otp', 'verified');
            if (websiteInfo('email_verification') == 'enabled') {
                //send verification email                
                sendVerificationEmail();
                //give welcome bonus
                giveWelcomeBonus($account_id);
                return redirect(route('email-verify-resend'))->with('success', 'Email verification link has been sent to your email {' . user('email') . '}. Check your junk/spam folder if you have not received the email');
            } else {
                //send welcome email
                sendWelcomeEmail();
                //give welcome bonus
                giveWelcomeBonus($account_id);
                return redirect(route('user.dashboard'))->with('success', 'Your account has been created successfully');
            }
        } else {
            return back()->with('fail', 'Something went wrong! Your account could not be created');
        }
    }

    //validate verification link
    public function verifyEmail(Request $request)
    {
        if (!$request->route('token')) {
            return redirect(route('user.dashboard'));
        }

        $token = $request->route('token');
        //check if token exists
        $check_token = VerifyToken::where('token', $token)->orderBy('id', 'DESC')->first();
        if (!$check_token) {
            //redirect based on logged in or not
            if (session()->has('loginId')) {
                return redirect(route('email-verify-resend'))->with('fail', 'Your verification token is not valid, please request a new verification link');
            } else {
                return redirect('login')->with('fail', 'Your verification token is not valid, please login to request a new verification link');
            }
        }

        //check if it has expired

        if ($check_token->expires < time()) {
            //redirect based on logged in or not
            if (session()->has('loginId')) {
                return redirect(route('email-verify-resend'))->with('fail', 'Your verification has expired, please request a new verification link');
            } else {
                return redirect('login')->with('fail', 'Your verification link, please login to request a new verification link');
            }
        }

        //verify the user
        $verify_user = User::find($check_token->user_id);
        $verify_user->email_verified = 'verified';
        $result = $verify_user->save();
        if ($result) {
            //delete all tokens from the user
            $delete_token = VerifyToken::where('user_id', $check_token->user_id)->delete();

            //redirect based on logged in or not
            if (session()->has('loginId')) {
                sendWelcomeEmail();
                return redirect(route('user.dashboard'))->with('success', 'Your Email has been verified');
            } else {
                //get the users id
                $user = User::where('id', $check_token->user_id)->first();
                $request->session()->put('loginId', $user->id);
                sendWelcomeEmail();
                return redirect(route('user.dashboard'))->with('success', 'Your email has been verified, please login to contnue');
            }
        }
    }

    //resend verification link

    public function verifyEmailResend()
    {
        $page_title = "Email Verification";

        return view('themes.' . websiteInfo('theme') . '.user.auth.email-verification', compact(
            'page_title',
        ));
    }

    //validate resend verification token
    public function verifyEmailResendValidate(Request $request)
    {
        // check if google recaptcha is enabled
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'g-recaptcha-response' => 'recaptcha'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot'
            ]);
        }

        $send = sendVerificationEmail();
        if ($send) {
            return back()->with('success', 'Verification link has been resent to your email {' . user('email') . '} Check your spam folder if you have not recieved the email');
        } else {
            return back()->with('fail', 'Something went wrong! Please try again later');
        }
    }

    //login
    public function login()
    {
        $url = session()->get('go_back');
        $page_title = 'Login';        
        return view('themes.' . websiteInfo('theme') . '.user.auth.login', compact(
            'page_title'
        ));
    }

    //login validate
    public function loginValidate(Request $request)
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
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('fail', 'Login details does not match our record');
        } else {
            //check if the user is suspended
            if ($user->status == 'suspended') {
                return back()->with('fail', 'Your account is suspended! Contact an admin');
            }
            //check password
            $password_check = Hash::check($request->password, $user->password);
            if (!$password_check) {
                return back()->with('fail', 'Login details does not match our record');
            } else {
                $request->session()->put('loginId', $user->id);
                if (session()->has('go_back')) {
                    $url = session()->get('go_back');
                    session()->pull('go_back');
                    return redirect($url);
                } else {
                    return redirect(route('user.dashboard'));
                }
            }
        }
    }

    //password reset
    public function resetPassword()
    {
        $page_title = 'Forgot Password';
        return view('themes.' . websiteInfo('theme') . '.user.auth.forgot-password', compact([
            'page_title'
        ]));
    }

    //validate password reset 
    public function resetPasswordValidate(Request $request)
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

        ]);

        //check if email is valid
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('fail', 'The email provided do not match our record');
        } else {
            //send reset link
            $send = sendPasswordResetEmail($request->email);
            if ($send) {
                return back()->with('success', 'Your password reset link has been sent to your email');
            } else {
                return back()->with('fail', "Something went wrong! We couldn't send password verification link to your email");
            }
        }
    }

    //validate password reset link
    public function resetPasswordLink(Request $request)
    {
        if (!$request->route('token')) {
            return redirect(route('user.dashboard'));
        }

        $token = $request->route('token');
        //check if token exists
        $check_token = PasswordReset::where('token', $token)->orderBy('id', 'DESC')->first();
        if (!$check_token) {
            return redirect(route('forgot-password'))->with('fail', 'Your password reset link is not valid, please request a new reset link');
        }


        //check if it has expired
        if ($check_token->expires < time()) {
            return redirect(route('forgot-password'))->with('fail', 'Your password reset link has expired, please request a new reset link');
        }

        //Send a temporal password
        sendTempPassword($check_token->email);
        return redirect(route('login'))->with('success', 'Your password has been reset and a temporary password sent to your email.');
    }

    //logout
    public function logout()
    {
        session()->pull('go_back');
        session()->pull('loginId');
        session()->pull('login_otp');
        return redirect(route('login'));
    }

    //otp
    public function otp()
    {
        $page_title = 'OTP Verification';
        return view('themes.' . websiteInfo('theme') . '.user.auth.login-otp', compact([
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

        session()->put('login_otp', 'verified');
        session()->pull('otp');
        session()->pull('expires');

        //redirect to privous url
        return redirect(session()->get('go_back_otp'));
    }
}
