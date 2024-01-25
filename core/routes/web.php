<?php

use App\Http\Controllers\Cron\CronController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\General\OtpController;
use App\Http\Controllers\General\AssetController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\InvestmentController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Development Routes starts here. This won't be used in production
use Illuminate\Support\Facades\Route;


//php info
Route::get('php', function () {
    if(env('APP_DEBUG') == true) {
        phpinfo();
    } else {
        return redirect(url('/'));
    }
    
    
})->name('php');




//Front routes
Route::get('/', [HomeController::class, 'home'])->name('index');
Route::get('about-us', [HomeController::class, 'about'])->name('about');
Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::post('contact-us', [HomeController::class, 'contactValidate'])->name('contact-validate');
Route::get('investment-and-loan-plans', [HomeController::class, 'plans'])->name('plans');
Route::get('blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('blog/{slug}', [HomeController::class, 'blogDetail'])->name('blog-detail');
Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

//Queue Route
Route::get('queue', function () {
    //requeue failed jobs
    $failed = Illuminate\Support\Facades\Artisan::call('queue:retry all');
    //return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
    //stop existing jobs
    $stop = Illuminate\Support\Facades\Artisan::call('queue:restart');
    //start queue again
    $start = Illuminate\Support\Facades\Artisan::call('queue:work');
    return 'Queue Started successfully';
})->name('queue');

/***********
 * Cache routes here,
 * would be moved to moved to controller or add
 * a redirect function when used in production
 */
Route::get('clear-cache', function () {
    $cache = Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return redirect(url()->previous());
})->name('clear-cache');

//cron route
Route::get('cron', [CronController::class, 'cron'])->name('cron');
//resend otp
Route::post('resend-otp', [OtpController::class, 'resendOtp'])->name('resend-otp');

//Front End routes
//1. Auth routes
Route::middleware(['onlyLoggedOut'])->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('ref/{code}', [AuthController::class, 'ref'])->name('ref');
    Route::post('register', [AuthController::class, 'registerValidate'])->name('register-validate');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginValidate'])->name('login-validate')->middleware('throttle:login.email');
    Route::get('forgot-password', [AuthController::class, 'resetPassword'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'resetPasswordValidate'])->name('forgot-password-validate')->middleware('throttle:login.email');
    Route::get('reset/{token}', [AuthController::class, 'resetPasswordLink'])->name('forgot-password-link');
});

//2. Email Verification route
Route::get('verify/{token}', [AuthController::class, 'verifyEmail']);
Route::middleware(['emailVerified'])->group(function () {
    Route::get('email-verification', [AuthController::class, 'verifyEmailResend'])->name('email-verify-resend');
    Route::post('email-verification', [AuthController::class, 'verifyEmailResendValidate'])->name('email-verify-resend-validate')->middleware('throttle:login.email');
});

//front end routes ends

//User Routes
//User OTP
Route::get('login-otp', [AuthController::class, 'otp'])->middleware(['onlyLoggedIn'])->name('login-otp');
Route::post('login-otp', [AuthController::class, 'otpValidate'])->middleware(['onlyLoggedIn', 'throttle:otp.user'])->name('login-otp-validate');

Route::prefix('user')->name('user.')->middleware(['onlyLoggedIn', 'loginOtpCheck'])->group(function () {
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //Account Routes
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'profile'])->name('profile');
        Route::get('edit', [AccountController::class, 'edit'])->name('edit');
        Route::post('general', [AccountController::class, 'general'])->name('general');
        Route::post('password', [AccountController::class, 'password'])->name('password');

    });

    //if id verification is enabled
    Route::middleware('idCheck')->group(function () {
        //Every route defined in this group will be checked for user identity verification

        //deposit route
        Route::name('deposit.')->prefix('deposits')->group(function () {
            Route::get('/', [DepositController::class, 'index'])->name('index');
            Route::get('view/{user_id}/{id}', [DepositController::class, 'view'])->name('view');
            Route::get('new', [DepositController::class, 'deposit'])->name('new');
            Route::post('pay', [DepositController::class, 'pay'])->name('pay');
            

        });

        //Investment Routes
        Route::prefix('investments')->name('investments.')->group(function () {
            Route::get('/', [InvestmentController::class, 'index'])->name('index');
            Route::get('new', [InvestmentController::class, 'new'])->name('new');
            Route::post('new', [InvestmentController::class, 'newValidate'])->name('new-validate');
            Route::get('new/cancel', [InvestmentController::class, 'cancel'])->name('cancel');
        });

        //Wallet Routes
        Route::prefix('wallets')->name('wallets.')->group(function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('view/{id}', [WalletController::class, 'view'])->name('view');
            Route::get('edit/{id}', [WalletController::class, 'edit'])->name('edit');
            Route::post('edit', [WalletController::class, 'editValidate'])->name('edit-validate');
            Route::get('new', [WalletController::class, 'new'])->name('new');
            Route::post('new', [WalletController::class, 'newValidate'])->name('new-validate');
            Route::post('delete/{id}', [WalletController::class, 'delete'])->name('delete');
            Route::post('cancel', [WalletController::class, 'cancel'])->name('cancel');

        });

        //Withdrawal routes
        Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('index');
            Route::get('view/{id}', [WithdrawalController::class, 'view'])->name('view');
            Route::get('new', [WithdrawalController::class, 'new'])->name('new');
            Route::post('new', [WithdrawalController::class, 'newValidate'])->name('new-validate');

        });

        //transaction route
        Route::get('transactions', [TransactionController::class, 'transactions'])->name('transactions');

    });

});

//whatsapp
Route::get('whatsapp', function(){
    $whatsapp = json_decode(websiteInfo('whatsapp'));
    $no = str_replace('+', '', $whatsapp->no);    
    $url = 'https://api.whatsapp.com/send/?phone=' . $no . '&text=' . urlencode(request()->message);    
    return redirect($url);
})->name('whatsapp');

//installation
Route::prefix('install')->name('install.')->middleware('installed')->group(function () {
    Route::get('/', [\App\Http\Controllers\Installer\InstallationController::class, 'index'])->name('index');
    Route::get('server', [\App\Http\Controllers\Installer\InstallationController::class, 'server'])->name('server');
    Route::get('permissions', [\App\Http\Controllers\Installer\InstallationController::class, 'permissions'])->name('permissions');
    Route::get('database', [\App\Http\Controllers\Installer\InstallationController::class, 'database'])->name('database');
    Route::post('database-validate', [\App\Http\Controllers\Installer\InstallationController::class, 'databaseValidate'])->name('database-validate');
    Route::get('database-import', [\App\Http\Controllers\Installer\InstallationController::class, 'databaseImport'])->name('database-import');
    Route::get('setting', [\App\Http\Controllers\Installer\InstallationController::class, 'setting'])->name('setting');
    Route::post('setting-validate', [\App\Http\Controllers\Installer\InstallationController::class, 'settingValidate'])->name('setting-validate');
    Route::get('complete', [\App\Http\Controllers\Installer\InstallationController::class, 'complete'])->name('complete');
    Route::post('complete-validate', [\App\Http\Controllers\Installer\InstallationController::class, 'completeValidate'])->name('complete-validate');
});


//file manager
Route::get('files/{folder?}/{file?}', [AssetController::class, 'filePermission'])->name('file');
Route::get('images/{folder?}/{file?}', [AssetController::class, 'imageViewer'])->name('image');
Route::get('setlocale', function(){
    $locale = request()->locale ?? 'en';
    session()->put('locale', $locale);
    $url = request()->return_to;
    return redirect($url);
})->name('setlocale');
