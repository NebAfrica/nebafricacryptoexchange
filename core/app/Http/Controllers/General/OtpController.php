<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OtpController extends Controller
{
    //send otp to user
    public function resendOtp(Request $request)
    {
        //if(websiteInfo('transfer_otp') == 'enabled'){

        if (session()->has('loginId') && !session()->has('login_as_user')) {
            //limit resend to 1 minute
            $fourten_minutes = Carbon::now()->addMinutes(14)->timestamp;
            if(session()->has('otp') && $fourten_minutes < session()->get('expires')) {
                abort(419);
            }
            $send_otp = sendOtp(user('email'), 'user');
            session()->put('otp', $send_otp['otp']);
            session()->put('expires', $send_otp['expires']);
        } elseif (session()->has('adminLoginId')) {
            $send_otp = sendOtp(admin('email'), 'admin');
            session()->put('otp', $send_otp['otp']);
            session()->put('expires', $send_otp['expires']);
        } else {
            abort(401);
        }

        return response()->json([
            'status' => 'success',
        ], 200);
    }

}
