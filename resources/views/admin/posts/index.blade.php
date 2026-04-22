<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">
                Kelola Postingan Berita & Informasi
            </h2>
            <a href="{{ route('posts.create') }}"
                class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all shadow-md shadow-red-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Post Baru
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="w-full px-2 sm:px-6 lg:px-2">
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold text-center">Preview</th>
                                <th class="px-6 py-4 font-semibold">Konten</th>
                                <th class="px-6 py-4 font-semibold">Info</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold">Insight</th>
                                <th class="px-6 py-4 font-semibold text-right">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($posts as $post)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center">
                                            @if ($post->gambar_thumbnail)
                                                <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}"
                                                    class="w-16 h-12 object-cover rounded-lg shadow-sm border border-slate-100">
                                            @else
                                                <div
                                                    class="w-16 h-12 bg-slate-100 rounded-lg flex items-center justify-center border border-dashed border-slate-300">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="max-w-xs md:max-w-md">
                                            <p
                                                class="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-red-700 transition-colors">
                                                {{ $post->judul }}
                                            </p>
                                            <p class="text-xs text-slate-400 mt-1">Dibuat:
                                                {{ $post->created_at->format('d M Y') }}</p>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200 uppercase">
                                            {{ $post->kategori }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($post->status == 'publish')
                                            <span class="inline-flex items-center text-xs font-medium text-green-600">
                                                <span
                                                    class="w-2 h-2 mr-2 rounded-full bg-green-500 animate-pulse"></span>
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center text-xs font-medium text-amber-500">
                                                <span class="w-2 h-2 mr-2 rounded-full bg-amber-400"></span>
                                                Drafting
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-slate-500">
                                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span
                                                class="text-sm font-semibold italic">{{ number_format($post->jumlah_view) }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('posts.edit', $post) }}"
                                                class="text-slate-400 hover:text-blue-600 transition-colors p-1"
                                                title="Edit Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-slate-400 hover:text-red-600 transition-colors p-1"
                                                    title="Hapus Data">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
