@extends('layout.master')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">
        {{ isset($manufacturer) ? 'Edit Manufacturer' : 'Add New Manufacturer' }}
    </h2>
    <form action="{{ isset($manufacturer) ? route('manufacturers.update', $manufacturer->id) : route('manufacturers.store') }}" 
          method="POST" class="space-y-4">
        @csrf
        @if(isset($manufacturer))
            @method('PUT')
        @endif

        {{-- Name --}}
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" 
                   value="{{ old('name', $manufacturer->name ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $manufacturer->email ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-1">Phone</label>
            <input type="text" id="phone" name="phone"
                   value="{{ old('phone', $manufacturer->phone ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Address --}}
        <div>
            <label for="address" class="block text-gray-700 font-medium mb-1">Address</label>
            <input type="text" id="address" name="address"
                   value="{{ old('address', $manufacturer->address ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description', $manufacturer->description ?? '') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end space-x-3 mt-6">
            <button type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            {{ isset($manufacturer) ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('manufacturers.index') }}" 
           class="btn-cancel">
            Cancel
        </a>
    </div>
    </form>
</div>
@endsection
