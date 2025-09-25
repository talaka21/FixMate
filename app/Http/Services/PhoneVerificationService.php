<?php

namespace App\Services;

use App\Models\PhonePasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PhoneVerificationService
{
    private string $ultraMsgToken;
    private string $ultraMsgInstance;

    public function __construct()
    {
        $this->ultraMsgToken = config('services.ultramsg.token');
        $this->ultraMsgInstance = config('services.ultramsg.instance');
    }

    /**
     * Generate a new verification code and send via UltraMsg
     */
    public function sendCode(string $phone): bool|string
    {
        $code = rand(1000, 9999);

        PhonePasswordReset::updateOrCreate(
            ['phone_number' => $phone],
            [
                'token' => $code,
                'created_at' => Carbon::now(),
            ]
        );

        $params = [
            'token' => $this->ultraMsgToken,
            'to' => $phone,
            'body' => "Your verification code is: $code",
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ultramsg.com/{$this->ultraMsgInstance}/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $err ?: $code;
    }

    /**
     * Verify the code for the phone number
     */
    public function verifyCode(string $phone, int $code): bool
    {
        $record = PhonePasswordReset::where('phone_number', $phone)
            ->where('token', $code)
            ->where('created_at', '>=', Carbon::now()->subHours(48))
            ->first();

        return $record ? true : false;
    }

    /**
     * Resend a verification code with limits
     */
    public function resendCode(string $phone): bool|string
    {
        // Limit 3 times per 24 hours
        $sentCount = PhonePasswordReset::where('phone_number', $phone)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($sentCount >= 3) {
            return false;
        }

        // Limit 2 minutes since last send
        $lastSent = PhonePasswordReset::where('phone_number', $phone)
            ->latest('created_at')
            ->first();

        if ($lastSent && Carbon::now()->diffInSeconds($lastSent->created_at) < 120) {
            return false;
        }

        return $this->sendCode($phone);
    }
}
