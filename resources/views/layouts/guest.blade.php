<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-100 via-purple-100 to-fuchsia-200">
        <div>
            <a href="/">
                <x-application-logo
                    class="w-24 h-24 fill-current text-purple-700 drop-shadow-lg transition-transform hover:scale-105 duration-300" />
            </a>
        </div>

        <div
            class="purple-pearl-card w-full sm:max-w-md mt-6 px-8 py-10 bg-white/40 backdrop-blur-xl border border-white/60 shadow-2xl overflow-hidden sm:rounded-3xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>