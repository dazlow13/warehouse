@extends ('layout.master')

@section('content')
    <a href="{{ route('manufacturers.create') }}"
        class="mb-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Thêm nhà sản xuất
    </a>
    <table id="manufacturers-table" class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th>ID</th>
                <th>Manufacturer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Description</th>
                <th>Created At</th>
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
            $('#manufacturers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("manufacturers.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'description', name: 'description',orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at',orderable: false, searchable: false }, 
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'destroy', name: 'destroy', orderable: false, searchable: false },
                ],
            });
        });
    </script>
@endpush