let itemIndex = 0;

function formatMoney(num) {
    return new Intl.NumberFormat('en-US').format(num) + ' $';
}

function updateLineTotal(row) {
    const qty = parseFloat(row.querySelector('.quantity').value) || 0;
    const price = parseFloat(row.querySelector('.unit-price').value) || 0;
    const total = qty * price;
    row.querySelector('.line-total').value = formatMoney(total);
    updateGrandTotal();
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.line-total').forEach(el => {
        const val = el.value.replace(/[^\d]/g, '');
        total += parseFloat(val) || 0;
    });
    document.getElementById('grand-total').textContent = formatMoney(total);
}

function updatePriceFromType() {
    const type = document.querySelector('input[name="type"]:checked').value;
    document.querySelectorAll('.product-select').forEach(select => {
        const option = select.options[select.selectedIndex];
        if (!option || !option.value) return;

        let price = 0;
        if (type === 'import') {
            price = parseFloat(option.dataset.costPrice) || 0;
        } else {
            price = parseFloat(option.dataset.salePrice) || 0;
        }

        const row = select.closest('.item-row');
        const priceInput = row.querySelector('.unit-price');
        priceInput.value = price;
        updateLineTotal(row);
    });
}

// Khi thay đổi loại phiếu
document.querySelectorAll('input[name="type"]').forEach(radio => {
    radio.addEventListener('change', updatePriceFromType);
});

// Khi chọn sản phẩm
document.addEventListener('change', function(e) {
    if (e.target.matches('.product-select')) {
        updatePriceFromType();
    }
    if (e.target.matches('.quantity, .unit-price')) {
        updateLineTotal(e.target.closest('.item-row'));
    }
});

// Thêm dòng mới
document.getElementById('add-item').addEventListener('click', function() {
    itemIndex++;
    const template = `
        <div class="item-row row align-items-end g-2 mb-3 pb-3 border-bottom">
            <div class="col-md-5">
                <select name="items[${itemIndex}][product_id]" class="form-select product-select" required>
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
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" min="1" value="1" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="items[${itemIndex}][unit_price]" class="form-control unit-price" readonly>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control line-total text-end fw-bold bg-white" readonly>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-item">Xóa</button>
            </div>
        </div>`;
    
    document.getElementById('items-container').insertAdjacentHTML('beforeend', template);
});

// Xóa dòng
document.addEventListener('click', function(e) {
    if (e.target.matches('.remove-item')) {
        if (document.querySelectorAll('.item-row').length > 1) {
            e.target.closest('.item-row').remove();
            updateGrandTotal();
        }
    }
});

// Khởi chạy lần đầu
document.addEventListener('DOMContentLoaded', function() {
    updatePriceFromType();
});