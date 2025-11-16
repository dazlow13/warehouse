@extends('layout.master')
@section('title', 'Thống kê nhập xuất')

@section('content')
<div class="container-fluid py-4">
    <h1 class="h3 mb-4 text-gray-800">Thống kê nhập/xuất kho</h1>

    @livewire('transaction-analytics')
</div>
@endsection
