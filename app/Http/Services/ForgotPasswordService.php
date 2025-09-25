<?php

namespace App\Services;

use App\Models\PhonePasswordReset;
use Illuminate\Support\Facades\DB;

class ForgotPasswordService
{
    /**
     * Send verification code to phone number
     *
     * @param string $phone
     * @return int|null
     */
    public function sendResetCode(string $phone): ?int
    {
        // تحقق من وجود المستخدم
        $user = DB::table('users')->where('phone_number', $phone)->first();

        if (!$user) {
            return null;
        }

        // توليد رمز عشوائي
        $token = rand(1000, 9999);

        // حذف أي رموز قديمة لنفس الرقم
        PhonePasswordReset::where('phone_number', $phone)->delete();

        // إنشاء رمز جديد
        PhonePasswordReset::create([
            'phone_number' => $phone,
            'token' => $token,
            'created_at' => now(),
        ]);

        return $token;
    }
}
