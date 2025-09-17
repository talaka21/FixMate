<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        // التحقق من كلمة المرور الحالية
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        // تحديث كلمة المرور
        $user->password = Hash::make($request->new_password);
        $user->save();

        // تسجيل خروج المستخدم
        Auth::logout();

        // إعادة التوجيه لصفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('login')->with('success', 'تم تغيير كلمة المرور بنجاح، الرجاء تسجيل الدخول مرة أخرى.');
    }
}
