@extends('layout.master')
@section('content')
    <form action="{{ route('manufacturers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-4">
    <form action="{{ route('manufacturers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Manufacturer Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary px-4">
            Create Manufacturer
        </button>
        <a href="{{ route('manufacturers.index') }}" class="btn btn-secondary ms-2 px-4">
            Cancel
        </a>
    </form>
</div>

    </form>
@endsection