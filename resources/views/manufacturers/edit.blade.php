@extends('layout.master')

@section('content')
<div class="container mt-4">
    <form action="{{ isset($manufacturer) ? route('manufacturers.update', $manufacturer->id) : route('manufacturers.store') }}" 
          method="POST">
        @csrf
        @if(isset($manufacturer))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Manufacturer Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $manufacturer->name ?? '') }}" required>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $manufacturer->email ?? '') }}">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', $manufacturer->phone ?? '') }}">
            @error('phone')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control"
                   value="{{ old('address', $manufacturer->address ?? '') }}">
            @error('address')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $manufacturer->description ?? '') }}</textarea>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-4">
            {{ isset($manufacturer) ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('manufacturers.index') }}" class="btn btn-secondary px-4 ms-2">
            Cancel
        </a>
    </form>
</div>

@endsection
