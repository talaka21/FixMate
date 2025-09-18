<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyPhoneRequest;
use App\Models\PhonePasswordReset;
use Illuminate\Http\Request;

class VerificationphoneController extends Controller

 {
    public function showForm(Request $request)
{
    $phone = $request->phone;
    return view('auth.verificationphone', compact('phone'));
}

     public function checkCode(VerifyPhoneRequest $request)
    {
        $data = $request->validated();

        $record = PhonePasswordReset::where('phone_number', $data['phone'])
            ->where('token', $data['verification_code'])
            ->first();

        if (!$record) {
            return back()->withErrors(['verification_code' => '❌ Incorrect verification code.']);
        }

        return redirect()->route('auth.passwordReset.form', ['phone' => $data['phone']])
                         ->with('success', '✅ Verified successfully, please set a new password.');
    }
}
