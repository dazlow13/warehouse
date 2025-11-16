
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
    row.find('.line-total').val(
    total.toLocaleString('en-US', { style: 'currency', currency: 'USD' })
);
    calculateGrandTotal();
}

function calculateGrandTotal() {
    let total = 0;
    $('.line-total').each(function() {
        const val = $(this).val().replace(/[^\d.-]/g, '');
        total += parseFloat(val) || 0;
    });
    $('#grand-total').text(total.toLocaleString('en-US',{ style: 'currency', currency: 'USD' }));
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
    const isExport = $(this).val() === 'export';

    $('.product-select').each(function() {
        const stock = $(this).find(':selected').data('stock') || 0;
        const qtyInput = $(this).closest('.item-row').find('.quantity');

        if (isExport) {
            qtyInput.attr('max', stock);
        } else {
            qtyInput.removeAttr('max');
        }
    });
});

