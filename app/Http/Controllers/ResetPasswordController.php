<?php

namespace App\Http\Controllers;

use App\Models\PhonePasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
 public function showForm($phone)
    {
        // يعرض صفحة إعادة التعيين ويبعث رقم الهاتف للـ Blade
        return view('auth.passwordReset', compact('phone'));
    }

    public function reset(Request $request)
    {
        // التحقق من الإدخال
        $request->validate([
            'phone' => 'required|exists:users,phone_number',
            'password' => 'required|min:4|confirmed',
        ], [
            'phone.exists' => 'رقم الهاتف غير مسجل لدينا.',
        ]);

        // البحث عن المستخدم
        $user = User::where('phone_number', $request->phone)->first();

        // تحديث كلمة المرور
        $user->password = Hash::make($request->password);
        $user->save();

        // تنظيف جدول إعادة التعيين
        PhonePasswordReset::where('phone_number', $request->phone)->delete();

        // إعادة التوجيه لصفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('login')
            ->with('success', '✅ تم تغيير كلمة المرور بنجاح، الرجاء تسجيل الدخول.');
    }
}
