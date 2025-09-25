<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
     public function show()
    {
        $about = AboutUs::first(); 
        return view('about.show', compact('about'));
    }
}
