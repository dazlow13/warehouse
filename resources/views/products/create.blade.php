@extends('layout.master')
@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Product Name -->
        <div class="mb-4">
            Product Name
            <input type="text" name="name"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        Category
        <div class="mb-4">
            <select name="category_id" id=""
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        Manufacturer
        <div class="mb-4">
            <select name="manufacturer_id" id=""
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500">
                @foreach ($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id') == $manufacturer->id ? 'selected' : '' }}>
                        {{ $manufacturer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            Quantity
            <input type="number" name="quantity"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            Unit
            <select name="unit"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500">
                <option value="kg">Kg</option>
                <option value="cai">Cái</option>
                <option value="hop">Hộp</option>
                <option value="litre">Lít</option>
                <option value="bo">Bộ</option>
            </select>
        </div>
        <div class="mb-4">
            Cost Price
            <input type="number" step="0.01" name="cost_price"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            Sale Price
            <input type="number" step="0.01" name="sale_price"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            Description
            <textarea name="description" rows="4"
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <!-- Image Upload -->
        <div class="mb-4">
            Image
            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-1 bg-white file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
        </div>
        <!-- Buttons -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded">
            Create Product
        </button>
        <button type="button" onclick="window.history.back()"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </button>
    </form>
@endsection