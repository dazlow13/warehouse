<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phiếu {{ $transaction->type === 'import' ? 'Nhập' : 'Xuất' }} kho - {{ $transaction->code }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .badge { padding: 5px 10px; border-radius: 5px; color: white; }
        .bg-success { background: #28a745; }
        .bg-danger { background: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PHIẾU {{ strtoupper($transaction->type === 'import' ? 'NHẬP' : 'XUẤT') }} KHO</h2>
        <p>Mã phiếu: <strong>{{ $transaction->code }}</strong></p>
    </div>

    <p><strong>Người tạo:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Ngày tạo:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Ghi chú:</strong> {{ $transaction->note ?? 'Không có' }}</p>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>ĐVT</th>
                <th>SL</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->product->unit }}</td>
                    <td class="text-right">{{ $detail->quantity }}</td>
                    <td class="text-right">{{ number_format($detail->unit_price) }}</td>
                    <td class="text-right">{{ number_format($detail->quantity * $detail->unit_price) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                <td class="text-right"><strong>{{ $transaction->details->sum('quantity') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($transaction->total_amount) }} ₫</strong></td>
            </tr>
        </tbody>
    </table>

<table style="width:100%; margin-top: 50px; border: none;">
  <tr>
    <td style="width:35%; text-align: center; border: none; vertical-align: top;">
      <p><strong>Người lập phiếu</strong></p>
      <p>(Ký, ghi rõ họ tên)</p>
    </td>
    <td style="width: 30%; border: none" ></td>
    <td style="width: 35%; text-align: center; border: none; vertical-align: top;">
      <p><strong>Thủ kho</strong></p>
      <p>(Ký, ghi rõ họ tên)</p>
    </td>
  </tr>
</table>
</body>
</html>