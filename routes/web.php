<?php

use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/cities/{stateId}', [RegisterController::class, 'getCities']);
Route::post('/verification', action: [VerificationController::class, 'submit'])->name('verification.submit');
Route::post('/resend-code', [VerificationController::class, 'resend'])->name('verify.resend');
Route::post('/verification', [VerificationController::class, 'submit'])->name('verification.submit');

