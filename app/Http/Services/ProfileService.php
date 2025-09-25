<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    /**
     * Update user profile with provided data and optional image
     *

     */
    public function updateProfile(User $user, array $data, ?UploadedFile $image = null): User
    {
        $user->first_name   = $data['first_name'] ?? $user->first_name;
        $user->last_name    = $data['last_name'] ?? $user->last_name;
        $user->phone_number = $data['phone_number'] ?? $user->phone_number;
        $user->state_id     = $data['state_id'] ?? $user->state_id;
        $user->city_id      = $data['city_id'] ?? $user->city_id;

        // معالجة الصورة إذا تم رفعها
        if ($image) {
          
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profiles'), $filename);
            $user->image = 'profiles/' . $filename;
        }

        $user->save();

        return $user;
    }
}
