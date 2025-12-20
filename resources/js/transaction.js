let itemIndex = 0;
// ĐỊNH DẠNG TIỀN USD ĐẸP
function formatMoney(num) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(num);
}

// Cập nhật thành tiền từng dòng
function updateLineTotal(row) {
    const qty = parseFloat(row.querySelector('.quantity').value) || 0;
    const price = parseFloat(row.querySelector('.unit-price').value) || 0;
    const total = qty * price;
    row.querySelector('.line-total').value = formatMoney(total);
    updateGrandTotal();
}

// Cập nhật tổng cộng
function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.line-total').forEach(el => {
        const val = el.value.replace(/[^\d.-]/g, '');
        total += parseFloat(val) || 0;
    });
    document.getElementById('grand-total').textContent = formatMoney(total);
}

// Điền giá theo loại phiếu
function updatePriceFromType() {
    const checkedRadio = document.querySelector('input[name="type"]:checked');
    if (!checkedRadio) return;
    const type = checkedRadio.value;

    document.querySelectorAll('.item-row').forEach(row => {
        const select = row.querySelector('.product-select');
        const option = select.options[select.selectedIndex];
        if (!option || !option.value) return;

        let price = type === 'import' 
            ? parseFloat(option.dataset.costPrice) || 0
            : parseFloat(option.dataset.salePrice) || 0;

        row.querySelector('.unit-price').value = price.toFixed(2);
        updateLineTotal(row);
    });
}

// ================== CHẠY SAU KHI DOM LOAD XONG ==================
document.addEventListener('DOMContentLoaded', function () {
    // Gắn sự kiện cho radio loại phiếu
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', updatePriceFromType);
    });

    // Thêm dòng mới
    const addBtn = document.getElementById('add-item');
    if (addBtn) {
        addBtn.addEventListener('click', function () {
            itemIndex++;
            const template = `
                <div class="item-row row align-items-end g-2 mb-3 pb-3 border-bottom">
                    <div class="col-md-5">
                        <label class="form-label small">Product</label>
                        <select name="items[${itemIndex}][product_id]" class="form-select product-select" required>
                            <option value="">-- Select product --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}"
                                        data-cost-price="{{ $p->cost_price }}"
                                        data-sale-price="{{ $p->sale_price }}"
                                        data-stock="{{ $p->quantity }}">
                                    {{ $p->name }} (Stock: {{ $p->quantity }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Qty</label>
                        <input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" min="1" value="1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Unit Price</label>
                        <input type="number" step="0.01" name="items[${itemIndex}][unit_price]" class="form-control unit-price" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Total</label>
                        <input type="text" class="form-control line-total text-end fw-bold bg-white" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-item">Delete</button>
                    </div>
                </div>`;
            document.getElementById('items-container').insertAdjacentHTML('beforeend', template);
        });
    }

    // Sự kiện thay đổi (sản phẩm, số lượng)
    document.addEventListener('change', function (e) {
        if (e.target.matches('.product-select')) {
            updatePriceFromType();
        }
        if (e.target.matches('.quantity')) {
            updateLineTotal(e.target.closest('.item-row'));
        }
    });

    // Xóa dòng
    document.addEventListener('click', function (e) {
        if (e.target.matches('.remove-item')) {
            if (document.querySelectorAll('.item-row').length > 1) {
                e.target.closest('.item-row').remove();
                updateGrandTotal();
            }
        }
    });

    // Chạy lần đầu
    updatePriceFromType();
});