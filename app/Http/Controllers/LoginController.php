<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    // عرض صفحة تسجيل الدخول
    public function showForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    // تنفيذ عملية تسجيل الدخول
    public function login(Request $request)
    {

    $request->validate([
        'phone' => 'required|digits:10',
        'password' => 'required|string|min:8',
    ]);

    // البحث عن المستخدم
    $user = User::where('phone_number', $request->phone)->first();

    // 1. الحساب غير موجود
    if (!$user) {
        return back()->withErrors(['phone' => '❌ رقم الهاتف غير مسجل لدينا.']);
    }

    // 2. الحساب غير مفعّل
    if (!$user->is_verified) {
        return redirect()->route('verify.form', ['phone' => $request->phone]);
    }

    // 3. الحساب موجود ومفعل
    if (Hash::check($request->password, $user->password)) {
        // ✅ كلمة السر صحيحة → تسجيل دخول + توجيه للـ welcome
        Auth::login($user);
        return redirect()->route('welcome');
    }

    // ❌ كلمة السر خاطئة
    return back()->withErrors(['password' => '❌ كلمة المرور غير صحيحة.']);
    }
}
