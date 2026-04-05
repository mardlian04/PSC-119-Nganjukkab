<x-front-layout>
    <x-slot name="title">Postingan | PSC 119 Kab.Nganjuk</x-slot>

    <div class="max-w-7xl mx-auto p-6 lg:py-12">

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <h2 class="text-4xl font-bold text-gray-800 self-start md:self-auto">Berita</h2>

            <form action="{{ route('postingan.index') }}" method="GET" class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full py-2.5 pl-10 pr-3 bg-slate-200 text-red-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400 border-red-700"
                    placeholder="Temukan berita">
            </form>
        </div>

        <div class="space-y-12">
            @foreach ($posts as $post)
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="w-full md:w-[400px] flex-shrink-0">
                        @if ($post->gambar_thumbnail)
                            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                class="w-full h-64 md:h-56 object-cover rounded-lg shadow-sm" alt="{{ $post->judul }}">
                        @else
                            <div class="w-full h-56 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fa-regular fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 space-y-3">
                        <h3
                            class="font-bold text-xl md:text-2xl text-gray-800 leading-snug hover:text-red-800 transition-colors">
                            <a href="{{ route('postingan.post.detail', $post->slug) }}">
                                {{ $post->judul }}
                            </a>
                        </h3>

                        <p class="text-sm font-medium text-gray-500">
                            {{ $post->created_at->translatedFormat('d F Y') }}
                        </p>

                        <p class="text-gray-600 leading-relaxed text-sm md:text-base italic">
                            {{ Str::limit(strip_tags($post->isi_konten), 220) }}
                        </p>

                        <div class="pt-2">
                            <a href="{{ route('postingan.post.detail', $post->slug) }}"
                                class="inline-block px-8 py-2 bg-[#800000] text-white font-semibold rounded-full hover:bg-red-900 transition shadow-md text-sm">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-16 border-t pt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-front-layout>
