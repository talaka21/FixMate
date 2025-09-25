<?php

namespace App\Services;

use App\Models\PhonePasswordReset;
use App\Models\User;

class PhoneVerificationCheckService
{
    /**
     * Check if the verification code is valid for the given phone
     *
     *
     */
    public function verifyCode(string $phone, string|int $code): bool
    {

        $record = PhonePasswordReset::where('phone_number', $phone)
            ->where('token', $code)
            ->first();

        if ($record) {
            return true;
        }

        // إذا لم يكن موجودًا، تحقق في جدول المستخدمين
        $user = User::where('phone_number', $phone)
            ->where('verification_code', $code)
            ->first();

        return $user ? true : false;
    }
}
