<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceProvider;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
          $about = AboutUs::first();
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $tags = Tag::all();

    $query = ServiceProvider::query();

    // البحث باسم المحل
    if ($request->shop_name) {
        $query->where('shop_name', 'like', '%' . $request->shop_name . '%');
    }

    // البحث بالفئة
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // البحث بالفئة الفرعية
    if ($request->subcategory_id) {
        $query->where('subcategory_id', $request->subcategory_id);
    }

    // البحث بالوسوم (كنص)
if ($request->tags) {
    $tags = is_array($request->tags) ? $request->tags : explode(',', $request->tags);
    $query->whereHas('tags', function ($q) use ($tags) {
        $q->whereIn('tags.id', $tags);
    });
}



    // ترتيب النتائج (المشاهدة أولاً)
    $serviceProviders = $query->orderByDesc('views')->paginate(12);

    // العروض
    $offers = Offer::latest()->take(6)->get();

    return view('welcome', compact(
        'about',
        'categories',
        'subcategories',
        'tags',
        'serviceProviders',
        'offers'
    ));

    }


}
