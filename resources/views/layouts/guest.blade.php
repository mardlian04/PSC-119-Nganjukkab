<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased tracking-tight">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-gray-200">

        <div class="mb-2">
            <a href="/" class="flex flex-col items-center gap-3 group">
                <div
                    class="p-4 bg-white rounded-full shadow-xl shadow-red-100 group-hover:scale-105 transition-transform duration-300 border border-red-50 border-opacity-50">
                    <x-application-logo class="w-20 h-20 object-contain" />
                </div>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-[0_15px_35px_rgba(0,0,0,0.1)] overflow-hidden sm:rounded-2xl border-t-4 border-red-600">

            <div class="text-center mb-8">
                <h1 class="text-xl font-extrabold text-gray-800 uppercase tracking-widest">
                    PSC <span class="text-red-600">119</span>
                </h1>
                <div class="h-1 w-12 bg-red-600 mx-auto mt-2 rounded-full"></div>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>

</html>
