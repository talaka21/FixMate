<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
     // عرض صفحة التأكيد
    public function confirm()
    {
        return view('auth.logout-confirm');
    }

    // تنفيذ تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // لازم يكون عندك route اسمه login
    }
}
