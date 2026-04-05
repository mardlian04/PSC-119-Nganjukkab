<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 font-poppins">

            <div class="flex flex-col gap-1 font-poppins">
                <div class="flex items-center gap-3">
                    <div
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-red-50 border border-red-100 text-red-600 shadow-sm">
                        <i class="fa-solid fa-user-check text-xs"></i>
                    </div>

                    <div
                        class="flex items-center bg-slate-50 px-4 py-1.5 rounded-full border border-slate-100 shadow-inner">
                        <span id="sapaan" class="text-xs font-medium text-slate-500 uppercase tracking-wider">
                            Memuat...
                        </span>

                        <span class="mx-2 text-slate-300 animate-pulse">•</span>

                        <span
                            class="text-sm font-bold text-slate-800 hover:text-red-700 transition-colors cursor-default">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div
                    class="hidden sm:flex items-center bg-white border border-slate-200 px-4 py-2 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="mr-3 p-2 bg-red-50 rounded-lg">
                        <i class="fa-regular fa-clock text-red-600"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider leading-none">Waktu
                        </span>
                        <span id="jam-realtime" class="text-sm font-bold text-slate-900 font-mono">00:00:00</span>
                    </div>
                </div>

                <div
                    class="flex items-center bg-white border border-slate-200 px-5 py-2.5 rounded-2xl shadow-lg transition-transform hover:scale-[1.02]">
                    <div class="mr-3 text-red-500">
                        <i class="fa-solid fa-calendar-day text-lg"></i>
                    </div>
                    <div class="flex flex-col">
                        <span id="hari-ini"
                            class="text-[10px] uppercase font-bold tracking-widest leading-none">HARI</span>
                        <span id="tanggal-ini" class="text-sm font-semibold tracking-tight">00 Bulan 202X</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateClock() {
                const now = new Date();
                const hours = now.getHours();
                let sapaan = "Selamat Malam";
                if (hours >= 5 && hours < 11) sapaan = "Selamat Pagi";
                else if (hours >= 11 && hours < 15) sapaan = "Selamat Siang";
                else if (hours >= 15 && hours < 18) sapaan = "Selamat Sore";
                document.getElementById('sapaan').innerText = sapaan;
                document.getElementById('jam-realtime').innerText = now.toLocaleTimeString('id-ID', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                }) + " WIB";
                document.getElementById('hari-ini').innerText = now.toLocaleDateString('id-ID', {
                    weekday: 'long'
                });
                document.getElementById('tanggal-ini').innerText = now.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </x-slot>

    <div class="w-full px-4 sm:px-6 lg:px-2 space-y-8 py-2">

        {{-- STATISTIK CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 font-poppins">

            {{-- Card Total Posts --}}
            <div
                class="relative overflow-hidden bg-white rounded-2xl border border-slate-200 p-6 transition-all duration-300 hover:border-red-300 hover:shadow-md group">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider mb-1">Total
                                Postingan</p>
                            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
                                {{ number_format($totalPosts) }}
                            </h2>
                        </div>
                        <div
                            class="bg-red-50 text-red-600 p-3 rounded-xl group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-file-signature text-xl"></i>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center text-[10px] font-medium text-slate-400 italic">
                        <span class="flex h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                        Terhubung ke Database
                    </div>
                </div>
            </div>

            {{-- Card Total Galeri --}}
            <div
                class="relative overflow-hidden bg-white rounded-2xl border border-slate-200 p-6 transition-all duration-300 hover:border-slate-400 hover:shadow-md group">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider mb-1">Total Galeri
                            </p>
                            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
                                {{ number_format($totalGalleries) }}
                            </h2>
                        </div>
                        <div
                            class="bg-slate-50 text-slate-600 p-3 rounded-xl group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-images text-xl"></i>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center text-[10px] font-medium text-slate-400 italic">
                        <i class="fa-solid fa-clock-rotate-left mr-1.5 text-[9px]"></i>
                        Data Terupdate
                    </div>
                </div>
            </div>

            {{-- Card Total Page --}}
            <div
                class="relative overflow-hidden bg-white rounded-2xl border border-slate-200 p-6 transition-all duration-300 hover:border-slate-400 hover:shadow-md group">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider mb-1">Total Halaman
                            </p>
                            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
                                {{ number_format($totalPages) }}
                            </h2>
                        </div>
                        <div
                            class="bg-slate-50 text-slate-600 p-3 rounded-xl group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-window-restore text-xl"></i>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center text-[10px] font-medium text-slate-400 italic">
                        <i class="fa-solid fa-circle-nodes mr-1.5 text-[9px]"></i>
                        Halaman Aktif
                    </div>
                </div>
            </div>

            {{-- Card Total Visitor --}}
            <div
                class="relative overflow-hidden bg-white rounded-2xl border border-slate-200 p-6 transition-all duration-300 hover:border-blue-300 hover:shadow-md group">
                <div class="flex flex-col h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider mb-1">Total
                                Pengunjung</p>
                            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
                                {{ number_format($totalVisitor) }}
                            </h2>
                        </div>
                        <div
                            class="bg-blue-50 text-blue-600 p-3 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <div class="bg-slate-50 p-2 rounded-lg border border-slate-100">
                            <p class="text-[9px] uppercase text-slate-400 font-bold leading-none mb-1">Hari Ini</p>
                            <p class="text-sm font-bold text-green-600">{{ $todayVisitor }}</p>
                        </div>
                        <div class="bg-slate-50 p-2 rounded-lg border border-slate-100">
                            <p class="text-[9px] uppercase text-slate-400 font-bold leading-none mb-1">Pengujung</p>
                            <p class="text-sm font-bold text-purple-600">{{ $uniqueVisitor }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- TABLE SECTION --}}
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
            <div
                class="p-8 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-white to-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-red-700 rounded-full"></div>
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Postingan Terbaru</h3>
                </div>
                <a href="{{ route('posts.index') }}"
                    class="text-sm font-bold text-red-700 hover:text-red-800 flex items-center gap-2 transition-colors group">
                    Lihat Semua <i
                        class="fa-solid fa-arrow-right-long group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 uppercase text-[11px] font-black tracking-[0.15em] bg-slate-50/30">
                            <th class="px-8 py-5">Judul Konten</th>
                            <th class="px-8 py-5">Kategori</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-right">Waktu Rilis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($latestPosts as $post)
                            <tr class="hover:bg-slate-50/80 transition-all duration-200 group">
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-slate-800 group-hover:text-red-700 transition-colors line-clamp-1">{{ $post->judul }}</span>
                                        <span
                                            class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">ID:
                                            #PSC-{{ $post->id }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span
                                        class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tight">
                                        {{ $post->kategori }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $post->status == 'publish' ? 'bg-green-400' : 'bg-yellow-400' }} opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-2 w-2 {{ $post->status == 'publish' ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                        </div>
                                        <span
                                            class="text-xs font-bold uppercase {{ $post->status == 'publish' ? 'text-green-700' : 'text-yellow-700' }}">
                                            {{ $post->status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <p class="text-sm font-bold text-slate-700">
                                        {{ $post->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] text-slate-400 font-medium italic">
                                        {{ $post->created_at->diffForHumans() }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-4">
                                        <div class="p-6 bg-slate-50 rounded-full">
                                            <i class="fa-solid fa-folder-open text-slate-200 text-6xl"></i>
                                        </div>
                                        <p class="text-slate-400 font-medium italic tracking-tight">Belum ada data
                                            terbaru yang tersedia dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-slate-50/50 text-center border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Dashboard Administrasi
                    Keamanan PSC 119</p>
            </div>
        </div>
    </div>
</x-app-layout>
