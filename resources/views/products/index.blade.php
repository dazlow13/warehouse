@extends('layout.master')

@section('content')
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        Thêm sản phẩm
    </a>
    <div class="table-responsive">
        <table id="products-table" class="table table-striped table-bordered w-full">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Manufacturer</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Cost Price</th>
                    <th>Sale Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("products.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'category_name', name: 'category.name' },
                    { data: 'manufacturer_name', name: 'manufacturer.name' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'unit', name: 'unit' },
                    { data: 'cost_price', name: 'cost_price' },
                    { data: 'sale_price', name: 'sale_price' },
                    { data: 'description', name: 'description' },
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
                            }
                            // Nếu là ảnh upload (file thật trong storage)
                            let baseUrl = "{{ asset('storage') }}";
                            return `<img src="${baseUrl}/${data}" alt="Image" class="table-image">`;
                        }
                    },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'destroy', name: 'destroy', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush