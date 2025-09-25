<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VerificationphoneController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SetSessionLocale;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GovernmentEntityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Middleware\SetUserLanguage;
use Illuminate\Http\Request;

// ----------------- Public -----------------

// Home
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Language
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('change.lang');

Route::get('lang/{locale}', [LanguageController::class, 'change'])->name('lang.change');

// Auth: Register / Login / Logout
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout-confirm', [LogoutController::class, 'confirm'])->name('logout.confirm');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Forgot / Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot-password.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('forgot-password.send');
Route::get('/reset-password/{phone}', [ResetPasswordController::class, 'showForm'])->name('auth.passwordReset.form');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('auth.passwordReset.update');

// Verification (email/phone)
Route::post('/send-code', [VerificationController::class, 'submit'])->name('send.code');
Route::get('/verify', [VerificationController::class, 'show'])->name('verify.form');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verify.code');
Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verify.resend');

Route::get('/verification-phone', [VerificationphoneController::class, 'showForm'])->name('auth.verificationPhone');
Route::post('/verification-phone', [VerificationphoneController::class, 'checkCode'])->name('auth.verificationPhone.check');

// Categories & Subcategories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('/subcategories/id/{id}', [SubcategoryController::class, 'showById'])->name('subcategories.showById');
Route::get('/subcategories/{subcategory}/providers', [ServiceProviderController::class, 'bySubcategory'])->name('subcategories.providers');

// Offers
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');

// Government Entities
Route::get('/government-entities', [GovernmentEntityController::class, 'index'])->name('government-entities.index');

// Static Pages
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy');
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about-us');

// Contact
Route::get('/contact-us', [ContactRequestController::class, 'create'])->name('contact.create');
Route::post('/contact-us', [ContactRequestController::class, 'store'])->name('contact.send');

// API (Cities/Subcategories)
Route::get('/cities/{stateId}', [RegisterController::class, 'getCities']);
Route::get('/get-cities/{state_id}', [ServiceProviderController::class, 'getCities']);
Route::get('/get-subcategories/{category_id}', [ServiceProviderController::class, 'getSubcategories']);


// ----------------- Service Providers -----------------
Route::resource('service_providers', ServiceProviderController::class)
    ->only(['create', 'store','index']);
Route::get('/service-providers/search', [ServiceProviderController::class, 'search'])->name('service_providers.search');
Route::get('/service-providers/list', [ServiceProviderController::class, 'list'])->name('service_providers.list');


// ----------------- Auth Required -----------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Service Providers
    Route::resource('service_providers', ServiceProviderController::class)->only(['index', 'show']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.update-password');
    Route::get('/api/states', [ProfileController::class, 'states'])->name('api.states');
    Route::get('/api/cities', [ProfileController::class, 'cities'])->name('api.cities');

    // Privacy Policy
    Route::get('/privacy-policy/edit', [PrivacyPolicyController::class, 'edit'])->name('privacy.edit');
    Route::post('/privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('privacy.update');

    // Notifications
    Route::get('/notifications/settings', [NotificationController::class, 'settings'])->name('notifications.settings');
    Route::post('/notifications/settings', [NotificationController::class, 'updateSettings'])->name('notifications.settings.update');
});
