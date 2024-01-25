<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GateWays\PaystackController;

use App\Http\Controllers\GateWays\MonnifyController;


/*
|--------------------------------------------------------------------------
| Payment Proccessor Routes Routes
|--------------------------------------------------------------------------
|
| Only admin specific routes are contained here, for user and front end routes, go to web.php
|
*/

//logged out admin routes
Route::middleware('onlyLoggedIn')->group(function () {


    //paystack
    Route::prefix('paystack')->name('paystack.')->group(function () {
        Route::get('/', [PaystackController::class, 'index'])->name('index');
        Route::post('pay', [PaystackController::class, 'pay'])->name('pay');
        Route::get('callback', [PaystackController::class, 'callback'])->name('callback');
    });

    
});
