<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/css/app.css')
    <style>
        .toast {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .toast-show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast-hide {
            opacity: 0;
            transform: translateY(100%);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <!-- Toast Notification -->
    @if ($errors->any())
        <div id="toast"
            class="toast toast-show fixed top-5 right-5 bg-red-500 text-white p-4 rounded-lg shadow-lg">
            <p id="toast-message">{{ $errors->first() }}</p>
        </div>
    @endif
    @yield('content')
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.remove('toast-show');
                toast.classList.add('toast-hide');
            }
        }, 3000); // Hide toast after 3 seconds
    </script>
</body>

</html>
