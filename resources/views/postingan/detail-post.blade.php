<x-front-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                    <span
                        class="inline-flex items-center gap-1.5 text-xs bg-red-50 text-red-700 px-4 py-1.5 rounded-full font-bold uppercase tracking-wider">
                        <i class="fa-solid fa-tag"></i>
                        {{ $post->kategori }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-4 mb-4 leading-tight">
                        {{ $post->judul }}
                    </h1>
                    <div
                        class="flex flex-wrap items-center gap-6 text-sm text-gray-500 mb-8 pb-6 border-b border-gray-100">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day text-red-600"></i>
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-eye text-red-600"></i>
                            {{ number_format($post->jumlah_view) }} Tayangan
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-user text-red-600"></i>
                            Admin PSC
                        </span>
                    </div>
                    @if ($post->gambar_thumbnail)
                        <div class="relative group overflow-hidden rounded-2xl mb-8">
                            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                class="w-full h-auto max-h-[500px] object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                    @endif
                    <div class="prose prose-red max-w-none text-gray-700 text-justify leading-relaxed text-lg">
                        {!! $post->isi_konten !!}
                    </div>
                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <a href="{{ route('welcome') }}"
                            class="inline-flex items-center gap-2 text-red-700 font-bold hover:text-red-900 transition-colors">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <div class="sticky top-24">
                    <h3
                        class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2 border-l-4 border-red-700 pl-3">
                        Berita Lainnya
                    </h3>

                    <div class="space-y-8">
                        @foreach ($beritaLainnya as $item)
                            <a href="{{ route('postingan.post.detail', $item->slug) }}"
                                class="group block border-b border-gray-100 pb-6 last:border-0">
                                <p class="text-xs text-gray-400 font-medium mb-1 italic">
                                    {{ $item->created_at->format('d F Y') }}
                                </p>
                                <h4
                                    class="text-gray-800 font-bold leading-snug text-justify group-hover:text-red-700 transition-colors line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2 text-justify leading-relaxed">
                                    {{ Str::limit(strip_tags($item->isi_konten), 300) }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('postingan.index') }}"
                        class="mt-8 w-full block text-center bg-gray-100 text-gray-700 py-3 rounded-xl font-bold hover:bg-red-700 hover:text-white transition-all">
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
