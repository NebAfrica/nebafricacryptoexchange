<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IdVerification;


class IdVerificationCheck
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
        //check if admin enabled email verification
        if(websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc')){
            //check if the user is verifified
            if(user('id_verified') != 'verified' && !session()->has('login_as_user')){
                return redirect(route('user.id.status'))->with('fail', 'Please verify your identity');
            }
        }
        return $next($request);
    }
}
