<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website Resmi PSC 119 Kabupaten Nganjuk">
    <meta name="author" content="PSC 119 Kab. Nganjuk">
    <title>{{ $title ?? 'PSC 119 | Kab. Nganjuk' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('LogoPSC.png') }}">
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

<body class="antialiased bg-gray-50 flex flex-col min-h-screen text-gray-900 overflow-x-hidden" x-data="{ loading: true }"
    x-init="window.onload = () => { setTimeout(() => loading = false, 500) }" :class="{ 'no-scroll': loading }">

    <div x-show="loading" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white px-4">

        <div class="relative flex items-center justify-center">
            <div class="absolute w-20 h-20 md:w-24 md:h-24 bg-red-100 rounded-full animate-ping opacity-20"></div>
            <img src="{{ asset('Logo PSC.png') }}"
                class="relative w-24 h-24 md:w-32 md:h-32 animate-pulse object-contain" alt="Loading PSC Nganjuk">
        </div>

        <p
            class="mt-6 md:mt-8 text-[10px] md:text-sm font-bold text-red-800 tracking-[0.2em] md:tracking-[0.3em] animate-pulse uppercase text-center">
            Sedang Memuat...
        </p>
    </div>

    <header role="banner" class="sticky top-0 z-[100] w-full bg-white shadow-sm">
        <x-frontend.navbar />
    </header>

    <main id="main-content" class="flex-grow focus:outline-none w-full" x-show="!loading" x-cloak
        x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0">

        {{ $slot }}

    </main>

    <div x-show="!loading" class="fixed bottom-4 right-4 md:bottom-6 md:right-6 z-[999] group flex items-center"
        x-transition:enter="transition ease-out duration-1000 delay-500"
        x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">

        <div
            class="mr-3 bg-white px-4 py-2 rounded-full shadow-lg border border-gray-100 hidden md:block group-hover:scale-105 transition-transform duration-300">
            <span class="text-sm font-bold bg-gradient-to-r from-green-600 to-green-400 bg-clip-text text-transparent">
                Butuh Bantuan? Hubungi Kami
            </span>
        </div>

        <div class="relative">
            <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-25"></span>

            <a href="https://wa.me/6281131168119" target="_blank" rel="noopener"
                class="relative flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-[#25D366] text-white rounded-full shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:-translate-y-1 hover:rotate-[10deg] active:scale-95"
                aria-label="Chat WhatsApp">
                <i class="fa-brands fa-whatsapp text-3xl md:text-4xl"></i>
            </a>
        </div>
    </div>

    <footer role="contentinfo" class="w-full mt-auto">
        <x-frontend.footer />
    </footer>

</body>

</html>
