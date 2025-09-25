<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // السماح لكل المستخدمين بإرسال هذا الطلب
    }

    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'phone_number' => 'required|string|max:10|unique:users,phone_number',
            'email'        => 'required|email|unique:users,email',
            'state_id'     => 'required|exists:states,id',
            'city_id'      => 'required|exists:cities,id',
            'password'     => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
            'terms' => 'accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'terms.accepted' => 'يجب الموافقة على الشروط والأحكام.',
            'password.regex' => 'كلمة المرور يجب أن تحتوي على حرف كبير وصغير ورقم ورمز خاص.',
        ];
    }
}
