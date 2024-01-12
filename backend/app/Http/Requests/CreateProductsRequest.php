<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductsRequest extends FormRequest
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
            'description' => 'required|min:1|max:1000|',
            'price' => 'required|min:0|numeric',
            'categories_id' =>'required',
            'colors_id' =>'required',
            'sizes_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ":attribute bắt buộc phải nhập",
            'min' => ":attribute không được nhỏ hơn :min kí tự",
            'max' => ":attribute không được lớn hơn :max kí tự",       
            'numeric' => ":attribute phải là số",
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên nhà cung cấp',
            'description' => 'Mô tả',
            'price' => 'Giá',
            'categories_id' =>'Loại sản phẩm',
            'colors_id' =>'Màu sắc',
            'sizes_id' => 'Kích cỡ',
        ];
    }
}
