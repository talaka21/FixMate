<?php

namespace App\Http\Controllers;


use App\Http\Requests\ForgotPasswordRequest;
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

   public function sendResetCode(ForgotPasswordRequest $request)
    {
        $data = $request->validated(); // ✅ بيانات صحيحة فقط
        $phone = $data['phone'];

        $user = DB::table('users')->where('phone_number', $phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'Phone number not registered']);
        }

        $token = rand(1000, 9999);

        PhonePasswordReset::where('phone_number', $phone)->delete();

        PhonePasswordReset::create([
            'phone_number' => $phone,
            'token' => $token,
            'created_at' => now(),
        ]);

        return redirect()->route('auth.verificationPhone', ['phone' => $phone])
                         ->with('success', 'Verification code sent successfully!');
    }
}

