<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                       'notifications_enabled' => 'required|boolean',
        ];
    }

     public function messages(): array
    {
        return [
            'notifications_enabled.required' => 'Notifications field is required',
            'notifications_enabled.boolean' => 'Notifications must be true or false',
        ];
    }
}
