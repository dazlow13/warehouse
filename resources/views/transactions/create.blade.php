{{-- resources/views/transactions/create.blade.php --}}
@extends('layout.master')

@section('title')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">TẠO PHIẾU NHẬP / XUẤT KHO</h4>
    </div>

    <div class="card-body">
        <form id="transaction-form" action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- LOẠI PHIẾU -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Loại phiếu <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="import" value="import" checked>
                            <label class="form-check-label text-success fw-bold" for="import">NHẬP KHO</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="export" value="export">
                            <label class="form-check-label text-danger fw-bold" for="export">XUẤT KHO</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Ghi chú</label>
                    <input type="text" name="note" class="form-control" placeholder="VD: Nhập từ nhà cung cấp A">
                </div>
            </div>

            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="border rounded p-3 mb-3">
                <h5 class="text-primary">Chi tiết sản phẩm</h5>
                <div id="items-container">
                    <!-- Dòng mẫu -->
                    <div class="item-row row align-items-end mb-2 border-bottom pb-2">
                        <div class="col-md-5">
                            <label class="form-label small">Sản phẩm</label>
                            <select name="items[0][product_id]" class="form-select product-select" required>
                                <option value="">-- Chọn sản phẩm --</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" data-price="{{ $p->sale_price }}" data-stock="{{ $p->quantity }}">
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
                            <input type="number" name="items[0][unit_price]" class="form-control unit-price" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">Thành tiền</label>
                            <input type="text" class="form-control line-total text-end fw-bold" readonly>
                        </div>
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-danger" title="Xóa dòng">
                                Xóa
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-item" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="fas fa-plus"></i> Thêm sản phẩm
                </button>
            </div>

            <!-- TỔNG TIỀN -->
            <div class="text-end mb-3">
                <h4>Tổng cộng: <span id="grand-total" class="text-danger">0 ₫</span></h4>
            </div>

            <div class="text-end">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-success">Tạo phiếu</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let itemIndex = 1;

$(document).on('change', '.product-select', function() {
    const price = $(this).find(':selected').data('price') || 0;
    $(this).closest('.item-row').find('.unit-price').val(price.toFixed(2));
    calculateLine($(this).closest('.item-row'));
});

$(document).on('input', '.quantity, .unit-price', function() {
    calculateLine($(this).closest('.item-row'));
});

function calculateLine(row) {
    const qty = parseFloat(row.find('.quantity').val()) || 0;
    const price = parseFloat(row.find('.unit-price').val()) || 0;
    const total = qty * price;
    row.find('.line-total').val(total.toLocaleString('vi-VN') + ' ₫');
    calculateGrandTotal();
}

function calculateGrandTotal() {
    let total = 0;
    $('.line-total').each(function() {
        const val = $(this).val().replace(/[^\d.-]/g, '');
        total += parseFloat(val) || 0;
    });
    $('#grand-total').text(total.toLocaleString('vi-VN') + ' ₫');
}

$('#add-item').click(function() {
    const template = `
        <div class="item-row row align-items-end mb-2 border-bottom pb-2">
            <div class="col-md-5">
                <select name="items[${itemIndex}][product_id]" class="form-select product-select" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" data-price="{{ $p->sale_price }}" data-stock="{{ $p->quantity }}">
                            {{ $p->name }} (Tồn: {{ $p->quantity }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" min="1" value="1" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][unit_price]" class="form-control unit-price" min="0" step="0.01" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control line-total text-end fw-bold" readonly>
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger btn-sm remove-item">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;
    
    $('#items-container').append(template);
    itemIndex++;
});

$(document).on('click', '.remove-item', function() {
    if ($('.item-row').length > 1) {
        $(this).closest('.item-row').remove();
        calculateGrandTotal();
    }
});

// Kiểm tra tồn kho khi xuất
$('input[name="type"]').change(function() {
    if ($(this).val() === 'export') {
        $('.product-select').each(function() {
            const stock = $(this).find(':selected').data('stock') || 0;
            $(this).closest('.item-row').find('.quantity').attr('max', stock);
        });
    } else {
        $('.quantity').removeAttr('max');
    }
});
</script>
@endpush