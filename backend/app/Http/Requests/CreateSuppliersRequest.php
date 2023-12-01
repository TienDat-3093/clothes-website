<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSuppliersRequest extends FormRequest
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
            'name' => 'required|max:255|min:1',
            'email' => 'required|email|max:255|',
            'phone_number' => 'required|regex:/^0[0-9]*$/|max:11|',
            'address' => 'required|max:255|',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ":attribute bắt buộc phải nhập",
            'min' => ":attribute không được nhỏ hơn :min kí tự",
            'max' => ":attribute không được lớn hơn :max kí tự",
            'email' => ":attribute không hợp lệ",
            'integer' => ":attribute phải là số",
            'regex' => ":attribute không hợp lệ"
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên nhà cung cấp',
            'email' => 'Email',
            'phone_number' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
    }
}
