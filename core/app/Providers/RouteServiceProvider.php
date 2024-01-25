<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'install'])
                ->group(base_path('routes/web.php'));

            //admin routes

            Route::middleware(['web', 'install'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            //Payment routes
            Route::middleware(['web', 'install'])
                ->prefix('gateway')
                ->name('gateway.')
                ->group(base_path('routes/gateway.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(600)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login.email', function (Request $request) {
            return [
                Limit::perMinute(3)->by($request->input('email')),
            ];
        });

        RateLimiter::for('otp.user', function (Request $request) {
            return [
                Limit::perMinute(3)->by(user('id')),
            ];
        });

        RateLimiter::for('otp.admin', function (Request $request) {
            return [
                Limit::perMinute(3)->by(admin('id')),
            ];
        });
    }
}
