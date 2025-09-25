<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Attempt login with phone and password
     *

     */
    public function login(string $phone, string $password)
    {
        $user = User::where('phone_number', $phone)->first();

        if (!$user) {
            return null; // user does not exist
        }

        if (!Hash::check($password, $user->password)) {
            return false; // incorrect password
        }

        if ($user->status === 'inactive') {
            return 'inactive';
        }

        if ($user->status === 'suspended') {
            return 'suspended';
        }

        Auth::login($user);

        return $user;
    }
}
