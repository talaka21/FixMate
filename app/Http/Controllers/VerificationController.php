<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show(Request $request)
{
    $phone = $request->phone;
    return view('auth.verify', compact('phone'));
}

public function submit(Request $request)
    {
        $code = $request->input('code');

        // تحقق من الكود (مثال وهمي)
        if ($code === '1234') {
             return response()->json(['message' => 'تم التحقق بنجاح']);
        } else {
            // رمز خاطئ
            return response()->json(['error' => 'رمز غير صحيح'], 422);
        }

    }
    public function resend(Request $request)
    {
        // تحقق من المستخدم، عدد المحاولات، الوقت، إلخ
        // إرسال رمز جديد عبر SMS أو Email
        return response()->json(['message' => 'تم إرسال رمز جديد']);
    }

    // التحقق من الرمز المدخل

}
