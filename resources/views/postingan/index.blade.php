<x-front-layout>
    <x-slot name="title">Berita & Postingan | PSC 119 Kab. Nganjuk</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-16">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 md:mb-12 gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight">Berita</h2>
                <div class="h-1.5 w-12 bg-red-700 rounded-full"></div>
            </div>

            <form action="{{ route('postingan.index') }}" method="GET" class="relative w-full sm:w-72 md:w-96 group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i
                        class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-red-700 transition-colors"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full py-3 pl-10 pr-4 bg-white border border-gray-200 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all shadow-sm placeholder-gray-400"
                    placeholder="Cari berita terkini...">
            </form>
        </div>

        <div class="space-y-10 md:space-y-16">
            @forelse ($posts as $post)
                <article class="flex flex-col lg:flex-row gap-6 md:gap-10 items-start group">

                    <div class="w-full lg:w-[420px] shrink-0 overflow-hidden rounded-2xl shadow-md lg:shadow-lg">
                        @if ($post->gambar_thumbnail)
                            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                class="w-full h-56 sm:h-72 md:h-80 lg:h-64 object-cover transform group-hover:scale-105 transition duration-500"
                                alt="{{ $post->judul }}">
                        @else
                            <div
                                class="w-full h-56 sm:h-72 md:h-80 lg:h-64 bg-slate-100 flex flex-col items-center justify-center gap-3">
                                <i class="fa-regular fa-image text-slate-300 text-5xl"></i>
                                <span class="text-xs text-slate-400 font-medium">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 flex flex-col h-full py-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span
                                class="px-3 py-1 bg-red-50 text-red-700 text-[10px] md:text-xs font-bold uppercase tracking-wider rounded-md">Berita</span>
                            <span class="text-xs md:text-sm font-medium text-gray-400">
                                <i class="fa-regular fa-calendar-alt mr-1"></i>
                                {{ $post->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <h3
                            class="font-extrabold text-xl sm:text-lg md:text-xl lg:text-2xl text-gray-900 leading-tight mb-4 group-hover:text-red-800 transition-colors">
                            <a href="{{ route('postingan.post.detail', $post->slug) }}">
                                {{ $post->judul }}
                            </a>
                        </h3>

                        <p
                            class="text-gray-600 leading-relaxed text-sm md:text-base mb-6 line-clamp-3 md:line-clamp-4 lg:line-clamp-3">
                            {{ Str::limit(strip_tags($post->isi_konten), 200) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('postingan.post.detail', $post->slug) }}"
                                class="inline-flex items-center gap-2 text-sm md:text-base font-bold text-red-800 hover:text-red-950 group/btn transition-all">
                                Baca Selengkapnya
                                <i
                                    class="fa-solid fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="py-20 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4">
                        <i class="fa-solid fa-newspaper text-slate-300 text-3xl"></i>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada berita yang dapat ditampilkan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 md:mt-24 pt-8 border-t border-slate-100">
            {{ $posts->links() }}
        </div>
    </div>

    <style>
        h2,
        h3 {
            letter-spacing: -0.02em;
        }

        article {
            transition: transform 0.3s ease;
        }

        p {
            max-width: 75ch;
        }
    </style>
</x-front-layout>
