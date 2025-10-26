<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
        public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:255',
            'category_id' => 'bail|required|exists:categories,id',
            'manufacturer_id' => 'bail|required|exists:manufacturers,id',
            'quantity' => 'bail|required|integer|min:0',
            'unit' => 'bail|required|string|max:50',
            'cost_price' => 'bail|required|numeric|min:0',
            'sale_price' => 'bail|required|numeric|min:0',
            'description' => 'bail|nullable|string|max:1000',
            'image' => 'bail|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'manufacturer_id.required' => 'Vui lòng chọn nhà sản xuất.',
            'manufacturer_id.exists' => 'Nhà sản xuất không tồn tại.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng không được âm.',
            'unit.required' => 'Vui lòng nhập đơn vị tính.',
            'unit.string' => 'Đơn vị tính phải là chuỗi ký tự.',
            'unit.max' => 'Đơn vị tính không được vượt quá 50 ký tự.',
            'cost_price.required' => 'Vui lòng nhập giá vốn.',
            'cost_price.numeric' => 'Giá vốn phải là số.',
            'cost_price.min' => 'Giá vốn không được âm.',
            'sale_price.required' => 'Vui lòng nhập giá bán.',
            'sale_price.numeric' => 'Giá bán phải là số.',
            'sale_price.min' => 'Giá bán không được âm.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048 KB.',
        ];
    }
}
