<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstallCheck
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
        //check if the installation has been done before
        /*****
         * 
         * I want to check that the request is coming from installation path
         * 
         * if  the request is not coming from the installation path, then verify
         * that the installation has not been done previously.
         */
        $url = $request->path();
        $allowed_urls = [
            'install',
            'install/server',
            'install/permissions',
            'install/database',
            'install/database-validate',
            'install/database-import',
            'install/setting',
            'install/setting-validate',
            'install/complete',
            'install/complete-validate'
        ];

        if (!in_array($url, $allowed_urls) && !file_exists(app_path('installed.txt'))) {
            return redirect(route('install.index'));
        }
        return $next($request);
    }
}
