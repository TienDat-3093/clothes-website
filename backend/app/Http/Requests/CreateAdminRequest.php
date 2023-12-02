<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|max:255|min:1',
            'fullname' => 'required|max:255|',
            'email' => 'required|email|max:255|',
            'password' => 'required|min:6',
            'phone_number' => 'required|regex:/^0[0-9]*$/|max:11|',
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
            'username' => 'Tên tài khoản',
            'fullname' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone_number' => 'Số điện thoại',
        ];
    }
}
