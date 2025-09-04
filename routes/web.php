<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VerificationphoneController;
use App\Models\AboutUs;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GovernmentEntityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceProviderController;
  use App\Http\Controllers\ContactRequestController;

// الصفحة الرئيسية
Route::get('/', function () {
        $about = AboutUs::first();
    $categories = Category::all(); // جلب كل التصنيفات
    return view('welcome', compact('about','categories')); // تمريرهم للواجهة
})->name('welcome');

// Route::get('/', function () {
//     return "Welcome Page Test ✅";
// })->name('welcome');

// تسجيل مستخدم جديد
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// جلب المدن حسب الدولة
Route::get('/cities/{stateId}', [RegisterController::class, 'getCities']);

// التحقق عبر الكود
Route::post('/send-code', [VerificationController::class, 'submit'])->name('send.code');
Route::get('/verify', [VerificationController::class, 'show'])->name('verify.form');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verify.code');
Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verify.resend');

// نسيت كلمة المرور
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot-password.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('forgot-password.send');

// تسجيل الدخول
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// التحقق عبر الهاتف
Route::get('/verification-phone', [VerificationphoneController::class, 'showForm'])->name('auth.verificationPhone');
Route::post('/verification-phone', [VerificationphoneController::class, 'checkCode'])->name('auth.verificationPhone.check');

// إعادة تعيين كلمة المرور
Route::get('/reset-password/{phone}', [ResetPasswordController::class, 'showForm'])->name('auth.passwordReset.form');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('auth.passwordReset.update');

// Service Providers (مع حماية auth)
Route::resource('service_providers', ServiceProviderController::class)->middleware('auth');

// Subcategories -> Providers
Route::get('/subcategories/{subcategory}/providers', [ServiceProviderController::class, 'bySubcategory'])
    ->name('subcategories.providers');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Subcategories
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('/subcategories/id/{id}', [SubcategoryController::class, 'showById'])->name('subcategories.showById');

// Offers
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');

// GovernmentEntity
Route::get('/government-entities', [GovernmentEntityController::class, 'index'])->name('government-entities.index');


Route::get('/logout-confirm', [LogoutController::class, 'confirm'])->name('logout.confirm');

// تنفيذ تسجيل الخروج
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/privacy-policy/edit', [PrivacyPolicyController::class, 'edit'])->name('privacy.edit');
    Route::post('/privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('privacy.update');
});
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])  ->name('privacy-policy');
;


Route::get('/about-us', [AboutUsController::class, 'show'])
    ->name('about-us');



Route::get('/contact-us', [ContactRequestController::class, 'create'])->name('contact.create');
Route::post('/contact-us', [ContactRequestController::class, 'store'])->name('contact.send');
