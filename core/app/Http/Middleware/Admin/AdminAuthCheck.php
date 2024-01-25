<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;


class AdminAuthCheck
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
        //check if user is logged in as admin

        if (!session()->has('adminLoginId')) {
            $request->session()->put('go_back_admin', url()->current());
            return redirect(route('admin.login'))->with('fail', 'Please login first');
        }
        return $next($request);
    }
}
