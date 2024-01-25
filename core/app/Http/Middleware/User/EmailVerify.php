<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;


class EmailVerify
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
        return redirect(route('login'))->with('fail', 'Please log in first');
        }
        //check if email is verified
        if(user('email_verified') == 'verified'){            
            return redirect(route('user.dashboard'))
                ->with('fail', 'Your email is already verified');
                
        }
        return $next($request);
    }
}
