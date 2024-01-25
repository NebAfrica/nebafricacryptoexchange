<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminInvestmentPlanController;
use App\Http\Controllers\Admin\AdminInvestmentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminWalletController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AddonInstaller;
use App\Http\Controllers\Admin\Theme\ExportController;
use App\Http\Controllers\Admin\Theme\UploadController;
use App\Http\Controllers\Admin\Theme\InstallController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CustomFunctionController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\SystemController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Only admin specific routes are contained here, for user and front end routes, go to web.php
|
*/

Route::get('/', function(){
    return redirect(route('admin.dashboard'));
})->name('index');

//logged out admin routes
Route::middleware('adminNoAuthCheck')->group(function(){
    Route::get('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthController::class, 'validateLogin'])->name('login-validate')->middleware( 'throttle:login.email');
    Route::get('password-reset', [AdminAuthController::class, 'resetPassword'])->name('password-reset');
    Route::post('pasword-reset', [AdminAuthController::class, 'validateResetPassword'])->name('password-reset-validate');
    Route::get('reset/{token}', [AdminAuthController::class, 'validateResetPasswordLink'])->middleware( 'throttle:login.email');
    Route::get('reset-password/new-password', [AdminAuthController::class, 'setNewPassword'])->name('reset.new-password');
    Route::post('reset-password/new-password', [AdminAuthController::class, 'setNewPasswordValidate'])->name('reset.new-password-validate');
});

//Adin OTP
Route::get('login-otp',[AdminAuthController::class, 'otp'])->middleware('adminAuthCheck')->name('login-otp');
Route::post('login-otp',[AdminAuthController::class, 'otpValidate'])->middleware(['adminAuthCheck', 'throttle:otp.admin'])->name('login-otp-validate');

//logged in admin routes
Route::middleware(['adminAuthCheck', 'adminLoginOtpCheck'])->group(function(){
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout'); //logout
    Route::get('dashbaord', [AdminDashboardController::class, 'dashboard'])->name('dashboard'); //dashboard
     

    //Deposit Route
    Route::prefix('deposits')->name('deposits.')->group(function(){
        Route::get('/', [AdminDepositController::class, 'index'])->name('index');
        Route::get('view/{id}', [AdminDepositController::class, 'viewDeposit'])->name('view');
        Route::post('process', [AdminDepositController::class, 'processDeposit'])->name('process');
        Route::post('delete', [AdminDepositController::class, 'deleteDeposit'])->name('delete');
        Route::post('action', [AdminDepositController::class, 'bulkDelete'])->name('action');
    });

    

    //investment plans
    Route::prefix('investment-plans')->name('investment-plans.')->group(function(){
        Route::get('/', [AdminInvestmentPlanController::class, 'index'])->name('index');
        Route::get('edit/{id}', [AdminInvestmentPlanController::class, 'edit'])->name('edit');
        Route::post('edit', [AdminInvestmentPlanController::class, 'editValidate'])->name('edit-validate');
        Route::get('new', [AdminInvestmentPlanController::class, 'new'])->name('new');
        Route::post('new', [AdminInvestmentPlanController::class, 'newValidate'])->name('new-validate');
        Route::post('delete/{id}', [AdminInvestmentPlanController::class, 'delete'])->name('delete');
        
    });

    //investments
    Route::prefix('investments')->name('investments.')->group(function(){
        Route::get('/', [AdminInvestmentController::class, 'index'])->name('index');
        Route::post('suspend/{id}', [AdminInvestmentController::class, 'suspend'])->name('suspend');
        Route::post('reactivate/{id}', [AdminInvestmentController::class, 'reactivate'])->name('reactivate');
        Route::post('delete/{id}', [AdminInvestmentController::class, 'delete'])->name('delete');
        Route::post('action', [AdminInvestmentController::class, 'action'])->name('action');
        
    });

    //Settings
    Route::prefix('settings')->name('settings.')->group(function(){
        //email templates and config
        Route::get('email-templates', [SettingsController::class, 'emailTemplates'])->name('email-templates');
        Route::get('email-templates/edit/{id}', [SettingsController::class, 'editEmailTemplate'])->name('edit-email-template');
        Route::post('email-templates/edit', [SettingsController::class, 'editEmailTemplateValidate'])->name('edit-email-template-validate');
        Route::get('email-config', [SettingsController::class, 'emailConfig'])->name('email-config');
        Route::post('email-config', [SettingsController::class, 'emailConfigValidate'])->name('email-config-validate');
        //Payment gateway settings
        Route::prefix('gateways')->name('gateways.')->group(function(){
            Route::get('/', [SettingsController::class, 'gateways'])->name('index');
            Route::get('edit/{id}', [SettingsController::class, 'edit'])->name('edit');
            Route::post('edit', [SettingsController::class, 'editValidate'])->name('edit-validate');
            Route::post('status', [SettingsController::class, 'gatewayStatus'])->name('status');
            
        });

        //Website Core setting 
        Route::get('core', [SettingsController::class, 'core'])->name('core');
        Route::post('core', [SettingsController::class, 'coreValidate'])->name('core-validate');
        

        //Transfer, loan and withdrawal Setting 
        Route::get('misc', [SettingsController::class, 'misc'])->name('misc');
        Route::post('misc', [SettingsController::class, 'miscValidate'])->name('misc-validate');

        //Security and OTP
        Route::get('security-otp', [SettingsController::class, 'security'])->name('security-otp');
        Route::post('security-otp', [SettingsController::class, 'securityValidate'])->name('security-otp-validate');

        //Livechat
        Route::get('livechat', [SettingsController::class, 'livechat'])->name('livechat');
        Route::post('livechat', [SettingsController::class, 'livechatValidate'])->name('livechat-validate');

        //custom css
        Route::get('custom-css', [SettingsController::class, 'customCss'])->name('custom-css');
        Route::post('custom-css', [SettingsController::class, 'customCssValidate'])->name('custom-css-validate');

        //custom js
        Route::get('custom-js', [SettingsController::class, 'customJs'])->name('custom-js');
        Route::post('custom-js', [SettingsController::class, 'customJsValidate'])->name('custom-js-validate');

        //custom php
        Route::get('custom-php', [CustomFunctionController::class, 'customPhp'])->name('custom-php');
        Route::post('custom-php', [CustomFunctionController::class, 'customPhpValidate'])->name('custom-php-validate');
        
        //Logo and SEO
        Route::get('logo-seo', [SettingsController::class, 'logoSeo'])->name('logo-seo');
        Route::post('logo-seo', [SettingsController::class, 'logoSeoValidate'])->name('logo-seo-validate');

        //theme manager
        Route::prefix('theme-manager')->name('theme-manager.')->group(function(){
            Route::get('/', [SettingsController::class, 'themes'])->name('themes');
            Route::get('new-theme', [SettingsController::class, 'newTheme'])->name('new-theme');
            Route::post('new-theme', [SettingsController::class, 'newThemeValidate'])->name('new-theme-validate');
            Route::get('delete-theme/{name}', [SettingsController::class, 'deleteTheme'])->name('delete-theme');
            Route::post('delete-theme-validate', [SettingsController::class, 'deleteThemeValidate'])->name('delete-theme-validate');
            Route::post('export-theme', [ExportController::class, 'exportTheme'])->name('export-theme');
            Route::get('exports', [ExportController::class, 'exports'])->name('exports');
            Route::post('upload', [UploadController::class, 'uploadTheme'])->name('upload');
            Route::post('install', [InstallController::class, 'installTheme'])->name('install');
        });

        //section settings
        Route::get('sections', [SettingsController::class, 'sections'])->name('sections.index');
        Route::get('sections/edit/{id}', [SettingsController::class, 'editSection'])->name('sections.edit');
        Route::post('sections/edit/{id}', [SettingsController::class, 'editSectionValidate'])->name('sections.edit-validate');
        Route::post('sections', [SettingsController::class, 'sectionsAjax'])->name('sections.ajax');
       

        
    });

    //Wallets
    Route::prefix('wallets')->name('wallets.')->group(function(){
        Route::get('/', [AdminWalletController::class, 'index'])->name('index');
        Route::get('view/{id}', [AdminWalletController::class, 'view'])->name('view');
        Route::post('delete/{id}', [AdminWalletController::class, 'delete'])->name('delete');
        
    });

    //Withdrawals
    Route::prefix('withdrawals')->name('withdrawals.')->group(function(){
        Route::get('/', [AdminWithdrawalController::class, 'index'])->name('index');
        Route::get('pending', [AdminWithdrawalController::class, 'pending'])->name('pending');
        Route::get('view/{id}', [AdminWithdrawalController::class, 'view'])->name('view');
        Route::post('process', [AdminWithdrawalController::class, 'process'])->name('process');
        Route::post('delete/{id}', [AdminWithdrawalController::class, 'delete'])->name('delete');
        
    });

    //transactions 
    Route::prefix('transactions')->name('transactions.')->group(function(){
        Route::get('/', [AdminTransactionController::class, 'index'])->name('index');
        Route::post('delete/{id}', [AdminTransactionController::class, 'delete'])->name('delete');
        Route::post('action', [AdminTransactionController::class, 'action'])->name('action');
        
    });

    

    //Users manager
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/', [UserManagerController::class, 'index'])->name('index');  
        Route::get('view/{id}', [UserManagerController::class, 'view'])->name('view');    
        Route::post('credit-debit', [UserManagerController::class, 'creditDebit'])->name('credit-debit');
        Route::get('edit/{id}', [UserManagerController::class, 'edit'])->name('edit'); 
        Route::post('edit', [UserManagerController::class, 'editValidate'])->name('edit-validate');
        Route::post('status', [UserManagerController::class, 'status'])->name('status'); 
        Route::post('delete', [UserManagerController::class, 'delete'])->name('delete'); 
        Route::get('email', [UserManagerController::class, 'sendEmail'])->name('email');     
        Route::post('email', [UserManagerController::class, 'sendEmailValidate'])->name('email-validate');
        Route::post('password', [UserManagerController::class, 'password'])->name('password');
        Route::post('login-as-user/{user_id}', [UserManagerController::class, 'loginAsUser'])->name('login-as-user');
        Route::get('admin-go-back', [UserManagerController::class, 'adminGoBack'])->name('admin-go-back');
        Route::post('actions', [UserManagerController::class, 'actions'])->name('action');   
        Route::get('by-status/{user_status}', [UserManagerController::class, 'byStatus'])->name('by-status');

        
        
    });

    //Account setting
    Route::prefix('account')->name('account.')->group(function(){
        Route::get('/', [AdminAccountController::class, 'profile'])->name('profile');
        Route::post('general', [AdminAccountController::class, 'general'])->name('general');
        Route::post('password', [AdminAccountController::class, 'password'])->name('password');
        
    });  

    //faqs 
    Route::prefix('faqs')->name('faqs.')->group(function(){
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('edit/{id}', [FaqController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [FaqController::class, 'editValidate'])->name('edit-validate');
        Route::get('new', [FaqController::class, 'new'])->name('new');
        Route::post('new', [FaqController::class, 'newValidate'])->name('new-validate');
        Route::post('delete', [FaqController::class, 'delete'])->name('delete');
    });

    //teams 
    Route::prefix('teams')->name('teams.')->group(function(){
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::get('edit/{id}', [TeamController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [TeamController::class, 'editValidate'])->name('edit-validate');
        Route::get('new', [TeamController::class, 'new'])->name('new');
        Route::post('new', [TeamController::class, 'newValidate'])->name('new-validate');
        Route::post('delete', [TeamController::class, 'delete'])->name('delete');
    });

    //teams 
    Route::prefix('testimonials')->name('testimonials.')->group(function(){
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [TestimonialController::class, 'editValidate'])->name('edit-validate');
        Route::get('new', [TestimonialController::class, 'new'])->name('new');
        Route::post('new', [TestimonialController::class, 'newValidate'])->name('new-validate');
        Route::post('delete', [TestimonialController::class, 'delete'])->name('delete');
    });

    //blogs 
    Route::prefix('blogs')->name('blogs.')->group(function(){
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('edit/{id}', [AdminBlogController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [AdminBlogController::class, 'editValidate'])->name('edit-validate');
        Route::get('new', [AdminBlogController::class, 'new'])->name('new');
        Route::post('new', [AdminBlogController::class, 'newValidate'])->name('new-validate');
        Route::post('delete', [AdminBlogController::class, 'delete'])->name('delete');
        Route::post('action', [AdminBlogController::class, 'action'])->name('action');
    });

    //file manager
    Route::prefix('file-manager')->name('file-manager.')->group(function(){
        Route::get('/', [FileManagerController::class, 'index'])->name('index');
        Route::get('editor', [FileManagerController::class, 'editor'])->name('editor');
        Route::post('editor', [FileManagerController::class, 'editorValidate'])->name('editor-validate');
        Route::post('delete', [FileManagerController::class, 'delete'])->name('delete');
        Route::get('download', [FileManagerController::class, 'downloadFile'])->name('download');
        Route::post('upload', [FileManagerController::class, 'uploadFile'])->name('upload');
    });


    //Addon Installer
    Route::prefix('addons')->name('addons.')->group(function(){
        Route::get('/', [AddonInstaller::class, 'index'])->name('index');
        Route::post('action', [AddonInstaller::class, 'action'])->name('action');
        Route::post('upload', [AddonInstaller::class, 'upload'])->name('upload');
        
    });

    //System manager
    Route::prefix('system-manager')->name('system-manager.')->group(function(){
        Route::get('/', [SystemController::class, 'index'])->name('index');
        Route::post('/change-env', [SystemController::class, 'changeEnv'])->name('change-env');
        Route::post('/verify', [SystemController::class, 'verify'])->name('verify');
        
    });


});
