<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function changePassword($user, $currentPassword, $newPassword): bool
    {
   
        if (!Hash::check($currentPassword, $user->password)) {
            return false;
        }
        $user->password = Hash::make($newPassword);
        $user->save();

        Auth::logout();

        return true;
    }
}
