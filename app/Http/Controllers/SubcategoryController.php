<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        // جلب جميع التصنيفات الفرعية
        $subcategories = Subcategory::all();

        // تمريرها إلى الـ View
        return view('subcategories.index', compact('subcategories'));
    }public function show(Subcategory $subcategory)
{
    // جلب الـ Service Providers المرتبطين بالـ Subcategory
    $providers = $subcategory->serviceProviders()->with(['category', 'subcategory'])->get();

    // لا حاجة لجلب كل Subcategories من نفس الكاتيجوري إذا الهدف عرض الـ providers فقط
    return view('subcategories.show', compact('subcategory', 'providers'));
}
}
