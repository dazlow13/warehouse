@extends('layout.master')
@section('content')
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Category Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">
            Create Category
        </button>
        <a href="{{ route('categories.index') }}" class="btn-cancel">
            Cancel
        </a>
    </form>


@endsection