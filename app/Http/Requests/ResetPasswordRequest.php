<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
 public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|exists:users,phone_number',
            'password' => 'required|string|min:4|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number is required.',
            'phone.exists' => 'Phone number is not registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 4 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
