<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Services\ResetPasswordService;

class ResetPasswordController extends Controller
{
    private ResetPasswordService $resetPasswordService;

    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    public function showForm($phone)
    {
        return view('auth.passwordReset', compact('phone'));
    }

    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $this->resetPasswordService->resetPassword($data['phone'], $data['password']);

        return redirect()->route('login')
                         ->with('success', 'Password has been successfully reset, please login.');
    }
}
