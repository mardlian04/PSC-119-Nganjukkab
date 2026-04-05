<x-front-layout>
    <x-slot name="title">Galeri | PSC 119 Kab. Nganjuk</x-slot>

    <section
        class="relative h-[40vh] md:h-[50vh] flex items-center justify-center text-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('bannerpsc.png') }}" class="w-full h-full object-cover opacity-40 scale-105"
                alt="Background PSC">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 to-slate-900"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl">
            <span
                class="inline-block px-4 py-1.5 mb-4 text-xs font-bold tracking-widest uppercase bg-red-600 text-white rounded-full">
                Media & Informasi
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight text-white">
                Galeri <span class="text-red-500">PSC 119</span>
            </h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base md:text-lg font-light leading-relaxed">
                Dokumentasi kegiatan dan media edukasi kesehatan untuk masyarakat Kabupaten Nganjuk.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-20">
        @if ($galleries->where('tipe_file', 'image')->count() > 0)
            <section class="mb-24">
                <div class="flex flex-col mb-10">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Galeri Foto</h2>
                    <div class="h-1 w-20 bg-red-600 mt-2"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">
                    @foreach ($galleries->where('tipe_file', 'image') as $g)
                        <div
                            class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100">
                            <div class="relative aspect-[4/3] overflow-hidden cursor-pointer"
                                onclick="openModal('{{ asset('storage/' . $g->path_file) }}', '{{ $g->judul_file }}')">
                                <img src="{{ asset('storage/' . $g->path_file) }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">

                                <div
                                    class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div
                                        class="p-4 bg-white/10 backdrop-blur-md rounded-full text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3
                                    class="font-bold text-slate-800 text-lg mb-2 line-clamp-1 group-hover:text-red-600 transition-colors">
                                    {{ $g->judul_file }}
                                </h3>
                                <p class="text-slate-500 text-sm line-clamp-2 font-light italic">
                                    {{ $g->keterangan }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($galleries->where('tipe_file', 'pdf')->count() > 0)
            <section>
                <div class="flex flex-col mb-10">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Dokumen Edukasi</h2>
                    <div class="h-1 w-20 bg-red-600 mt-2"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($galleries->where('tipe_file', 'pdf') as $g)
                        <div
                            class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-red-200 hover:shadow-xl hover:shadow-red-500/5 transition-all duration-300">
                            <div
                                class="w-14 h-14 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-file-pdf text-2xl"></i>
                            </div>

                            <h3 class="font-bold text-slate-800 text-sm mb-2 line-clamp-2 min-h-[40px]">
                                {{ $g->judul_file }}
                            </h3>
                            <p class="text-slate-400 text-xs mb-6 line-clamp-2">
                                {{ $g->keterangan }}
                            </p>

                            <a href="{{ asset('storage/' . $g->path_file) }}" target="_blank"
                                class="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all">
                                <span>Unduh PDF</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <div class="mt-20 flex justify-center">
            <div class="px-4 py-2 bg-white rounded-2xl shadow-sm border border-slate-100">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>

    <div id="imageModal"
        class="fixed inset-0 bg-slate-950/98 backdrop-blur-md hidden flex-col items-center justify-center z-[100] p-4 transition-all duration-500">
        <button onclick="closeModal()" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors">
            <i class="fa-solid fa-xmark text-3xl"></i>
        </button>

        <div class="max-w-5xl w-full">
            <img id="modalImage" class="max-h-[80vh] mx-auto rounded-lg shadow-2xl object-contain">
            <div class="mt-8 text-center">
                <h2 id="modalTitle" class="text-white text-2xl font-medium tracking-wide"></h2>
                <div class="h-0.5 w-12 bg-red-600 mx-auto mt-4"></div>
            </div>
        </div>
    </div>

    <script>
        function openModal(src, title) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            const titleElem = document.getElementById('modalTitle');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            img.src = src;
            titleElem.innerText = title;
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    </script>

    <style>
        .pagination {
            @apply flex gap-1;
        }

        .page-item .page-link {
            @apply px-4 py-2 rounded-lg border-none text-slate-500 font-medium hover:bg-slate-100 transition-colors;
        }

        .page-item.active .page-link {
            @apply bg-red-600 text-white hover:bg-red-700;
        }
    </style>
</x-front-layout>
