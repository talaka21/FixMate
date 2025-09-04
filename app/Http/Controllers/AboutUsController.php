<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
     public function show()
    {
        $about = AboutUs::first(); // في حال صفحة واحدة فقط
        return view('about.show', compact('about'));
    }
}
