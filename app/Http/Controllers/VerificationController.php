<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{public function show(Request $request)
    {
        $phone = $request->phone;
        return view('auth.verify', compact('phone'));
    }

    // إرسال الكود عبر واتساب
    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        // توليد كود عشوائي 4 أرقام
        $verificationCode = rand(1000, 9999);

        // تخزين الكود بالجلسة
    // تخزين الكود بالـ database
    $verificationCode::updateOrCreate(
        ['phone' => $request->phone],
        [
            'code'       => $verificationCode,
            'verify' => Carbon::now()->addMinutes(30) // صلاحيةدقائق
        ]
      )  ;

        $params = [
            'token' => 'qdpk7glscua7qb44',
            'to'    => $request->phone,
            'body'  => "كود التحقق الخاص بك هو: $verificationCode",
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.ultramsg.com/instanceXXXX/messages/chat", // غيّر instanceXXXX برقم الInstance تبعك
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => http_build_query($params),
            CURLOPT_HTTPHEADER     => ["Content-Type: application/x-www-form-urlencoded"],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return back()->withErrors(['phone' => "خطأ بالإرسال: $err"]);
        }

        // رجع للمستخدم صفحة إدخال الكود
        return redirect()->route('verify.form')->with('success', 'تم إرسال رمز التحقق');
    }



    // التحقق من الكود المدخل
    public function verify(Request $request)
    {
          $request->validate([
        'phone'             => 'required|string',
        'verification_code' => 'required|digits:4',
    ]);

    // ✅ ابحث عن المستخدم حسب رقم الهاتف و الكود
    $user = User::where('phone_number', $request->phone)->first();
    // dd($user->verify_code,$request->verification_code);
    if($user->verify_code = $request->verification_code){
        return redirect()->route('welcome')->with('success', 'تم التحقق بنجاح 🎉');
    }

    return back()->withErrors(['verification_code' => 'الكود غير صحيح']);
}
public function resend(Request $request)
{
    $request->validate([
        'phone' => 'required|string'
    ]);

    $user = User::where('phone_number', $request->phone)->first();

    if (!$user) {
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }

    // ✅ توليد كود جديد
    $newCode = rand(1000, 9999);
    $user->update(['verify_code' => $newCode]);

    // هون بتستدعي API الإرسال (SMS أو WhatsApp)
    // sendVerificationCode($user->phone_number, $newCode);

    return response()->json(['message' => 'تم إرسال كود جديد ✅']);
}

}
