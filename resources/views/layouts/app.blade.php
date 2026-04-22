<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dashboard Admin PSC119 Kab. Nganjuk') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('LogoPSC.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-slate-900" x-data="{ sidebarOpen: true, loading: true }" x-init="window.addEventListener('load', () => loading = false)">

    <div x-show="loading" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white px-4">

        <div class="relative flex items-center justify-center">
            <div class="absolute w-20 h-20 md:w-24 md:h-24 bg-red-100 rounded-full animate-ping opacity-20"></div>
            <img src="{{ asset('LogoPSC.png') }}"
                class="relative w-24 h-24 md:w-32 md:h-32 animate-pulse object-contain" alt="Loading PSC Nganjuk">
        </div>

        <p
            class="mt-6 md:mt-8 text-[10px] md:text-sm font-bold text-red-800 tracking-[0.2em] md:tracking-[0.3em] animate-pulse uppercase text-center">
            Sedang Memuat...
        </p>
    </div>

    <div class="flex min-h-screen">
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-72'"
            class="fixed inset-y-0 left-0 z-30 transition-transform duration-300 ease-in-out">
            @include('layouts.sidebar')
        </div>

        <div class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-72' : 'ml-0'">
            <div class="sticky top-0 z-20">
                @include('layouts.navigation')
            </div>

            <main class="p-8">
                <div class="w-full mx-auto">
                    @isset($header)
                        <div class="mb-8">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    background: '#ffffff',
                    iconColor: '#10b981',
                    customClass: {
                        popup: 'rounded-3xl shadow-xl border border-slate-100'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#ef4444',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-3xl shadow-xl border border-slate-100'
                    }
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Periksa Kembali',
                    html: '<ul class="text-left text-sm">{!! implode('', $errors->all('<li>• :message</li>')) !!}</ul>',
                    confirmButtonText: 'Pahami',
                    confirmButtonColor: '#f59e0b',
                    customClass: {
                        popup: 'rounded-3xl shadow-xl border border-slate-100'
                    }
                });
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
