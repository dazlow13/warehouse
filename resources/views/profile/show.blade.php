@extends('layout.master')
@section('content')
<div class="container mt-5">
    <h1>Xin chào {{ Auth::user()->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined At:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    <br>
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Sửa hồ sơ</a>
@endsection