<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
   
        $subcategories = Subcategory::all();

        return view('subcategories.index', compact('subcategories'));
    }
public function show(\App\Models\ServiceProvider $serviceProvider)
{
    $serviceProvider->load(['category','subcategory','state','city']);
    return view('service_providers.show', compact('serviceProvider'));
}


}
