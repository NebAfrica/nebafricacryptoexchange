<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;


class AdminNoAuthCheck
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
        //check if user is already logged in as admin

        if (session()->has('adminLoginId')) {
            return redirect(route('admin.dashboard'))->with('fail', 'You are are already logged');
        }
        return $next($request);
    }
}
