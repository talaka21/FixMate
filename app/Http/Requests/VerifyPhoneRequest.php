<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|exists:users,phone_number',
            'verification_code' => 'required|digits:4',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number is required.',
            'phone.exists' => 'Phone number is not registered.',
            'verification_code.required' => 'Verification code is required.',
            'verification_code.digits' => 'Verification code must be 4 digits.',
        ];
    }
}
