<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 font-poppins">
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-3">
                    <div
                        class="flex items-center bg-white/80 backdrop-blur-md px-1 py-1 pr-4 rounded-full border border-slate-200 shadow-sm transition-all hover:shadow-md">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-tr from-red-600 to-red-400 text-white shadow-sm ring-2 ring-red-50">
                            <i class="fa-solid fa-user-shield text-[10px]"></i>
                        </div>
                        <div class="ml-3 flex flex-col">
                            <span id="sapaan"
                                class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.15em] leading-none mb-1">Memuat...</span>
                            <span class="text-sm font-extrabold text-slate-800 tracking-tight leading-none uppercase">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div
                    class="hidden sm:flex items-center bg-white/60 backdrop-blur-sm border border-slate-200/60 px-4 py-2 rounded-2xl shadow-sm group hover:bg-white transition-all duration-500">
                    <div
                        class="mr-3 w-10 h-10 flex items-center justify-center bg-slate-50 rounded-xl group-hover:rotate-12 transition-transform">
                        <i class="fa-regular fa-clock text-red-600"></i>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="text-[9px] uppercase font-black text-slate-400 tracking-widest leading-none mb-1 text-right">Waktu
                            (WIB)</span>
                        <span id="jam-realtime"
                            class="text-base font-bold text-slate-900 font-mono tracking-tighter text-right">00:00:00</span>
                    </div>
                </div>

                <div
                    class="flex items-center bg-white border border-slate-200 px-5 py-2 rounded-2xl shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] transition-all hover:-translate-y-1">
                    <div class="mr-4 text-slate-800">
                        <div class="flex flex-col items-center leading-none">
                            <span id="hari-ini"
                                class="text-[10px] uppercase font-black tracking-tighter text-red-600">HARI</span>
                            <span id="tanggal-hari" class="text-xl font-black italic">00</span>
                        </div>
                    </div>
                    <div class="w-[1px] h-8 bg-slate-200 mr-4"></div>
                    <div class="flex flex-col">
                        <span id="bulan-ini" class="text-xs font-bold text-slate-800 leading-none">BULAN</span>
                        <span id="tahun-ini" class="text-[10px] font-medium text-slate-400 tracking-widest">202X</span>
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
                });
                document.getElementById('hari-ini').innerText = now.toLocaleDateString('id-ID', {
                    weekday: 'short'
                });
                document.getElementById('tanggal-hari').innerText = now.toLocaleDateString('id-ID', {
                    day: '2-digit'
                });
                document.getElementById('bulan-ini').innerText = now.toLocaleDateString('id-ID', {
                    month: 'long'
                });
                document.getElementById('tahun-ini').innerText = now.getFullYear();
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </x-slot>

    <div class="w-full px-2 lg:px-2 space-y-10 py-2 font-poppins">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $stats = [
                    [
                        'label' => 'Total Postingan',
                        'val' => $totalPosts,
                        'icon' => 'fa-file-signature',
                        'bg' => 'bg-red-50',
                        'text' => 'text-red-600',
                        'hover' => 'group-hover:bg-red-600',
                    ],
                    [
                        'label' => 'Total Media',
                        'val' => $totalMedia,
                        'icon' => 'fa-images',
                        'bg' => 'bg-slate-100',
                        'text' => 'text-slate-600',
                        'hover' => 'group-hover:bg-slate-600',
                    ],
                    [
                        'label' => 'Total Halaman',
                        'val' => $totalPages,
                        'icon' => 'fa-window-restore',
                        'bg' => 'bg-indigo-50',
                        'text' => 'text-indigo-600',
                        'hover' => 'group-hover:bg-indigo-600',
                    ],
                    [
                        'label' => 'Total Pengunjung',
                        'val' => $totalVisitor,
                        'icon' => 'fa-chart-line',
                        'bg' => 'bg-blue-50',
                        'text' => 'text-blue-600',
                        'hover' => 'group-hover:bg-blue-600',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="group relative bg-white rounded-[2rem] border border-slate-100 p-7 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 {{ $stat['bg'] }} rounded-full opacity-50 scale-0 group-hover:scale-150 transition-transform duration-700">
                    </div>

                    <div class="relative flex flex-col h-full justify-between z-10">
                        <div class="flex items-center justify-between mb-8">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-2xl {{ $stat['bg'] }} {{ $stat['text'] }} {{ $stat['hover'] }} group-hover:text-white transition-all duration-500 shadow-sm">
                                <i class="fa-solid {{ $stat['icon'] }} text-lg"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">
                                    {{ $stat['label'] }}</p>
                                <h2 class="text-3xl font-black text-slate-900 mt-1 tracking-tight">
                                    {{ number_format($stat['val']) }}</h2>
                            </div>
                        </div>

                        @if ($stat['label'] == 'Total Pengunjung')
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div
                                    class="px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                                    <span
                                        class="text-[9px] font-black text-slate-400 block uppercase tracking-tighter italic mb-1">Hari
                                        Ini</span>
                                    <div class="flex items-center gap-1.5">
                                        <span
                                            class="text-base font-black text-green-600 tracking-tight">+{{ number_format($todayVisitor) }}</span>
                                    </div>
                                </div>
                                <div
                                    class="px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                                    <span
                                        class="text-[9px] font-black text-slate-400 block uppercase tracking-tighter italic mb-1">Minggu
                                        Ini</span>
                                    <span
                                        class="text-base font-black text-blue-600 tracking-tight">{{ number_format($weekVisitor ?? 0) }}</span>
                                </div>
                            </div>
                        @else
                            <div
                                class="flex items-center gap-3 px-5 py-3 bg-slate-50 rounded-2xl border border-slate-100 w-fit group-hover:bg-white transition-all duration-300 shadow-sm">
                                <div class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </div>
                                <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Data
                                    Terupdate</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div
            class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
            <div
                class="p-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6 bg-gradient-to-br from-white to-slate-50/30">
                <div class="flex items-center gap-5">
                    <div class="relative">
                        <div class="w-12 h-12 bg-red-700 rounded-2xl rotate-12 absolute opacity-10"></div>
                        <div
                            class="w-12 h-12 bg-red-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-200">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight">Postingan Terbaru</h3>
                        <p class="text-xs font-medium text-slate-400 mt-0.5 italic">Menampilkan 5 aktivitas konten
                            terakhir</p>
                    </div>
                </div>
                <a href="{{ route('posts.index') }}"
                    class="group px-6 py-3 bg-slate-900 text-white rounded-2xl text-xs font-bold hover:bg-red-700 transition-all duration-300 shadow-lg shadow-slate-200 flex items-center gap-3">
                    Lihat Semua
                    <i class="fa-solid fa-arrow-right-long group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>

            <div class="overflow-x-auto px-4 pb-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                            <th class="px-8 py-6">Informasi Konten</th>
                            <th class="px-8 py-6">Kategori</th>
                            <th class="px-8 py-6 text-center">Status Publikasi</th>
                            <th class="px-8 py-6 text-right">Tanggal Rilis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($latestPosts as $post)
                            <tr class="hover:bg-slate-50/50 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-red-50 group-hover:text-red-600 transition-all font-black text-xs">
                                            {{ substr($post->judul, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-800 group-hover:text-red-700 transition-colors line-clamp-1 tracking-tight">{{ $post->judul }}</span>
                                            <span
                                                class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Ref:
                                                #PSC-{{ $post->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="bg-white border border-slate-200 text-slate-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-sm">
                                        {{ $post->kategori }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div
                                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $post->status == 'publish' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-orange-50 text-orange-700 border border-orange-100' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $post->status == 'publish' ? 'bg-green-400' : 'bg-orange-400' }} opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-2 w-2 {{ $post->status == 'publish' ? 'bg-green-500' : 'bg-orange-500' }}"></span>
                                        </span>
                                        <span
                                            class="text-[10px] font-black uppercase italic">{{ $post->status }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black text-slate-700 tracking-tighter">{{ $post->created_at->format('d M, Y') }}</span>
                                        <span
                                            class="text-[10px] text-slate-400 font-medium italic">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-32">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div
                                            class="w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center mb-6">
                                            <i class="fa-solid fa-inbox text-slate-200 text-4xl"></i>
                                        </div>
                                        <h4 class="text-slate-800 font-black text-lg">Belum Ada Konten</h4>
                                        <p class="text-slate-400 text-sm max-w-xs mt-2 font-medium">Sistem belum
                                            mendeteksi adanya postingan terbaru saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
