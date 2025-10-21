@extends('layout.master')
@section('content')
    <h1>{{$title}}</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <!-- Product Name -->
        <div class="mb-4">
            Product Name
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <!-- Product Price -->
        <div class="mb-4">
            Product Price
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <!-- Product Description -->
        <div class="mb-4">
            Product Description
            <textarea name="description" rows="4"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <!-- Buttons -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded">
            Update Product
        </button>
        <button type="button" onclick="window.history.back()"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </button>
    </form>

@endsection