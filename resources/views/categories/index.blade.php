@extends('layout.master')

@section('content')
    <a href="{{ route('categories.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-3 inline-block hover:bg-blue-700">
        + Thêm danh mục
    </a>
    <table id="categories-table" class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Product quantity</th>
                <th>Image</th>
                <th>Create At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
    </table>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("categories.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug'},
                    { data: 'product_count', name: 'products_count' },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            if (!data) return '';
                            // Nếu là link đầy đủ (ảnh faker)
                            if (data.startsWith('http')) {
                                return `<img src="${data}" alt="Image" class="w-12 h-12 object-cover rounded">`;
                            }
                            // Nếu là ảnh upload (file thật trong storage)
                            let baseUrl = "{{ asset('storage') }}";
                            return `<img src="${baseUrl}/${data}" alt="Image" class="w-12 h-12 object-cover rounded">`;
                        }
                    },
                    { data: 'created_at', name: 'created_at', searchable: false },
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'destroy', name: 'destroy', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush