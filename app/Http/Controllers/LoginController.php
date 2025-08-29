<?php

namespace App\Http\Controllers;

use App\Enum\UserEnum;
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
            'phone'    => 'required|string|max:10',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ]);

        $credentials = $request->only('phone', 'password');

        $user = User::where('phone_number', $credentials['phone'])->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'الحساب غير موجود.']);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'كلمة المرور غير صحيحة.']);
        }

   if ($user->status === 'active') {
    Auth::login($user);
    return redirect()->route('welcome');
}

if ($user->status === 'inactive') {
    return redirect()->route('verify.form', ['phone' => $user->phone_number]);
}

if ($user->status === 'suspended') {
    return back()->withErrors(['phone' => 'تم إيقاف الحساب، تواصل مع الدعم.']);
}


    }
}
