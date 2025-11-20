@extends('layout.master')
@section('content')
    <h1 class="h3 text-gray-800 mb-4">Tạo tài khoản người dùng mới</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>Tên</label>
        <input type="text" name="name" required>
        <br>
        <label>Email</label>
        <input type="email" name="email" required>
        <br>
        <label>Mật khẩu</label>
        <input type="password" name="password" required>
        <br>
        <label>Nhập lại mật khẩu</label>
        <input type="password" name="password_confirmation" required>
        <br>
        <label>Vai trò</label>
        <select name="role">
            <option value="manager">Manager</option>
            <option value="warehouseman">Warehouseman</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Tạo tài khoản</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection