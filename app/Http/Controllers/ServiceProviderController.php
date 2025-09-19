<?php

namespace App\Http\Controllers;

use App\Mail\NewProviderRequest;
use App\Models\AboutUs;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ServiceProviderRequest;

class ServiceProviderController extends Controller
{
    /**
     * عرض قائمة مزودي الخدمات مع بحث/فلترة/ترتيب
     */
    public function index(Request $request)
    {
        $providers = ServiceProvider::with(['category', 'subcategory', 'state', 'city'])
                        ->paginate(12);

        return view('service_providers.index', [
            'providers' => $providers,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'states' => State::all(),
            'cities' => City::all(),
        ]);
    }

    /**
     * عرض صفحة الفورم
     */
    public function create(Request $request)
    {
        $states = State::all();
        $cities = City::all();

        $subcategory = null;
        $category = null;

        if ($request->filled('subcategory_id')) {
            $subcategory = Subcategory::find($request->subcategory_id);
            if ($subcategory) {
                $category = $subcategory->category;
            }
        }

        return view('service_providers.create', [
            'states' => $states,
            'cities' => $cities,
            'subcategory' => $subcategory,
            'category' => $category,
            'categories' => $subcategory ? collect([$category]) : Category::all(),
            'subcategories' => $subcategory ? collect([$subcategory]) : Subcategory::all(),
        ]);
    }

    /**
     * تخزين مزود خدمة جديد
     */
  public function store(ServiceProviderRequest $request)
{
    // التحقق من البيانات المدخلة
    $data = $request->validated();

    // إنشاء مزود الخدمة بدون الصورة أولاً
    $provider = ServiceProvider::create($data);

    // حفظ الصورة باستخدام Media Library
    if ($request->hasFile('image')) {
        $provider->addMediaFromRequest('image')->toMediaCollection('image');
    }

    // إرسال إشعار للإدارة عبر البريد
    $adminEmail = config('mail.admin_email');
    Mail::to($adminEmail)->send(new NewProviderRequest($provider));

    // إعادة التوجيه بعد الحفظ
    return redirect()->route('subcategories.providers', $provider->subcategory_id)
                     ->with('success', 'تم إرسال طلبك بنجاح!');
}


    /**
     * عرض تفاصيل مزود خدمة
     */
    public function show(ServiceProvider $serviceProvider)
    {
        $serviceProvider->increment('views');

        return view('service_providers.show', compact('serviceProvider'));
    }

    public function bySubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $providers = ServiceProvider::with(['category','subcategory','state','city'])
                        ->where('subcategory_id', $subcategory->id)
                        ->latest()
                        ->paginate(12);

        return view('service_providers.index', [
            'providers' => $providers,
            'subcategory' => $subcategory,
        ]);
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->get()
            ->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'name' => $sub->getTranslation('name', app()->getLocale()),
                ];
            });

        return response()->json($subcategories);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)
            ->get()
            ->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->getTranslation('name', app()->getLocale()),
                ];
            });

        return response()->json($cities);
    }

    /**
     * البحث عن مزودي الخدمات
     */
    public function search(Request $request)
    {
        $about = AboutUs::first();
        $query = ServiceProvider::query();

        if ($request->shop_name) {
            $query->where('shop_name', 'like', "%{$request->shop_name}%");
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        if ($request->tags) {
            $tags = explode(',', $request->tags);
            $query->whereHas('tags', fn($q) => $q->whereIn('id', $tags));
        }

        $serviceProviders = $query->paginate(12);

        return view('welcome', [
            'serviceProviders' => $serviceProviders, // مهم! نفس الاسم بالـ Blade
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'tags' => Tag::all(),
            'about' => $about,
        ]);
    }
    public function list(Request $request)
{
    $query = ServiceProvider::with(['tags']);

    // إذا المستخدم استخدم التطبيق من قبل، نرتب حسب المشاهدات
    if ($request->session()->has('visited_before')) {
        $query->orderByDesc('views');
    } else {
        // ترتيب عشوائي لأول مرة
        $query->inRandomOrder();
        $request->session()->put('visited_before', true);
    }

    $serviceProviders = $query->paginate(12);

    return view('service_providers.list', [
        'serviceProviders' => $serviceProviders
    ]);
}
}
