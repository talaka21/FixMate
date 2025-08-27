<?php

namespace App\Http\Controllers;

use App\Models\PhonePasswordReset;
use Illuminate\Http\Request;

class VerificationphoneController extends Controller

 {
    public function showForm(Request $request)
{
    $phone = $request->phone;
    return view('auth.verificationphone', compact('phone'));
}



    // التحقق من الرمز
    public function checkCode(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'verification_code' => 'required|digits:4',
        ]);

        $record = PhonePasswordReset::where('phone_number', $request->phone)
            ->where('token', $request->verification_code)
            ->first();

        if (!$record) {
            return back()->withErrors(['verification_code' => '❌ رمز التحقق غير صحيح.']);
        }


        // ✅ إذا الرمز صح → روح لصفحة إعادة كلمة المرور
   return redirect()->route('auth.passwordReset.form', ['phone' => $request->phone])
    ->with('success', '✅ تم التحقق بنجاح، الرجاء تعيين كلمة مرور جديدة.');

    }
}
