<?php

use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;

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
    return view('welcome');})->name('welcome');
Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verify.resend');


// صفحة نسيت كلمة المرور
// web.php

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])
    ->name('ForgotPassword');
Route::post('/forgot-password-phone', [ForgotPasswordController::class, 'sendResetLinkPhone'])
    ->name('password.phone.send');
