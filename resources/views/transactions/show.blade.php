{{-- resources/views/transactions/show.blade.php --}}
@extends('layout.master')

@section('title', 'Chi tiết phiếu ' . $transaction->code)

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            PHIẾU {{ strtoupper($transaction->type === 'import' ? 'NHẬP' : 'XUẤT') }} KHO
            <span class="badge bg-light text-dark fs-6">{{ $transaction->code }}</span>
        </h4>
        <a href="{{ route('transactions.print', $transaction) }}" target="_blank" class="btn btn-light btn-sm">
            <i class="fas fa-print"></i> In phiếu
        </a>
    </div>

    <div class="card-body">
        <!-- THÔNG TIN CHUNG -->
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr><th width="120">Người tạo:</th><td>{{ $transaction->user->name }}</td></tr>
                    <tr><th>Ngày tạo:</th><td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td></tr>
                    <tr><th>Loại phiếu:</th><td>
                        <span class="badge {{ $transaction->type === 'import' ? 'bg-success' : 'bg-danger' }}">
                            {{ $transaction->type === 'import' ? 'Nhập kho' : 'Xuất kho' }}
                        </span>
                    </td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr><th width="120">Tổng SL:</th><td><strong>{{ $transaction->quantity }}</strong> sản phẩm</td></tr>
                    <tr><th>Tổng tiền:</th><td><strong class="text-danger fs-5">${{ number_format($transaction->total_amount) }} </strong></td></tr>
                    <tr><th>Ghi chú:</th><td>{{ $transaction->note ?? 'Không có' }}</td></tr>
                </table>
            </div>
        </div>

        <!-- BẢNG CHI TIẾT -->
        <h5 class="border-bottom pb-2">Chi tiết sản phẩm</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Sản phẩm</th>
                        <th width="15%">Danh mục</th>
                        <th width="15%">NSX</th>
                        <th width="10%" class="text-end">SL</th>
                        <th width="15%" class="text-end">Đơn giá</th>
                        <th width="15%" class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaction->details as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $detail->product->name }}</strong>
                                @if($detail->product->description)
                                    <br><small class="text-muted">{{ Str::limit($detail->product->description, 60) }}</small>
                                @endif
                            </td>
                            <td>{{ $detail->product->category->name ?? '—' }}</td>
                            <td>{{ $detail->product->manufacturer->name ?? '—' }}</td>
                            <td class="text-end fw-bold">{{ $detail->quantity }}</td>
                            <td class="text-end">{{ number_format($detail->unit_price) }}</td>
                            <td class="text-end fw-bold text-primary">
                                ${{ number_format($detail->quantity * $detail->unit_price) }} 
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Không có sản phẩm</td></tr>
                    @endforelse
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">TỔNG CỘNG:</th>
                        <th class="text-end">{{ $transaction->details->sum('quantity') }}</th>
                        <th></th>
                        <th class="text-end text-danger fs-5">
                            ${{ number_format($transaction->total_amount) }} 
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- CHỮ KÝ -->
        <div class="row mt-5">
            <div class="col-6 text-center">
                <p><strong>Người lập phiếu</strong></p>
                <p class="mt-5">(Ký, ghi rõ họ tên)</p>
            </div>
            <div class="col-6 text-center">
                <p><strong>Thủ kho</strong></p>
                <p class="mt-5">(Ký, ghi rõ họ tên)</p>
            </div>
        </div>
    </div>

    <div class="card-footer text-end">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th { font-weight: 600; }
    .badge { font-size: 0.9rem; }
</style>
@endpush