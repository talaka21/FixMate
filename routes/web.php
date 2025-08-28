<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VerificationphoneController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GovernmentEntityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceProviderController;


Route::get('/', function () {
    $categories = Category::all(); // جلب كل التصنيفات
    return view('welcome', compact('categories')); // تمريرهم للواجهة
})->name('welcome');

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
// Route::get('/service-providers/create', [ServiceProviderController::class, 'create'])->name('service_providers.create');
// Route::post('/service-providers', [ServiceProviderController::class, 'store'])->name('service_providers.store');
Route::resource('service_providers', ServiceProviderController::class);

Route::get('/service-providers/{serviceProvider}', [ServiceProviderController::class, 'show'])
    ->middleware('auth')
    ->name('service-providers.show');

//categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


//subgategory
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategories/{subcategory}', [SubcategoryController::class, 'show'])
    ->name('subcategories.show');
// جلب كل الـ service providers تبع subcategory
Route::get('/subcategories/{subcategory}/providers', [ServiceProviderController::class, 'bySubcategory'])
    ->name('subcategories.providers');

// Route باستخدام id (يدوي)
Route::get('/subcategories/id/{id}', [SubcategoryController::class, 'showById'])
    ->name('subcategories.showById');

    //offers

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');

//GovernmentEntity
Route::get('/government-entities', [GovernmentEntityController::class, 'index'])->name('government-entities.index');

