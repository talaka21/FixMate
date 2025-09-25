<?php

namespace App\Http\Controllers;

use App\Services\PhoneVerificationService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    private PhoneVerificationService $verificationService;

    public function __construct(PhoneVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    public function show(Request $request)
    {
        $phone = $request->phone;
        return view('auth.verify', compact('phone'));
    }

    public function submit(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        $result = $this->verificationService->sendCode($request->phone);

        if ($result === false) {
            return back()->withErrors(['phone' => 'Error sending verification code']);
        }

        return redirect()->route('verify.form', ['phone' => $request->phone])
                         ->with('success', 'Verification code has been sent ✅');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'verification_code' => 'required|digits:4',
        ]);

        $verified = $this->verificationService->verifyCode($request->phone, (int)$request->verification_code);

        if ($verified) {
            return redirect()->route('welcome')->with('success', 'Verification successful 🎉');
        }

        return back()->withErrors(['verification_code' => 'Invalid or expired code']);
    }

    public function resend(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        $result = $this->verificationService->resendCode($request->phone);

        if ($result === false) {
            return back()->withErrors(['phone' => 'Cannot resend code yet or limit reached']);
        }

        return redirect()->route('verify.form', ['phone' => $request->phone])
                         ->with('success', 'A new verification code has been sent ✅');
    }
}
