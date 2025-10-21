<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    {{-- Bootstrap & app CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-light text-dark">

    <div class="d-flex min-vh-100">

        {{-- Sidebar --}}
        <nav class="flex-shrink-0 p-3 bg-white text-white" style="width: 250px;">
            @include('layout.sidebar')
        </nav>

        {{-- Main content --}}
        <div class="flex-grow-1 d-flex flex-column">

            {{-- Header --}}
            <header class="bg-white border-bottom shadow-sm p-3">
                @include('layout.header')
            </header>

            {{-- Page Title --}}
            <div class="bg-light border-bottom px-4 py-2">
                <h4 class="fw-semibold m-0">{{ $title ?? 'Page Title' }}</h4>
            </div>

            {{-- Content --}}
            <main class="flex-grow-1 p-4 overflow-auto bg-white">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- jQuery nếu cần DataTables hoặc Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @stack('scripts')
</body>
</html>
