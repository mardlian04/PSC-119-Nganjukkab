<x-front-layout>
    <x-slot name="title">Beranda | PSC 119 Kab.Nganjuk</x-slot>

    {{-- BANNER SECTION --}}
    @if ($banner)
        <section class="relative">
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $banner->path_gambar) }}" class="w-full h-[350px] object-cover">
                <div class="absolute inset-0 bg-black/60"></div>
            </div>
            <div class="relative z-10 flex items-center justify-center h-[350px] text-center px-4">
                <div class="text-white max-w-2xl">
                    <h2 class="text-3xl md:text-4xl font-bold mb-3">{{ $banner->teks }}</h2>
                    <p class="text-red-100 text-lg">{{ $banner->sub_teks }}</p>
                </div>
            </div>
        </section>
    @else
        <section class="bg-red-700 text-white py-12 text-center">
            <h2 class="text-3xl font-bold mb-2">Layanan Darurat PSC 119</h2>
        </section>
    @endif

    {{-- BERITA SECTION --}}
    <div class="max-w-7xl mx-auto p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-8">Berita Terbaru</h3>

        {{-- 1. BERITA UTAMA (HEADLINE) --}}
        @if ($posts->count() > 0)
            @php $headline = $posts->first(); @endphp
            <div class="flex flex-col md:flex-row gap-8 mb-12 items-center">
                <div class="md:w-1/2">
                    @if ($headline->gambar_thumbnail)
                        <img src="{{ asset('storage/' . $headline->gambar_thumbnail) }}"
                            class="w-full h-[350px] object-cover rounded-sm shadow-sm">
                    @endif
                </div>
                <div class="md:w-1/2 space-y-4">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">
                        {{ $headline->judul }}
                    </h2>
                    <p class="text-gray-500 text-sm italic">{{ $headline->created_at->format('d F Y') }}</p>
                    <p class="text-gray-600 leading-relaxed">
                        {{ Str::limit(trim(strip_tags($headline->isi_konten)), 250) }}
                    </p>
                    <a href="{{ route('postingan.post.detail', $headline->slug) }}"
                        class="inline-block bg-[#800000] text-white px-8 py-2.5 rounded-full font-semibold hover:bg-red-900 transition shadow-md">
                        Selengkapnya
                    </a>
                </div>
            </div>
        @endif

        <hr class="mb-12 border-red-800 border-1">

        {{-- 2. GRID BERITA LAINNYA --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($posts->skip(1) as $post)
                <div class="flex flex-col group">
                    {{-- Image --}}
                    <div class="overflow-hidden mb-4">
                        @if ($post->gambar_thumbnail)
                            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                class="w-full h-56 object-cover shadow-sm group-hover:scale-105 transition duration-300">
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="space-y-2">
                        <a href="{{ route('postingan.post.detail', $post->slug) }}"
                            class="font-bold text-lg text-gray-800 line-clamp-2 min-h-[3.5rem] leading-snug">
                            {{ $post->judul }}
                        </a>
                        <p class="text-gray-400 text-xs italic">{{ $post->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ route('postingan.index') }}"
                class="inline-block bg-[#800000] text-white px-10 py-3 rounded-full font-bold hover:bg-red-900 transition shadow-lg text-sm uppercase tracking-wide">
                Berita Lainnya
            </a>
        </div>
    </div>
</x-front-layout>
