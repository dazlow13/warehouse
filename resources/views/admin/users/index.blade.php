@extends('layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Quản lý người dùng</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Tạo tài khoản mới
        </a>
    </div>
    <div class="table-responsive">
        <table id="user-table" class="table table-striped table-bordered w-100">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created_at</th>
                    <th>Delete</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("users.api") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' }, 
                    { data: 'created_at', name: 'created_at', searchable: false },
                    { data: 'destroy', name: 'destroy', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush