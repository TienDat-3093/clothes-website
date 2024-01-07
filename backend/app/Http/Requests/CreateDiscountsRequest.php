<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountsRequest extends FormRequest
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
            'amount_discounts' => 'require',
            'type_discount' => 'require',
            'start_date' => 'require',
            'end_date' => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ":attribute bắt buộc phải nhập",
            'min' => ":attribute không được nhỏ hơn :min kí tự",
            'max' => ":attribute không được lớn hơn :max kí tự"

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên mã giảm giá',
            'amount_discounts' => 'Phần trăm giảm giá',
            'type_discount' => 'Loại giảm giá',
            'start_date' => 'Ngày tạo',
            'end_date' => 'Ngày hết hạn',
        ];
    }
}
