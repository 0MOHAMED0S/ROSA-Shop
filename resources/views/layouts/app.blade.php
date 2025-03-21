<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('files/main_images/logo/logo.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('CSS/footer.css')}}">
<link rel="stylesheet" href="{{asset('CSS/loader.css')}}">
<link rel="stylesheet" href="{{ asset('CSS/all.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        .text-gray-800 {
            --tw-text-opacity: 1;
            color: #ff0076;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Loader -->
<div id="loader">
    <div class="spinner"></div>
</div>

    <div class="min-h-screen bg-gray-100">
        <livewire:layout.navigation />
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <!-- Footer Section -->
    @include('layouts.footer')
<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    @stack('scripts')
    <script>
        window.addEventListener("load", function () {
            let loader = document.getElementById("loader");
            loader.style.opacity = "0";
            setTimeout(() => {
                loader.style.display = "none";
            }, 500); // Smooth fade-out in 0.5s
        });
    </script>


</body>
</html>
