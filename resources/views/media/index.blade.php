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
                $kategoriGroups = [
                    'media_cetak' => ['label' => 'Media Cetak', 'data' => $media_cetak, 'pageName' => 'cetak'],
                    'media_publikasi' => [
                        'label' => 'Media Publikasi',
                        'data' => $media_publikasi,
                        'pageName' => 'publikasi',
                    ],
                    'infografis' => ['label' => 'Infografis', 'data' => $infografis, 'pageName' => 'infografis'],
                ];
                $hasContent = false;
            @endphp

            @foreach ($kategoriGroups as $key => $group)
                @php $items = $group['data']; @endphp

                @if ($items->count() > 0)
                    @php $hasContent = true; @endphp
                    <section class="mb-20">
                        <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 bg-red-600 rounded-full"></span>
                            {{ $group['label'] }}
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
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

                                    <h3 class="text-sm font-bold text-slate-800 mb-2 line-clamp-2">{{ $m->judul_file }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mb-4 line-clamp-2">{{ $m->keterangan ?? '-' }}</p>

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

                        <div class="mt-8">
                            {{ $items->appends(request()->except($group['pageName']))->links() }}
                        </div>
                    </section>
                @endif
            @endforeach

            @if (!$hasContent)
                <div
                    class="flex flex-col items-center justify-center py-20 px-6 border-2 border-dashed border-slate-100 rounded-3xl">
                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-red-600/70" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>

                    <div class="text-center max-w-sm">
                        <h3 class="text-xl font-bold text-slate-800 mb-2">
                            Media Belum Tersedia
                        </h3>
                        <p class="text-slate-500 text-sm md:text-base leading-relaxed">
                            Kami sedang menyiapkan konten promosi kesehatan terbaik untuk Anda.
                        </p>
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
            if (event.target.id === 'imageModal') closeModal();
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeModal();
        });
    </script>
</x-front-layout>
