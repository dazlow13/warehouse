<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check(); // Chỉ user đăng nhập mới được tạo
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['import', 'export'])],
            'note' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Vui lòng chọn loại phiếu.',
            'type.in' => 'Loại phiếu không hợp lệ.',
            'items.required' => 'Vui lòng thêm ít nhất 1 sản phẩm.',
            'items.*.product_id.exists' => 'Sản phẩm không tồn tại.',
            'items.*.quantity.min' => 'Số lượng phải lớn hơn 0.',
        ];
    }

    // Tùy chọn: Chuẩn bị dữ liệu trước validate
    protected function prepareForValidation()
    {
        $this->merge([
            'items' => collect($this->items)->filter(function ($item) {
                return !empty($item['product_id']);
            })->values()->all(),
        ]);
    }
}