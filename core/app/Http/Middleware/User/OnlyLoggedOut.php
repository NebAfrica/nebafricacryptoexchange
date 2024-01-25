<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;


class OnlyLoggedOut
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
        //check if a user is already logged in
        if(session()->has('loginId')){
            return redirect(route('user.dashboard'))->with('fail', 'You are alreay logged in');
        }
        return $next($request);
    }
}
