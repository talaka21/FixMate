<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone_number'      => 'required|string',
            'state_id'   => 'required|exists:states,id',
            'city_id'    => 'required|exists:cities,id',
            'image'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'الاسم الأول مطلوب.',
            'last_name.required'  => 'الاسم الأخير مطلوب.',
            'state_id.required'   => 'الرجاء اختيار الولاية.',
            'city_id.required'    => 'الرجاء اختيار المدينة.',
            'image.image'         => 'الملف المختار يجب أن يكون صورة.',
        ];
    }

    /**
     * Extra validation: make sure city belongs to selected state
     */
    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->filled('state_id') && $this->filled('city_id')) {
    //             $validCity = DB::table('cities')
    //                 ->where('id', $this->city_id)
    //                 ->where('state_id', $this->state_id)
    //                 ->exists();

    //             if (! $validCity) {
    //                 $validator->errors()->add('city_id', 'المدينة المحددة لا تتبع الولاية المختارة.');
    //             }
    //         }
    // });
    // }
}
