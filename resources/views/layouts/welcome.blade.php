<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TiketMu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        /* Custom Scroll Snap & Blur Effect */
        .scroll-section {
            height: 100vh;
            scroll-snap-align: start;
            position: relative;
        }

        .footer-scroll-section {
            scroll-snap-align: start;
            position: relative;
        }


        .blurred-background {
            backdrop-filter: blur(12px);
        }

        .bg-primary {
            background-color: #1c1c1c;
            /* Dark Gray */
        }

        .bg-secondary {
            background-color: #f5f5f5;
            /* Light Gray */
        }

        .text-highlight {
            color: #4f89e1;
            /* Blue */
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .section-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem;
            text-align: center;
        }

        .heading-primary {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            /* White */
            margin-bottom: 20px;
        }

        .text-body {
            font-size: 1.125rem;
            color: #d1d5db;
            /* Light Gray */
            line-height: 1.7;
        }

        .button-main {
            background-color: #4f89e1;
            /* Blue */
            color: #ffffff;
            /* White */
            padding: 16px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease-in-out;
        }

        .button-main:hover {
            background-color: #3578a5;
            /* Darker Blue */
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .bubble-item {
            display: inline-block;
            margin: 8px;
            padding: 12px 24px;
            background-color: #4f89e1;
            /* Blue */
            color: white;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            max-width: 50vw;
        }

        .bubble-item:hover {
            background-color: #3578a5;
            /* Darker Blue on hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            scroll-behavior: smooth;
            /* Smooth scrolling */
        }

        .content {
            flex-grow: 1;
        }

        .scroll-section {
            height: 100vh;
            scroll-snap-align: start;
        }

        body:not(.snap-disabled) .scroll-section {
            scroll-snap-type: none;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }

        #login {
            scroll-snap-align: unset;
            /* Remove snap alignment */
        }
    </style>
</head>

<body class="bg-gray-900 text-white overflow-hidden scroll-smooth">
    <div class="content">
        @yield('content')
    </div>
</body>

</html>