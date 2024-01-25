<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstalledCheck
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
        if (file_exists(app_path('installed.txt'))) {
            return redirect(url('/'));
        }
        return $next($request);
    }
}
