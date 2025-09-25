<?php

namespace App\Http\Controllers;


use App\Http\Requests\ForgotPasswordRequest;
use App\Models\PhonePasswordReset;
use App\Services\ForgotPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{

private ForgotPasswordService $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }    public function showForm()
    {
        return view('auth.forgot-password');
    }



    public function sendResetCode(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $phone = $data['phone'];

        $token = $this->forgotPasswordService->sendResetCode($phone);

        if (!$token) {
            return back()->withErrors(['phone' => 'Phone number not registered']);
        }

        return redirect()->route('auth.verificationPhone', ['phone' => $phone])
                         ->with('success', 'Verification code sent successfully!');
    }
}

