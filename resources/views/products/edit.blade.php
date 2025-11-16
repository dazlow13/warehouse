@extends('layout.master')
@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Manufacturer</label>
            <select name="manufacturer_id" class="form-select" required>
                <option value="">Select Manufacturer</option>
                @foreach($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id', $product->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>
                        {{ $manufacturer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @role('admin')
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control"
                required>
        </div>
        @endrole

        <div class="mb-3">
            <label class="form-label">Unit</label>
            <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" class="form-control" required>
        </div>

        <div>
            <label class="form-label">Cost Price</label>
            <input type="text" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="form-control"
                required>
        </div>
        <div>

            <div class="mb-3">
                <label class="form-label">Sale Price</label>
                <input type="text" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Description</label>
                <textarea name="description" rows="4" class="form-control"
                    required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="form-label">Product Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>


            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn-cancel">
                    Cancel
                </a>
            </div>
    </form>


@endsection