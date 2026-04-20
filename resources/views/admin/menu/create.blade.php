<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('menu.index') }}"
                    class="group flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-sm border border-gray-100 text-gray-400 hover:text-[#B32121] hover:border-[#B32121] transition-all duration-300">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Tambah Menu</h2>
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Manajemen Navigasi PSC 119
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 antialiased">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-50">

                <div class="h-2 w-full bg-[#B32121]"></div>

                <div class="p-8 md:p-12">
                    <form method="POST" action="{{ route('menu.store') }}" class="space-y-8">
                        @csrf

                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="flex items-center justify-center w-6 h-6 rounded-full bg-red-50 text-[#B32121] text-[10px] font-bold">01</span>
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Informasi Menu</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="nama_menu" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Nama
                                        Label Menu</label>
                                    <input type="text" name="nama_menu" id="nama_menu" required
                                        class="w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:border-[#B32121] focus:ring-4 focus:ring-red-100 rounded-2xl transition-all duration-300 text-gray-800 placeholder-gray-400"
                                        placeholder="Isi Judul Menu Navigasi">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="parent_id"
                                        class="block text-sm font-bold text-gray-700 mb-2 ml-1">Kategori Induk</label>
                                    <div class="relative">
                                        <select name="parent_id" id="parent_id"
                                            class="appearance-none w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:border-[#B32121] focus:ring-4 focus:ring-red-100 rounded-2xl transition-all duration-300 text-gray-700">
                                            <option value="">-- Menu Utama (Induk) --</option>
                                            @foreach ($parents as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_menu }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                            <i class="fa-solid fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="urutan" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Urutan
                                        Prioritas</label>
                                    <input type="number" name="urutan" id="urutan"
                                        class="w-full px-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:border-[#B32121] focus:ring-4 focus:ring-red-100 rounded-2xl transition-all duration-300 text-gray-800"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6 pt-6">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="flex items-center justify-center w-6 h-6 rounded-full bg-red-50 text-[#B32121] text-[10px] font-bold">02</span>
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Konfigurasi Tujuan
                                </h3>
                            </div>

                            <div>
                                <label for="link_url" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Alamat URL
                                    / Slug</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#B32121] transition-colors">
                                        <i class="fa-solid fa-link text-sm"></i>
                                    </div>
                                    <input type="text" name="link_url" id="link_url"
                                        class="w-full pl-12 pr-5 py-4 bg-gray-50 border-transparent focus:bg-white focus:border-[#B32121] focus:ring-4 focus:ring-red-100 rounded-2xl transition-all duration-300 text-gray-600 font-mono text-sm"
                                        placeholder="halaman/tentang-kami">
                                </div>
                            </div>

                            <div
                                class="bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200 flex items-center justify-between">
                                <div>
                                    <span class="block text-sm font-bold text-gray-800">Status Visibilitas</span>
                                    <span class="text-xs text-gray-500">Aktifkan untuk memunculkan menu di website
                                        utama.</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                    <div
                                        class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-[20px] after:w-[20px] after:transition-all peer-checked:bg-[#B32121]">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-6 pt-10">
                            <a href="{{ route('menu.index') }}"
                                class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                                Batalkan Pengaturan
                            </a>
                            <button type="submit"
                                class="bg-[#B32121] hover:bg-[#8e1a1a] text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-xl shadow-red-900/20 hover:shadow-red-900/40 transform hover:-translate-y-1 flex items-center gap-3">
                                <i class="fa-solid fa-check-double text-sm"></i>
                                Simpan Konfigurasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .focus\:ring-red-100:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgba(179, 33, 33, 0.1);
        }
    </style>
</x-app-layout>
