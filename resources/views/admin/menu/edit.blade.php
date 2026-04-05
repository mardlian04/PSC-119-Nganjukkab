<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('menu.index') }}"
                class="group flex items-center justify-center w-10 h-10 rounded-xl bg-white shadow-sm border border-gray-100 text-gray-400 hover:text-[#B32121] hover:border-[#B32121] transition-all duration-300">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Edit Konfigurasi</h2>
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">Modifikasi Navigasi PSC 119</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 antialiased">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/40 overflow-hidden border border-gray-50">

                <div class="bg-gradient-to-r from-[#B32121] to-[#8E1A1A] px-10 py-6 flex justify-between items-center">
                    <span class="text-white/90 text-sm font-medium">ID Menu: <span
                            class="font-mono text-white">#{{ $menu->id }}</span></span>
                    <i class="fa-solid fa-pen-to-square text-white/30 text-xl"></i>
                </div>

                <div class="p-10 md:p-14">
                    <form method="POST" action="{{ route('menu.update', $menu) }}" class="space-y-10">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-8">
                            <div class="relative group">
                                <label
                                    class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-[#B32121] uppercase tracking-wider transition-all">Nama
                                    Menu</label>
                                <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required
                                    class="w-full px-6 py-4 bg-white border-2 border-gray-100 focus:border-[#B32121] focus:ring-0 rounded-2xl transition-all duration-300 text-gray-800 font-semibold"
                                    placeholder="Nama menu...">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative group">
                                <label
                                    class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Parent
                                    Menu</label>
                                <select name="parent_id"
                                    class="w-full px-6 py-4 bg-gray-50 border-none focus:bg-white focus:ring-2 focus:ring-[#B32121]/10 rounded-2xl transition-all duration-300 text-gray-700 appearance-none">
                                    <option value="">-- Menu Utama --</option>
                                    @foreach ($parents as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $menu->parent_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_menu }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-gray-300">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>

                            <div class="relative group">
                                <label
                                    class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Urutan</label>
                                <input type="number" name="urutan" value="{{ $menu->urutan }}"
                                    class="w-full px-6 py-4 bg-gray-50 border-none focus:bg-white focus:ring-2 focus:ring-[#B32121]/10 rounded-2xl transition-all duration-300 text-gray-800 font-mono">
                            </div>
                        </div>

                        <div class="relative group">
                            <label
                                class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Link
                                URL / Endpoint</label>
                            <div class="flex items-center">
                                <span
                                    class="absolute left-6 text-gray-300 group-focus-within:text-[#B32121] transition-colors">
                                    <i class="fa-solid fa-link text-xs"></i>
                                </span>
                                <input type="text" name="link_url" value="{{ $menu->link_url }}"
                                    class="w-full pl-14 pr-6 py-4 bg-gray-50 border-none focus:bg-white focus:ring-2 focus:ring-[#B32121]/10 rounded-2xl transition-all duration-300 text-gray-600 font-mono text-sm">
                            </div>
                        </div>

                        <div
                            class="bg-red-50/50 p-6 rounded-[2rem] border border-red-100/50 flex items-center justify-between group hover:bg-red-50 transition-colors duration-300">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#B32121]">
                                    <i class="fa-solid fa-toggle-on text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Status Aktif</p>
                                    <p class="text-xs text-gray-500">Tentukan apakah menu ini dapat diakses publik.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ $menu->is_active ? 'checked' : '' }}>
                                <div
                                    class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-[20px] after:w-[20px] after:transition-all peer-checked:bg-[#B32121]">
                                </div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="button" onclick="history.back()"
                                class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest">
                                Batal
                            </button>

                            <button type="submit"
                                class="bg-[#B32121] hover:bg-[#8e1a1a] text-white px-10 py-4 rounded-2xl font-extrabold transition-all duration-300 shadow-xl shadow-red-900/20 hover:shadow-[#B32121]/40 transform hover:-translate-y-1 flex items-center gap-3">
                                <i class="fa-solid fa-arrows-rotate text-sm"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-10 flex justify-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Server PSC 119
                        Online</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        input:focus,
        select:focus {
            outline: none !important;
        }
    </style>
</x-app-layout>
