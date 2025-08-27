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
    }
    public function show(Subcategory $subcategory)
{
    $subcategory->load('serviceProviders'); // جلب مزوّدي الخدمات المرتبطين
    return view('subcategories.show', compact('subcategory'));
}
public function showById($id)
    {
        $subcategory = Subcategory::with('serviceProviders')->findOrFail($id);
        return view('subcategories.show', compact('subcategory'));
    }
}
