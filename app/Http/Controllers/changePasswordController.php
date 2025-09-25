<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    private UserService $userService;

    // Laravel يحقن UserService بشكل تلقائي (Dependency Injection)
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $changed = $this->userService->changePassword(
            $user,
            $data['current_password'],
            $data['new_password']
        );

        if (! $changed) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        return redirect()->route('login')
            ->with('success', 'Password changed successfully. Please log in again.');
    }
}
