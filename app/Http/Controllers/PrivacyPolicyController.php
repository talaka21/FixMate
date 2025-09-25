<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PrivacyPolicyController extends Controller
{
       public function show()
    {
        $policy = PrivacyPolicy::first(); 
        return view('privacy.show', compact('policy'));
    }



}
