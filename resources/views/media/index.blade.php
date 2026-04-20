<x-front-layout>
    <x-slot name="title">Media Promosi Kesehatan | PSC 119 Kab. Nganjuk</x-slot>

    <main class="bg-slate-50/50 min-h-screen py-10 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <header class="mb-10 md:mb-16">
                <nav
                    class="flex items-center gap-2 mb-4 text-[10px] md:text-xs font-bold uppercase tracking-widest text-slate-400">
                    <a href="/" class="hover:text-red-600 transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-slate-600">Media</span>
                </nav>

                <h1 class="text-3xl md:text-4xl font-black text-slate-900">
                    Media <span class="text-red-600">Promosi Kesehatan</span>
                </h1>
                <div class="mt-4 w-16 h-1.5 bg-red-600 rounded-full"></div>
            </header>

            @php
                $kategoriList = [
                    'media_cetak' => 'Media Cetak',
                    'media_publikasi' => 'Media Publikasi',
                    'infografis' => 'Infografis',
                ];
                $hasContent = false;
            @endphp

            @foreach ($kategoriList as $key => $label)
                @php
                    $items = $media->where('kategori', $key);
                @endphp

                @if ($items->count() > 0)
                    @php $hasContent = true; @endphp
                    <section class="mb-16">
                        <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 bg-red-600 rounded-full"></span>
                            {{ $label }}
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach ($items as $m)
                                <div
                                    class="group bg-white rounded-2xl border border-slate-200 p-3 hover:shadow-xl transition-all flex flex-col">
                                    <div class="relative aspect-[4/3] rounded-xl overflow-hidden mb-4 cursor-zoom-in"
                                        onclick="openModal('{{ asset('storage/' . ($m->tipe_file == 'image' ? $m->path_file : $m->sampul_gambar)) }}','{{ $m->judul_file }}')">

                                        @if ($m->tipe_file == 'image')
                                            <img src="{{ asset('storage/' . $m->path_file) }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                        @else
                                            @if ($m->sampul_gambar)
                                                <img src="{{ asset('storage/' . $m->sampul_gambar) }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-slate-100">
                                                    <svg class="w-12 h-12 text-red-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        @endif

                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center pointer-events-none">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>

                                    <h3 class="text-sm font-bold text-slate-800 mb-2 line-clamp-2">
                                        {{ $m->judul_file }}
                                    </h3>

                                    <p class="text-xs text-slate-500 mb-4 line-clamp-2">
                                        {{ $m->keterangan ?? '-' }}
                                    </p>

                                    <div class="mt-auto space-y-2">
                                        @if ($m->tipe_file == 'pdf')
                                            <a href="{{ asset('storage/' . $m->path_file) }}" target="_blank"
                                                class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-red-600 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Dokumen
                                            </a>

                                            <a href="{{ asset('storage/' . $m->path_file) }}" download
                                                class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach

            @if (!$hasContent)
                <div class="flex items-center justify-center py-20 px-4">
                    <div class="relative max-w-lg w-full">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-red-50 to-slate-50 transform skew-y-2 rounded-3xl -z-10 opacity-50">
                        </div>

                        <div
                            class="bg-white/80 backdrop-blur-sm border border-white rounded-3xl shadow-xl p-10 flex flex-col items-center text-center">
                            <div class="relative mb-8">
                                <div class="absolute inset-0 bg-red-100 rounded-full blur-2xl opacity-40 animate-pulse">
                                </div>
                                <div
                                    class="relative bg-gradient-to-br from-white to-slate-50 p-6 rounded-2xl shadow-sm border border-slate-100">
                                    <svg class="w-16 h-16 text-red-700/80" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-3">
                                Media <span class="text-red-700">Belum Tersedia</span>
                            </h3>

                            <p class="text-slate-500 leading-relaxed max-w-xs mx-auto mb-8 text-sm md:text-base">
                                Kami sedang menyiapkan konten promosi kesehatan terbaik untuk Anda. Silakan periksa
                                kembali beberapa saat lagi.
                            </p>

                            <div class="flex gap-3">
                                <div class="h-1.5 w-8 rounded-full bg-red-600/20"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-red-600/20"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-red-600/20"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <div id="imageModal"
        class="fixed inset-0 bg-black/95 backdrop-blur-md hidden flex-col items-center justify-center z-[9999] p-4 transition-all duration-300"
        onclick="closeModalOutside(event)">

        <button onclick="closeModal()"
            class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-[10000]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="relative max-w-5xl w-full flex flex-col items-center justify-center"
            onclick="event.stopPropagation()">
            <img id="modalImage" class="max-h-[80vh] max-w-full object-contain rounded-lg shadow-2xl">
            <div class="mt-6 px-4 text-center">
                <h2 id="modalTitle" class="text-white text-xl md:text-2xl font-bold tracking-wide"></h2>
            </div>
        </div>
    </div>

    <script>
        function openModal(src, title) {
            if (!src) return;
            const modal = document.getElementById('imageModal');
            document.getElementById('modalImage').src = src;
            document.getElementById('modalTitle').innerText = title;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function closeModalOutside(event) {
            if (event.target.id === 'imageModal') {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeModal();
            }
        });
    </script>
</x-front-layout>
