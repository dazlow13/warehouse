@extends('layout.master')
@section('content')
    <form action="{{ route('manufacturers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            Manufacturer Name
            <input type="text" name="name" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            <br>
            Address
            <input type="text" name="address" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            <br>
            Phone
            <input type="text" name="phone" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            <br>
            Email
            <input type="email" name="email" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            <br>
            Description
            <textarea name="description" class="border border-gray-300 rounded px-3 py-2w-full" required></textarea>
            <br>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Create
                Manufacturer</button>
            <a href="{{ route('manufacturers.index') }}"
                class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>
@endsection