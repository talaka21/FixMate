<?php

namespace App\Http\Controllers;


use App\Models\PhonePasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
      public function showForm()
    {
        return view('auth.forgot-password'); // resources/views/forgot-password.blade.php
    }
// إرسال كود إعادة التعيين

public function sendResetCode(Request $request)
    {
        // التحقق من صحة الرقم
        $request->validate([
            'phone' => 'required|digits:10',
        ]);

        // التحقق من وجود المستخدم في قاعدة البيانات
        $user = DB::table('users')->where('phone_number', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'رقم الهاتف غير مسجل في النظام.']);
        }

        // توليد رمز تحقق (OTP)
        $token = rand(1000, 9999);

        // حذف أي رموز سابقة لنفس الرقم
        PhonePasswordReset::where('phone_number', $request->phone)->delete();

        // حفظ الرمز الجديد في قاعدة البيانات
        PhonePasswordReset::create([
            'phone_number' => $request->phone,
            'token' => $token,
            'created_at' => now(),
        ]);

        // رسالة نجاح (للتجربة فقط)

return redirect()->route('auth.verificationPhone', ['phone' => $request->phone])
                 ->with('success', 'تم إرسال رمز التحقق إلى رقم هاتفك!');

    }}

