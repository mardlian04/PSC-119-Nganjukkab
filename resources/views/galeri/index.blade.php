<x-front-layout>
    <x-slot name="title">Galeri | PSC 119 Kab. Nganjuk</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-20">
        <header class="mb-10 md:mb-16">
            <nav
                class="flex items-center gap-2 mb-4 text-[10px] md:text-xs font-bold uppercase tracking-widest text-slate-400">
                <a href="/" class="hover:text-red-600 transition-colors">Beranda</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-600">Galeri</span>
            </nav>

            <div class="relative inline-block">
                <h1 class="text-3xl md:text-3xl max-sm:text-xl font-black text-slate-900 tracking-tight">
                    Galeri <span class="text-red-600">Kegiatan</span>
                </h1>
                <div class="mt-4 w-16 h-1.5 bg-red-600 rounded-full"></div>
            </div>
        </header>

        @if ($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 md:gap-8 mb-16">
                @foreach ($galleries as $g)
                    <div class="group relative overflow-hidden rounded-xl bg-slate-100 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500"
                        onclick="openModal('{{ asset('storage/' . $g->gambar) }}', '{{ $g->judul }}')">

                        <img src="{{ asset('storage/' . $g->gambar) }}"
                            class="w-full h-[250px] md:h-[300px] object-cover transition-transform duration-700 group-hover:scale-110">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">
                            <h3
                                class="text-white text-lg md:text-xl font-bold translate-y-4 group-hover:translate-y-0 transition duration-500">
                                {{ $g->judul }}
                            </h3>

                            @if ($g->deskripsi)
                                <p
                                    class="text-white/80 text-sm mt-2 opacity-0 group-hover:opacity-100 transition duration-700 delay-100 line-clamp-2">
                                    {{ $g->deskripsi }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-24 px-6">
                <div class="mb-8 p-6 bg-slate-50 rounded-full border border-slate-100">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>

                <div class="max-w-md text-center">
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">
                        Galeri Belum Tersedia
                    </h3>
                    <p class="text-slate-500 text-sm md:text-base leading-relaxed">
                        Saat ini belum ada dokumentasi kegiatan yang diunggah. Silakan cek kembali beberapa saat lagi.
                    </p>
                </div>
            </div>
        @endif
    </div>

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
