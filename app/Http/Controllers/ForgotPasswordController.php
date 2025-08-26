<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view(view: 'auth.ForgotPassword'); // أنشئ resources/views/forgot-password.blade.php
    }
    public function sendResetLinkPhone(Request $request)
{
    $request->validate([
        'phone' => 'required|digits:10', // أو حسب طول رقم الهاتف
    ]);

    // هنا تضيف منطق إرسال كود أو رابط إعادة التعيين
    // مثلا تخزين كود في قاعدة البيانات أو استخدام SMS API

    return back()->with('success', 'Reset code sent to your phone!');
}
}
