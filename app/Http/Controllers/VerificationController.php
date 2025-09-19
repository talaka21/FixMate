<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PhonePasswordReset;
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
        'phone' => 'required|string',
    ]);

    $phone = $request->phone;

    // Generate verification code
    $verificationCode = rand(1000, 9999);

    PhonePasswordReset::updateOrCreate(
        ['phone_number' => $phone],
        [
            'token'      => $verificationCode,
            'created_at' => Carbon::now()
        ]
    );

    // Send via UltraMsg API
    $params = [
        'token' => config('services.ultramsg.token'),
        'to'    => $phone,
        'body'  => "Your verification code is: $verificationCode",
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
        return back()->withErrors(['phone' => "Sending error: $err"]);
    }

    return redirect()->route('verify.form', ['phone' => $request->phone])
        ->with('success', 'Verification code has been sent ✅');
}

// Verify entered code
public function verify(Request $request)
{
    $request->validate([
        'phone'             => 'required|string',
        'verification_code' => 'required|digits:4',
    ]);

    $phone = $request->phone;

    $record = PhonePasswordReset::where('phone_number', $phone)
        ->where('token', $request->verification_code)
        ->where('created_at', '>=', Carbon::now()->subHours(48))
        ->first();

    if ($record) {
        return redirect()->route('welcome')->with('success', 'Verification successful 🎉');
    }

    return back()->withErrors(['verification_code' => 'Invalid or expired code ❌']);
}
    // التحقق من الكود المدخل
   

    // إعادة إرسال الكود
   public function resend(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
    ]);

    $phone = $request->phone;

    // Check resend limit within 24 hours
    $sentCount = PhonePasswordReset::where('phone_number', $phone)
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->count();

    if ($sentCount >= 3) {
        return back()->withErrors(['phone' => 'You have reached the maximum resend attempts within 24 hours.']);
    }

    // Check 2 minutes wait since last send
    $lastSent = PhonePasswordReset::where('phone_number', $phone)
        ->latest('created_at')
        ->first();

    if ($lastSent && Carbon::now()->diffInSeconds($lastSent->created_at) < 120) {
        $waitTime = 120 - Carbon::now()->diffInSeconds($lastSent->created_at);
        return back()->withErrors(['phone' => "Please wait $waitTime seconds before requesting a new code."]);
    }

    // Generate new code
    $newCode = rand(1000, 9999);

    PhonePasswordReset::updateOrCreate(
        ['phone_number' => $phone],
        [
            'token'      => $newCode,
            'created_at' => Carbon::now()
        ]
    );

    // Send via UltraMsg API
    $params = [
        'token' => config('services.ultramsg.token'),
        'to'    => $phone,
        'body'  => "Your new verification code is: $newCode",
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
        return back()->withErrors(['phone' => "Sending error: $err"]);
    }

    return redirect()->route('verify.form', ['phone' => $request->phone])
        ->with('success', 'A new verification code has been sent ✅');
}
}
