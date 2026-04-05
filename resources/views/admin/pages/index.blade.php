<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Kelola Data Halaman</h2>
                <p class="text-xs text-gray-500 uppercase tracking-[0.2em] font-semibold mt-1">Klik Tambah Halaman Baru
                    Untuk Menambahkan Halaman Baru</p>
            </div>
            <a href="{{ route('pages.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-[#B32121] hover:bg-[#8E1A1A] text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transform hover:-translate-y-1">
                <i class="fa-solid fa-plus-circle text-lg"></i>
                <span>Tambah Halaman Baru</span>
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
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Detail
                                    Halaman</th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">Status
                                    URL</th>
                                <th
                                    class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">
                                    Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($pages as $page)
                                <tr class="group hover:bg-red-50/30 transition-colors duration-200">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-[#B32121] group-hover:bg-[#B32121] group-hover:text-white transition-all duration-300">
                                                <i class="fa-solid fa-file-lines text-lg"></i>
                                            </div>
                                            <div>
                                                <span
                                                    class="block text-sm font-bold text-gray-800">{{ $page->judul_halaman }}</span>
                                                <span class="text-[11px] text-gray-400 font-medium italic">Terakhir
                                                    diperbarui: {{ $page->updated_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-[11px] font-mono font-bold tracking-tight">
                                            /{{ $page->slug }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('pages.edit', $page) }}"
                                                class="flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-200"
                                                title="Edit Halaman">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>

                                            <form method="POST" action="{{ route('pages.destroy', $page) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman ini?')"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 text-[#B32121] hover:bg-[#B32121] hover:text-white transition-all duration-200"
                                                    title="Hapus Halaman">
                                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                                                <i class="fa-solid fa-folder-open text-2xl"></i>
                                            </div>
                                            <p class="text-gray-500 font-medium">Belum ada data halaman.</p>
                                            <a href="{{ route('pages.create') }}"
                                                class="text-[#B32121] text-xs font-bold uppercase mt-2 hover:underline">Buat
                                                Halaman Pertama</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="mt-8 flex flex-col md:flex-row items-center justify-between text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em]">
                <p>Menampilkan {{ $pages->count() }} Total Halaman Terdaftar</p>
                <div class="flex gap-4">
                    <span class="text-[#B32121]">PSC 119 Kab. Nganjuk</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
