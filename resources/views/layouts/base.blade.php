<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TiketMu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-purple-50 dark:bg-gray-900">

        @yield('navigation')

        @hasSection('header')
        <header class="text-black dark:text-white bg-blue-50 dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
        @endif

        <main class="p-6">
            @yield('content')
        </main>

        @hasSection('footer')
        <footer class="bg-gray-900 text-white px-6 py-12 border-t border-gray-700">
            @include('layouts.footer')
        </footer>
        @endif
    </div>
</body>

</html>