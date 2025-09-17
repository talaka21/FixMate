<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
               return [
            'current_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // حرف صغير
                'regex:/[A-Z]/',      // حرف كبير
                'regex:/[0-9]/',      // رقم
                'regex:/[@$!%*#?&]/', // رمز
            ],
        ];

    }
    public function messages(): array
    {
        return [
            'new_password.regex' => 'كلمة المرور يجب أن تحتوي على حروف كبيرة وصغيرة وأرقام ورموز.',
        ];
    }
}
