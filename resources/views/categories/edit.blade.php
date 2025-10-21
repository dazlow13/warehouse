@extends('layout.master')

@section('content')
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Category Name -->
        <div class="mb-4">
            Category Name
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <!-- Image Upload -->
        <div class="mb-4">
            Image
            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-1 bg-white file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="Current
                Image" class="mt-2 w-20 h-20 object-cover">
            @endif
        </div>
        <!-- Buttons -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded">
            Update Category
        </button>
        <button type="button" onclick="window.history.back()"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </button>
    </form>
@endsection
