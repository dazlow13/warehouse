@extends('layout.master')

@section('content')
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <!-- Category Name -->
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">

            @if ($category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" class="img-thumbnail"
                        style="max-width: 100px;">
                </div>
            @endif
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>

@endsection