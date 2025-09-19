<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'provider_name'  => 'required|string|max:255',
            'shop_name'      => 'required|string|max:255',
            'description'    => 'required|string',
            'phone'          => 'required|string|size:10',
            'whatsapp'       => 'nullable|string|size:10',
            'facebook'       => 'nullable|url',
            'instagram'      => 'nullable|url',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'state_id'       => 'required|exists:states,id',
            'city_id'        => 'required|exists:cities,id',
            'image'          => 'nullable|image|max:2048',
        ];
    }

    // رسائل خطأ مخصصة (اختياري)
    public function messages(): array
    {
        return [
            'provider_name.required' => 'الرجاء إدخال اسم المزود',
            'shop_name.required'     => 'الرجاء إدخال اسم المحل',
            'description.required'   => 'الرجاء إدخال وصف الخدمة',
            'phone.digits'           => 'رقم الهاتف يجب أن يتكون من 10 أرقام',

        ];
    }
}
