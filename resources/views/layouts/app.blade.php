<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dashboard Admin PSC') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo PSC.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-slate-900">
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col ml-72 transition-all duration-300">
            <div class="sticky top-0 z-10">
                @include('layouts.navigation')
            </div>

            <main class="p-8">
                <div class="w-full mx-auto">
                    @isset($header)
                        <header class="mb-8">
                            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
