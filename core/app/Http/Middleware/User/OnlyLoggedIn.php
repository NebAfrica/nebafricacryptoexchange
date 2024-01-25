<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;


class OnlyLoggedIn
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
        //check if a user is not logged in
        if(!session()->has('loginId')){            
            $request->session()->put('go_back', url()->current());            
            return redirect(route('login'))->with('fail', 'Please log in first');
        }

        //termiate session for the suspended user if already logged in before being suspended
        if(user('status') == 'suspended'){
            session()->flush();

            return redirect(route('login'))->with('fail', 'Your account has been suspended, contact support');
        }
        //check if email is verified
        if(websiteInfo('email_verification') == 'enabled' && user('email_verified') != 'verified'){
            sendVerificationEmail();
            return redirect(route('email-verify-resend'))
                ->with('fail', 'Your email address is not verified')
                ->with('success', 'Email verification link has been sent to your email {'. user('email').'} Check your junk/spam folder if you have not received it');
        }

        
        return $next($request);
    }
}
