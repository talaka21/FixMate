<?php

namespace App\Services;

use App\Models\PhonePasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordService
{
    /**
     * Reset the user's password and delete the reset token
     *
     *
     */
    public function resetPassword(string $phone, string $newPassword): User
    {
        $user = User::where('phone_number', $phone)->firstOrFail();

        $user->password = Hash::make($newPassword);
        $user->save();

        PhonePasswordReset::where('phone_number', $phone)->delete();

        return $user;
    }
}
