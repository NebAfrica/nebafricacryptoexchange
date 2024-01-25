<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;


class LoginOtpCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //check if for login otp
        if(websiteInfo('login_otp_user') == 'enabled' && !session()->has('login_otp')){
            //store the url in session
            $request->session()->put('go_back_otp', url()->current());
            $send_otp = sendOtp(user('email'), 'user');

            if($send_otp){
                session()->put('otp', $send_otp['otp']);
                session()->put('expires', $send_otp['expires']);
            }
            return redirect(route('login-otp'));
        }
        return $next($request);
    }
}
