@extends('layout.master')
@section('title', 'Tạo phiếu nhập/xuất kho')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">TẠO PHIẾU NHẬP / XUẤT KHO</h4>
    </div>

    <div class="card-body">
        <form id="transaction-form" action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- LOẠI PHIẾU -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Loại phiếu <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input type-radio" type="radio" name="type" id="import" value="import" checked>
                            <label class="form-check-label text-success fw-bold" for="import">NHẬP KHO</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input type-radio" type="radio" name="type" id="export" value="export">
                            <label class="form-check-label text-danger fw-bold" for="export">XUẤT KHO</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Ghi chú</label>
                    <input type="text" name="note" class="form-control" placeholder="VD: Nhập từ NCC ABC">
                </div>
            </div>

            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="border rounded p-4 mb-4 bg-light">
                <h5 class="text-primary mb-3">Chi tiết sản phẩm</h5>
                <div id="items-container">
                    <!-- Dòng đầu tiên -->
                    <div class="item-row row align-items-end g-2 mb-3 pb-3 border-bottom">
                        <div class="col-md-5">
                            <label class="form-label small">Sản phẩm</label>
                            <select name="items[0][product_id]" class="form-select product-select" required>
                                <option value="">-- Chọn sản phẩm --</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}"
                                            data-cost-price="{{ $p->cost_price }}"
                                            data-sale-price="{{ $p->sale_price }}"
                                            data-stock="{{ $p->quantity }}">
                                        {{ $p->name }} (Tồn: {{ $p->quantity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">SL</label>
                            <input type="number" name="items[0][quantity]" class="form-control quantity" min="1" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Đơn giá</label>
                            <input type="number" step="0.01" name="items[0][unit_price]" class="form-control unit-price" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Thành tiền</label>
                            <input type="text" class="form-control line-total text-end fw-bold bg-white" readonly>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-item">Xóa</button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-item" class="btn btn-outline-primary btn-sm">
                    Thêm sản phẩm
                </button>
            </div>

            <!-- TỔNG TIỀN -->
            <div class="text-end mb-4">
                <h3 class="text-danger fw-bold">
                    Tổng cộng: <span id="grand-total">0 ₫</span>
                </h3>
            </div>

            <div class="text-end">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-success btn-lg px-5">Tạo phiếu</button>
            </div>
        </form>
    </div>
</div>
@endsection