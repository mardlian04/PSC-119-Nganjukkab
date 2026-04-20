<x-front-layout>
    <div class="max-w-7xl mx-auto p-4 md:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <div class="lg:col-span-2">
                <article
                    class="bg-white rounded-2xl shadow-sm p-4 sm:p-6 md:p-10 lg:p-12 border border-gray-100 mx-auto max-w-5xl">
                    <h1
                        class="text-xl sm:text-lg text-justify md:text-xl lg:text-2xl xl:text-3xl font-extrabold text-gray-900 mt-2 mb-6 leading-[1.2] tracking-tight">
                        {{ $post->judul }}
                    </h1>

                    <div
                        class="flex sm:items-center gap-3 md:gap-6 text-[11px] sm:text-xs md:text-sm text-gray-500 mb-8 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-red-600"></i>
                            {{ $post->created_at->translatedFormat('d M Y') }}
                        </div>
                        <span class="hidden sm:inline text-gray-300">|</span>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-eye text-red-600"></i>
                            {{ number_format($post->jumlah_view) }} <span class="hidden xs:inline">Tayangan</span>
                        </div>
                        <span class="hidden sm:inline text-gray-300">|</span>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-bullhorn text-red-600"></i>
                            <span
                                class="bg-red-50 text-red-700 px-2 py-0.5 uppercase rounded-md font-medium">{{ $post->kategori }}</span>
                        </div>
                    </div>

                    @if ($post->gambar_thumbnail)
                        <div class="relative group overflow-hidden rounded-xl md:rounded-2xl mb-8 md:mb-10 shadow-md">
                            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                class="w-full h-auto max-h-[300px] md:max-h-[500px] object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $post->judul }}">
                        </div>
                    @endif

                    <div class="prose-custom text-gray-700 text-justify leading-relaxed sm:leading-loose">
                        <div class="ql-container ql-snow" style="border: none;">
                            <div class="ql-editor">
                                {!! $post->isi_konten !!}
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 md:mt-8 pt-5 border-t border-gray-100">
                        <a href="{{ route('welcome') }}"
                            class="group inline-flex items-center gap-2 text-red-700 text-sm md:text-base font-bold hover:text-red-900 transition-all">
                            <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </article>
            </div>

            <aside class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100 sticky top-2">
                    <h3
                        class="text-lg md:text-xl font-bold text-gray-800 mb-6 flex items-center gap-2 border-l-4 border-red-700 pl-3">
                        Berita Lainnya
                    </h3>

                    <div class="space-y-6 md:space-y-8">
                        @foreach ($beritaLainnya as $item)
                            <a href="{{ route('postingan.post.detail', $item->slug) }}"
                                class="group block border-b border-gray-100 pb-5 last:border-0 last:pb-0">
                                <p class="text-[10px] md:text-xs text-gray-400 font-medium mb-1 italic">
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </p>
                                <h4
                                    class="text-sm md:text-base text-gray-800 font-bold leading-snug group-hover:text-red-700 transition-colors line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                                <p
                                    class="text-xs md:text-sm text-gray-500 mt-2 line-clamp-2 text-justify leading-relaxed">
                                    {{ Str::limit(strip_tags($item->isi_konten), 150) }}
                                </p>
                            </a>
                        @endforeach
                    </div>

                    <a href="{{ route('postingan.index') }}"
                        class="mt-6 md:mt-8 w-full block text-center bg-gray-100 text-gray-700 py-3 rounded-xl text-sm md:text-base font-bold hover:bg-red-700 hover:text-white transition-all">
                        Lihat Semua Berita
                    </a>
                </div>
            </aside>

        </div>
    </div>
</x-front-layout>
