<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManufacturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'email' => [
                'bail',
                'nullable',
                'email:rfc,dns',
                'max:255',
            ],
            'phone' => [
                'bail',
                'nullable',
                'regex:/^(0|\+84)[0-9]{9,10}$/',
                'max:20',
            ],
            'address' => [
                'bail',
                'nullable',
                'string',
                'max:500',
            ],
            'description' => [
                'bail',
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhà sản xuất.',
            'name.string' => 'Tên nhà sản xuất phải là chuỗi ký tự.',
            'name.max' => 'Tên nhà sản xuất không được vượt quá 255 ký tự.',
            'name.min' => 'Tên nhà sản xuất phải có ít nhất 2 ký tự.',

            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'phone.regex' => 'Số điện thoại không hợp lệ (phải bắt đầu bằng 0 hoặc +84).',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 500 ký tự.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ];
    }
}
