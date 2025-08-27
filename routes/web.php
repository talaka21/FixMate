<?php

use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VerificationphoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceProviderController;


Route::get('/', function () {
    return view('welcome');
});


// عرض صفحة التسجيل
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');

// تسجيل المستخدم
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// جلب المدن حسب الدولة
Route::get('/cities/{stateId}', [RegisterController::class, 'getCities']);



Route::post('/send-code', [VerificationController::class, 'submit'])->name('send.code');
Route::get('/verify', [VerificationController::class, 'show'])->name('verify.form');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verify.code');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verify.resend');


// صفحة نسيت كلمة المرور
// web.php


Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])
    ->name('forgot-password.form');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])
    ->name('forgot-password.send');
//login


Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


//verificationphone

Route::get('/verification-phone', [VerificationphoneController::class, 'showForm'])
    ->name('auth.verificationPhone');

Route::post('/verification-phone', [VerificationphoneController::class, 'checkCode'])
    ->name('auth.verificationPhone.check');
//password.reset.

// عرض النموذج
Route::get('/reset-password/{phone}', [ResetPasswordController::class, 'showForm'])
    ->name('auth.passwordReset.form');

// إرسال كلمة المرور الجديدة
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('auth.passwordReset.update');
//service provider
Route::get('/service-providers/create', [ServiceProviderController::class, 'create'])->name('service_providers.create');
Route::post('/service-providers', [ServiceProviderController::class, 'store'])->name('service_providers.store');
