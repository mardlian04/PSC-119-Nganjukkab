<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PSC 119 | Kab. Nganjuk' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo PSC.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        .no-scroll {
            overflow: hidden;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 flex flex-col min-h-screen" x-data="{ loading: true }" x-init="window.onload = () => { setTimeout(() => loading = false, 500) }"
    :class="{ 'no-scroll': loading }">

    <div x-show="loading" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white">

        <div class="relative flex items-center justify-center">
            <div class="absolute w-24 h-auto bg-red-100 rounded-full animate-ping opacity-20"></div>

            <img src="{{ asset('Logo PSC.png') }}"
                class="relative w-32 h-32 animate-pulse transition-transform duration-700" alt="Logo PSC">
        </div>

        <p class="mt-6 text-xs md:text-sm font-bold tracking-[0.2em] animate-pulse">
            Mohon Tunggu Sedang Memuat...
        </p>
    </div>

    <x-frontend.navbar />

    <main class="flex-grow" x-show="!loading" x-cloak x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">

        {{ $slot }}

    </main>

    <x-frontend.footer />

</body>

</html>
