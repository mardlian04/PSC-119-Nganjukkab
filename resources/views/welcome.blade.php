<x-front-layout>
    <x-slot name="title">Selamat Datang Di Website Public Safety Center (PSC 119) Kabupaten Nganjuk</x-slot>

    @if ($banner)
        <section class="relative overflow-hidden" aria-labelledby="banner-heading">
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $banner->path_gambar) }}" class="w-full h-full object-cover object-center"
                    alt="Banner Utama PSC 119 Nganjuk" fetchpriority="high" loading="eager">
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/50 to-transparent"
                    aria-hidden="true">
                </div>
            </div>

            <div
                class="max-w-7xl mx-auto relative z-10 flex items-center justify-start min-h-[350px] md:min-h-[450px] lg:min-h-[550px] text-left px-8 py-10">
                <div class="text-white max-w-3xl">

                    @if ($banner->welcome_title)
                        <span
                            class="block text-3xl max-sm:text-xl max-md:text-xl font-bold mb-2 tracking-tight drop-shadow-lg text-white">
                            {{ $banner->welcome_title }}
                        </span>
                    @endif

                    @if ($banner->teks)
                        <h1 id="banner-heading"
                            class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg">
                            {{ $banner->teks }}
                        </h1>
                    @endif

                    @if ($banner->sub_teks)
                        <div class="max-w-2xl">
                            <p
                                class="text-sm sm:text-base md:text-lg text-gray-200 font-medium leading-relaxed drop-shadow-md border-l-4 border-red-600 pl-4">
                                {{ $banner->sub_teks }}
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    @else
        <section class="bg-[#861413] text-white py-16 md:py-24 px-8 md:px-16 text-left">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Public Safety Center (PSC) 119 Kabupaten Nganjuk</h1>
                <p class="text-red-100 text-lg">Banner Belum Diunggah</p>
            </div>
        </section>
    @endif

    <main class="max-w-7xl mx-auto p-4">
        <section aria-labelledby="news-heading" class="py-12 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="relative mb-10">
                <h2 id="news-heading"
                    class="text-4xl max-sm:text-2xl max-md:text-2xl font-extrabold text-gray-900 tracking-tight">
                    Berita <span class="text-red-600">Terbaru</span>
                </h2>
                <div class="mt-2 h-1.5 w-20 bg-red-600 rounded-full"></div>
            </div>

            @if ($posts->count() > 0)
                @php $headline = $posts->first(); @endphp
                <article class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 mb-20 items-center group">
                    <div class="lg:col-span-7">
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            @if ($headline->gambar_thumbnail)
                                <a href="{{ route('postingan.post.detail', $headline->slug) }}" class="block">
                                    <img src="{{ asset('storage/' . $headline->gambar_thumbnail) }}"
                                        class="w-full h-[250px] sm:h-[400px] lg:h-[500px] object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                                        alt="{{ $headline->judul }}">
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="lg:col-span-5 space-y-6">
                        <div class="inline-flex items-center space-x-3">
                            <time datetime="{{ $headline->created_at->format('Y-m-d') }}"
                                class="text-red-700 text-xs sm:text-sm font-bold uppercase tracking-widest">
                                {{ $headline->created_at->translatedFormat('d F Y') }}
                            </time>
                        </div>

                        <h3
                            class="text-2xl max-sm:text-xl lg:text-3xl font-extrabold text-gray-900 text-justify leading-tight tracking-tight group-hover:text-red-700 transition-colors">
                            <a href="{{ route('postingan.post.detail', $headline->slug) }}">
                                {{ $headline->judul }}
                            </a>
                        </h3>

                        <p class="text-gray-600 text-base sm:text-lg leading-relaxed line-clamp-3">
                            {{ Str::limit(trim(strip_tags($headline->isi_konten)), 200) }}
                        </p>

                        <div class="pt-4">
                            <a href="{{ route('postingan.post.detail', $headline->slug) }}"
                                class="inline-flex items-center px-6 py-3 bg-[#800000] text-white font-bold rounded-lg shadow-lg hover:bg-black transition-all duration-300 transform hover:-translate-y-1">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </article>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12 lg:gap-y-16">
                    @foreach ($posts->skip(1) as $post)
                        <article class="flex flex-col group">
                            <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-6 shadow-md">
                                @if ($post->gambar_thumbnail)
                                    <a href="{{ route('postingan.post.detail', $post->slug) }}">
                                        <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                            alt="{{ $post->judul }}" loading="lazy">
                                    </a>
                                @endif
                            </div>

                            <div class="flex flex-col flex-grow">
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}"
                                    class="text-red-700 text-[11px] font-black uppercase tracking-[0.2em] mb-3 block">
                                    {{ $post->created_at->translatedFormat('d F Y') }}
                                </time>

                                <h3
                                    class="font-bold text-xl sm:text-lg lg:text-xl text-gray-800 leading-snug group-hover:text-red-700 transition-colors mb-3">
                                    <a href="{{ route('postingan.post.detail', $post->slug) }}" class="line-clamp-2">
                                        {{ $post->judul }}
                                    </a>
                                </h3>

                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                                    {{ Str::limit(trim(strip_tags($post->isi_konten)), 100) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <nav class="mt-12 text-center" aria-label="Lihat lebih banyak berita">
                    <a href="{{ route('postingan.index') }}"
                        class="inline-block bg-[#800000] text-white px-10 py-3 rounded-full font-bold hover:bg-red-900 transition shadow-lg text-sm uppercase tracking-wide">
                        Lihat Berita Lainnya
                    </a>
                </nav>
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Belum Ada Berita</h3>
                    <p class="text-gray-500 mt-2 max-w-xs">Saat ini belum ada informasi atau berita yang dipublikasikan.
                    </p>
                </div>
            @endif
        </section>

        <section class="py-12 px-4 sm:px-6 max-w-7xl mx-auto" aria-labelledby="galeri-heading">
            <div class="relative mb-10">
                <h2 id="galeri-heading"
                    class="text-4xl max-sm:text-2xl max-md:text-2xl font-extrabold text-gray-900 tracking-tight">
                    Galeri <span class="text-red-600">Kegiatan</span>
                </h2>
                <div class="mt-2 h-1.5 w-20 bg-red-600 rounded-full"></div>
            </div>

            @if ($galeri->count() > 0)
                <div x-data="{
                    scrollEl: null,
                    interval: null,
                    getScrollStep() {
                        return this.scrollEl.clientWidth / (window.innerWidth < 640 ? 1 : 3);
                    },
                    start() {
                        this.interval = setInterval(() => {
                            if (this.scrollEl.scrollLeft + this.scrollEl.clientWidth >= this.scrollEl.scrollWidth) {
                                this.scrollEl.scrollLeft = 0;
                            } else {
                                this.next();
                            }
                        }, 4000);
                    },
                    stop() { clearInterval(this.interval); },
                    next() { this.scrollEl.scrollBy({ left: this.getScrollStep(), behavior: 'smooth' }); },
                    prev() { this.scrollEl.scrollBy({ left: -this.getScrollStep(), behavior: 'smooth' }); }
                }" x-init="scrollEl = $refs.slider;
                start()" @mouseenter="stop()" @mouseleave="start()"
                    class="relative group">

                    <div x-ref="slider"
                        class="flex overflow-x-auto gap-6 scroll-smooth pb-6 no-scrollbar snap-x snap-mandatory">

                        @foreach ($galeri as $item)
                            <div
                                class="min-w-[85%] sm:min-w-[calc(50%-12px)] lg:min-w-[calc(33.333%-16px)] snap-start group/card">

                                <div class="relative overflow-hidden rounded-2xl shadow-lg bg-gray-100 aspect-[4/3] cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $item->gambar) }}', '{{ $item->judul }}')">

                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover/card:scale-110"
                                        alt="{{ $item->judul }}">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover/card:opacity-100 transition duration-500 flex flex-col justify-end p-6">

                                        <h3
                                            class="text-white text-base md:text-lg font-bold translate-y-4 group-hover/card:translate-y-0 transition duration-500">
                                            {{ $item->judul }}
                                        </h3>

                                        @if ($item->deskripsi)
                                            <p
                                                class="text-white/80 text-sm mt-2 opacity-0 group-hover/card:opacity-100 transition duration-700 delay-100">
                                                {{ $item->deskripsi }}
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <button @click="prev"
                        class="absolute left-[-20px] top-1/2 -translate-y-1/2 bg-white text-gray-800 shadow-xl p-4 rounded-full opacity-0 group-hover:opacity-100 hover:bg-red-600 hover:text-white transition z-10">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button @click="next"
                        class="absolute right-[-20px] top-1/2 -translate-y-1/2 bg-white text-gray-800 shadow-xl p-4 rounded-full opacity-0 group-hover:opacity-100 hover:bg-red-600 hover:text-white transition z-10">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <nav class="mt-6 text-center">
                    <a href="{{ route('galeri.index') }}"
                        class="inline-flex items-center gap-2 bg-[#800000] text-white px-8 py-3 rounded-full font-bold hover:bg-red-900 transition-all shadow-md hover:shadow-xl text-sm uppercase tracking-wider">
                        <span>Lihat Galeri Lainnya</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </nav>
            @else
                <div
                    class="flex flex-col items-center justify-center py-20 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50/50">
                    <div class="w-16 h-16 bg-white shadow-sm rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700">Belum Ada Foto Kegiatan</h3>
                    <p class="text-sm text-center text-gray-400 mt-1">Kami akan segera memperbarui dokumentasi kegiatan
                        terbaru.
                    </p>
                </div>
            @endif
        </section>
    </main>
</x-front-layout>
