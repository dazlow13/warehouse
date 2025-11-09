@extends('layout.master')

@section('content')
<div class="table-responsive">
    <table id="inventory-table" class="table table-striped table-bordered w-full">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Manufacturer</th>
                <th>Unit</th>
                <th>Inventory</th>
                <th>Sale Price</th>
                <th>Image</th>
                <th>Created At</th>
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
        $(document).ready(function () {
            $('#inventory-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("inventory.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'category_name', name: 'category.name' },
                    { data: 'manufacturer_name', name: 'manufacturer.name' },
                    { data: 'unit', name: 'unit' },
                    { data: 'quantity_status', name: 'quantity', orderable: false, searchable: false },
                    { data: 'sale_price', name: 'sale_price' },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            if (!data) return '';
                            // Nếu là link đầy đủ (ảnh faker)
                            if (data.startsWith('http')) {
                                return `<img src="${data}" alt="Image" class="table-image">`;
                            } else {
                                return `<img src="/storage/${data}" alt="Image" class="table-image">`;
                            }
                        }
                    },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
        });
    </script>
@endpush