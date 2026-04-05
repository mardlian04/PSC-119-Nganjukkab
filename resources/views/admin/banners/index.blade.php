<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fa-solid fa-images text-red-700"></i>
                    </div>
                    Kelola Banner Halaman Depan
                </h2>
                <p class="text-sm text-slate-500 mt-1 ml-12">Kelola gambar promosi dan pesan utama pada halaman depan.
                </p>
            </div>

            <div>
                <a href="{{ route('banners.create') }}"
                    class="inline-flex items-center gap-2 bg-red-700 hover:bg-red-800 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                    <i class="fa-solid fa-plus text-sm"></i>
                    Tambah Banner Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Preview Gambar
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Konten Teks</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($banners as $banner)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="relative w-40 h-24 overflow-hidden rounded-lg border border-slate-200 shadow-sm group-hover:shadow-md transition-shadow">
                                    @if ($banner->path_gambar)
                                        <img src="{{ asset('storage/' . $banner->path_gambar) }}"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                            <i class="fa-solid fa-image text-slate-300 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-slate-800 font-bold text-base leading-tight">
                                        {{ $banner->teks }}
                                    </span>
                                    <span class="text-slate-500 text-sm italic max-w-md truncate">
                                        "{{ $banner->sub_teks }}"
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('banners.edit', $banner) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white rounded-lg transition-all shadow-sm"
                                        title="Edit Banner">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('banners.destroy', $banner) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-9 h-9 text-red-600 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-all shadow-sm"
                                            title="Hapus Banner">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-box-open text-slate-300 text-5xl mb-4"></i>
                                    <p class="text-slate-500 font-medium">Belum ada data banner tersedia.</p>
                                    <a href="{{ route('banners.create') }}"
                                        class="text-red-600 hover:underline text-sm mt-1">Buat sekarang</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
