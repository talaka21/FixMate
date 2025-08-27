<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PhonePasswordReset;
use App\Helpers\PhoneHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // عرض صفحة إدخال الكود
    public function show(Request $request)
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

        // تنسيق الرقم للصيغة الدولية (+963 أو +966)
        $phone = PhoneHelper::formatToInternational($request->phone, '+963');

        // توليد كود عشوائي
        $verificationCode = rand(1000, 9999);

        // تخزين أو تحديث في جدول phone_password_resets
        PhonePasswordReset::updateOrCreate(
            ['phone_number' => $phone],
            [
                'token'      => $verificationCode,
                'created_at' => Carbon::now()
            ]
        );

        // إعداد البيانات للإرسال
        $params = [
            'token' => config('services.ultramsg.token'),
            'to'    => $phone,
            'body'  => "كود التحقق الخاص بك هو: $verificationCode",
        ];

        // طلب cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.ultramsg.com/".config('services.ultramsg.instance')."/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => http_build_query($params),
            CURLOPT_HTTPHEADER     => ["Content-Type: application/x-www-form-urlencoded"],
            CURLOPT_TIMEOUT        => 30, // 30 ثانية
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return back()->withErrors(['phone' => "خطأ بالإرسال: $err"]);
        }

        return redirect()->route('verify.form', ['phone' => $request->phone])
            ->with('success', 'تم إرسال رمز التحقق');
    }

    // التحقق من الكود المدخل
    public function verify(Request $request)
    {
        $request->validate([
            'phone'             => 'required|string',
            'verification_code' => 'required|digits:4',
        ]);

        $phone = PhoneHelper::formatToInternational($request->phone, '+963');

        // البحث عن الكود والتحقق من صلاحيته (30 دقيقة)
        $record = PhonePasswordReset::where('phone_number', $phone)
            ->where('token', $request->verification_code)
            ->where('created_at', '>=', Carbon::now()->subMinutes(30))
            ->first();

        if ($record) {
            return redirect()->route('welcome')->with('success', 'تم التحقق بنجاح 🎉');
        }

        return back()->withErrors(['verification_code' => 'الكود غير صحيح أو منتهي']);
    }

    // إعادة إرسال الكود
    public function resend(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $phone = PhoneHelper::formatToInternational($request->phone, '+963');

        // توليد كود جديد
        $newCode = rand(1000, 9999);

        PhonePasswordReset::updateOrCreate(
            ['phone_number' => $phone],
            [
                'token'      => $newCode,
                'created_at' => Carbon::now()
            ]
        );

        // إرسال الكود عبر UltraMsg
        $params = [
            'token' => config('services.ultramsg.token'),
            'to'    => $phone,
            'body'  => "كود تحقق جديد هو: $newCode",
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.ultramsg.com/".config('services.ultramsg.instance')."/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => http_build_query($params),
            CURLOPT_HTTPHEADER     => ["Content-Type: application/x-www-form-urlencoded"],
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return back()->withErrors(['phone' => "خطأ بالإرسال: $err"]);
        }

        return redirect()->route('verify.form', ['phone' => $request->phone])
            ->with('success', 'تم إرسال كود جديد ✅');
    }
}
