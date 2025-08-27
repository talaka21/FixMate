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
        // ✅ التحقق من الإدخال
        $request->validate([
            'phone'    => 'required|string|max:10',
            'password' => [
                'required',
                'string',
                'min:8',
                // لازم يحتوي على حرف صغير، حرف كبير، رقم ورمز
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ], [
            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.max'         => 'رقم الهاتف يجب ألا يتجاوز 10 أرقام.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب أن تكون 8 محارف على الأقل.',
            'password.regex'    => 'كلمة المرور يجب أن تحتوي على أحرف كبيرة وصغيرة وأرقام ورموز.',
        ]);

        // ✅ جلب بيانات الاعتماد
        $credentials = $request->only('phone', 'password');

        // ✅ جلب المستخدم
        $user = User::where('phone_number', $credentials['phone'])->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'الحساب غير موجود.']);
        }

        // ✅ تحقق من كلمة المرور
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'كلمة المرور غير صحيحة.']);
        }

        // ✅ تحقق من حالة الحساب
        switch ($user->status) {
            case 'inactive':
                return redirect()->route('verify.form', ['phone' => $user->phone_number]);

            case 'suspended':
                return back()->withErrors(['phone' => 'تم إيقاف الحساب، تواصل مع الدعم.']);

            case 'active':
                // تسجيل دخول ناجح
                Auth::login($user);
                return redirect()->route('welcome');

            default:
                return back()->withErrors(['phone' => 'حالة الحساب غير معروفة.']);
        }
    }
}
