@extends('layout.master')

@section('content')
<a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">
        Tạo phiếu nhập/xuất kho
    </a>
    <div class="table-responsive">
        <table id="transaction-table" class="table table-striped table-bordered w-100">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>User</th>
                    <th>Product Name</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Created At</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#transaction-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("transactions.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'code', name: 'code' },
                    { data: 'user', name: 'user' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'total_items', name: 'total_items' },
                    { data: 'total_amount_formatted', name: 'total_amount' },
                    { data: 'created_at_formatted', name: 'created_at' },
                    { data: 'type_label', name: 'type' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush