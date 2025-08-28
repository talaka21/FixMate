<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\State;
use App\Models\City;

class ServiceProviderController extends Controller
{
    /**
     * عرض قائمة مزودي الخدمات مع بحث/فلترة/ترتيب
     */
    public function index(Request $request)
    {
        $query = ServiceProvider::query()->with(['category', 'subcategory', 'state', 'city']);

        // البحث بالاسم
        if ($request->filled('search')) {
            $query->where('shop_name', 'like', '%'.$request->search.'%');
        }

        // الفلترة
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // الترتيب حسب المشاهدات
        if ($request->sort == 'views') {
            $query->orderByDesc('views');
        }

        // جلب البيانات
        $providers = $query->paginate(12);

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

    // إذا جاء المستخدم من صفحة Subcategory معينة
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
    public function store(Request $request)
    {
      $request->validate([
        'provider_name'  => 'required|string|max:255',
        'shop_name'      => 'required|string|max:255',
        'description'    => 'required|string',
        'phone'          => 'required|string|max:20',
        'category_id'    => 'required|exists:categories,id',
        'subcategory_id' => 'required|exists:subcategories,id',
        'state_id'       => 'required|exists:states,id',
        'city_id'        => 'required|exists:cities,id',
        'image'          => 'nullable|image|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('providers', 'public');
    }

    $provider = ServiceProvider::create($data);

    // رجع المستخدم عصفحة تفاصيل الـ Subcategory
    return redirect()->route('subcategories.show', $provider->subcategory_id)
        ->with('success', 'Your request has been submitted successfully!');
    }

    /**
     * عرض تفاصيل مزود خدمة
     */
    public function show(Subcategory $subcategory)
    {
        // زيادة عداد المشاهدات
         $providers = $subcategory->serviceProviders()->with(['category', 'subcategory'])->get();

        $locale = app()->getLocale();

        // تجهيز الترجمة للاسم والوصف
        $subcategoryName = is_array($subcategory->name)
            ? ($subcategory->name[$locale] ?? $subcategory->name['en'] ?? '')
            : $subcategory->name;

        $subcategoryDescription = is_array($subcategory->description)
            ? ($subcategory->description[$locale] ?? $subcategory->description['en'] ?? '')
            : $subcategory->description;

        return view('subcategories.show', compact(
            'subcategory',
            'subcategoryName',
            'subcategoryDescription',
            'providers'
        ));
    }
public function bySubcategory(Subcategory $subcategory)
{
    $service_providers = ServiceProvider::with(['category','subcategory','state','city'])
        ->where('subcategory_id', $subcategory->id)
        ->latest()
        ->paginate(12); // أو ->get()

    return view('service_providers.index', [
        'service_providers' => $service_providers,
        'subcategory' => $subcategory,
    ]);
}




    }

