<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyPhoneRequest;
use App\Services\PhoneVerificationCheckService;
use Illuminate\Http\Request;

class VerificationphoneController extends Controller
{
    private PhoneVerificationCheckService $verificationService;

    public function __construct(PhoneVerificationCheckService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    public function showForm(Request $request)
    {
        $phone = $request->phone;
        return view('auth.verificationphone', compact('phone'));
    }

    public function checkCode(VerifyPhoneRequest $request)
    {
        $data = $request->validated();

        $isValid = $this->verificationService->verifyCode($data['phone'], $data['verification_code']);

        if (!$isValid) {
            return back()->withErrors(['verification_code' => ' Incorrect verification code.']);
        }

        return redirect()->route('auth.passwordReset.form', ['phone' => $data['phone']])
                         ->with('success', ' Verified successfully, please set a new password.');
    }
}
