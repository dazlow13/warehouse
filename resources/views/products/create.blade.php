@extends('layout.master')
@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white rounded shadow-sm">
        @csrf

        <!-- Product Name -->
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Manufacturer -->
        <div class="mb-3">
            <label class="form-label">Manufacturer</label>
            <select name="manufacturer_id" class="form-select">
                @foreach ($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id') == $manufacturer->id ? 'selected' : '' }}>
                        {{ $manufacturer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <!-- Unit -->
        <div class="mb-3">
            <label class="form-label">Unit</label>
            <select name="unit" class="form-select">
                <option value="kg">Kg</option>
                <option value="cai">Cái</option>
                <option value="hop">Hộp</option>
                <option value="litre">Lít</option>
                <option value="bo">Bộ</option>
            </select>
        </div>

        <!-- Cost Price -->
        <div class="mb-3">
            <label class="form-label">Cost Price</label>
            <input type="number" step="0.01" name="cost_price" class="form-control" required>
        </div>

        <!-- Sale Price -->
        <div class="mb-3">
            <label class="form-label">Sale Price</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Create Product</button>
        <a href="{{ route('products.index') }}" class="btn-cancel">
            Cancel
        </a>
    </form>
@endsection