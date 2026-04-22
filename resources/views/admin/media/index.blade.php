<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Kelola Postingan Media</h2>
                <p class="text-xs text-gray-500 uppercase tracking-[0.2em] font-semibold mt-1">Dokumentasi Media & Arsip
                    PSC 119</p>
            </div>

            <a href="{{ route('media.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-[#B32121] hover:bg-[#8E1A1A] text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transform hover:-translate-y-1">
                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                <span>Upload Media Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-2 antialiased">
        <div class="w-full mx-auto sm:px-6 lg:px-2">

            <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Preview
                                </th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Preview
                                    Sampul</th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Informasi File</th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori
                                </th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Tipe
                                </th>
                                <th
                                    class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">
                                    Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($media as $m)
                                <tr class="group hover:bg-red-50/30 transition-colors duration-200">
                                    <td class="px-8 py-5">
                                        <div
                                            class="w-20 h-14 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 flex items-center justify-center shadow-sm">
                                            @if ($m->tipe_file == 'image')
                                                <img src="{{ asset('storage/' . $m->path_file) }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="flex flex-col items-center justify-center text-[#B32121]">
                                                    <i class="fa-solid fa-file-pdf text-xl"></i>
                                                    <span class="text-[8px] font-bold mt-0.5">PDF</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-8 py-5">
                                        @if ($m->sampul_gambar)
                                            <div
                                                class="w-20 h-14 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 flex items-center justify-center shadow-sm">
                                                <img src="{{ asset('storage/' . $m->sampul_gambar) }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            </div>
                                        @else
                                            <div
                                                class="w-20 h-14 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 flex items-center justify-center shadow-sm">
                                                <i class="fa-solid fa-image text-gray-300 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-8 py-5">
                                        <div class="max-w-xs md:max-w-md">
                                            <span
                                                class="block text-sm font-bold text-gray-800 truncate">{{ $m->judul_file }}</span>
                                            <span
                                                class="block text-[11px] text-gray-400 mt-0.5 truncate">{{ $m->keterangan ?? 'Tidak ada deskripsi.' }}</span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5">
                                        @php
                                            $badge = match ($m->kategori) {
                                                'media_cetak' => 'bg-blue-50 text-blue-600',
                                                'media_publikasi' => 'bg-purple-50 text-purple-600',
                                                'infografis' => 'bg-pink-50 text-pink-600',
                                                default => 'bg-gray-50 text-gray-500',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $badge }}">
                                            {{ $m->kategori_label }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-5">
                                        @if ($m->tipe_file == 'image')
                                            <span
                                                class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-wider">
                                                Image
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-wider">
                                                Document
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('media.edit', $m) }}"
                                                class="flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-200">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>

                                            <form method="POST" action="{{ route('media.destroy', $m) }}"
                                                onsubmit="return confirm('Hapus file ini permanen?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 text-[#B32121] hover:bg-[#B32121] hover:text-white transition-all duration-200">
                                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                                                <i class="fa-solid fa-images text-2xl"></i>
                                            </div>
                                            <p class="text-gray-500 font-medium">Belum ada koleksi media.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between px-4">
                <div class="flex gap-2">
                    {{ $media->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
