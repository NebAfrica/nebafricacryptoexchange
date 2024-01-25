<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class AdminLoginOtpCheck
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
        if (websiteInfo('login_otp_admin') == 'enabled' && !session()->has('admin_login_otp')) {
            //store the url in session
            $request->session()->put('go_back_otp', url()->current());
            $send_otp = sendOtp(admin('email'), 'admin');

            if ($send_otp) {
                session()->put('otp', $send_otp['otp']);
                session()->put('expires', $send_otp['expires']);
            }
            return redirect(route('admin.login-otp'));
        }
        return $next($request);
    }
}
