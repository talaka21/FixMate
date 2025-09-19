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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// استخدم Middleware واحد أو عدة Middleware مع بعض
// Route::get('/', function (Request $request) {
//     $about = AboutUs::first();
//     $categories = Category::all();

//     // أول تشغيل → ترتيب عشوائي
//     if (!$request->session()->has('first_launch_done')) {
//         $serviceProviders = ServiceProvider::inRandomOrder()->take(6)->get();
//         $request->session()->put('first_launch_done', true);
//     } else {
//         // المرات التالية → حسب المشاهدات
//         $serviceProviders = ServiceProvider::orderByDesc('views')->take(6)->get();
//     }

//     $offers = Offer::latest()->take(6)->get();

//     return view('welcome', compact('about', 'categories', 'serviceProviders', 'offers'));
// })->name('welcome');

// تغيير اللغة
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('change.lang');


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
// routes/web.php

Route::resource('service_providers', ServiceProviderController::class)
    ->only(['create', 'store','index']);

// باقي العمليات للمسجلين دخول فقط
Route::middleware('auth')->group(function () {
    Route::resource('service_providers', ServiceProviderController::class)
        ->only(['index', 'show']);
});

// routes/web.php
Route::get('/get-subcategories/{category_id}', [ServiceProviderController::class, 'getSubcategories']);
Route::get('/get-cities/{state_id}', [ServiceProviderController::class, 'getCities']);

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



Route::get('/about-us', [AboutUsController::class, 'show'])
    ->name('about-us');



Route::get('/contact-us', [ContactRequestController::class, 'create'])->name('contact.create');
Route::post('/contact-us', [ContactRequestController::class, 'store'])->name('contact.send');

Route::get('/lang/{locale}', function ($locale) {
    // التأكد من أن اللغة مسموح بها فقط
    if (in_array($locale, ['en', 'ar'])) {
        // حفظ اللغة في الجلسة
        session(['locale' => $locale]);

        // تعيين اللغة فورياً للطلب الحالي
        App::setLocale($locale);
    }

    // العودة للصفحة السابقة
    return redirect()->back();
})->name('change.lang');


Route::middleware('auth')->group(function () {
    Route::get('/notifications/settings', [NotificationController::class, 'settings'])->name('notifications.settings');
    Route::post('/notifications/settings', [NotificationController::class, 'updateSettings'])->name('notifications.settings.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/api/states', [ProfileController::class, 'states'])->name('api.states'); // optional
    Route::get('/api/cities', [ProfileController::class, 'cities'])->name('api.cities'); // ?state_id=#
});

//change-password
Route::middleware('auth')->group(function () {
    Route::get('profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.update-password');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('lang/{locale}', [LanguageController::class, 'change'])->name('change.lang');

Route::get('/subcategories/{subcategory}/providers', [ServiceProviderController::class, 'bySubcategory'])
    ->name('subcategories.providers');
Route::get('/cities/{stateId}', [RegisterController::class, 'getCities']);

Route::get('/service-providers/search', [ServiceProviderController::class, 'search'])
     ->name('service_providers.search');

     Route::get('/service-providers/list', [ServiceProviderController::class, 'list'])
     ->name('service_providers.list');
