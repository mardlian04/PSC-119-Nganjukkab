<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-red-700"></i>
                Kelola Menu Navigasi
            </h2>
            <a href="{{ route('menu.create') }}"
                class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all shadow-md shadow-red-200">
                Tambah Menu Navigasi
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="w-full mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Struktur
                                    Menu</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">URL /
                                    Link</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Urutan
                                </th>
                                <th
                                    class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500 text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($menus as $menu)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-700">
                                                <i class="fa-solid fa-folder"></i>
                                            </div>
                                            <span class="font-bold text-gray-800">{{ $menu->nama_menu }}</span>
                                        </div>
                                    </td>
                                    {{-- PERBAIKAN DISINI: link_url --}}
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $menu->link_url ?? '#' }}
                                    </td>
                                    {{-- PERBAIKAN DISINI: urutan --}}
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $menu->urutan ?? '0' }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('menu.edit', $menu->id) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            {{-- Form Delete ... --}}
                                        </div>
                                    </td>
                                </tr>

                                @if ($menu->children->count() > 0)
                                    @foreach ($menu->children as $child)
                                        <tr class="bg-gray-50/30 hover:bg-gray-100/50 transition-colors">
                                            <td class="px-6 py-3 pl-16">
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <i class="fa-solid fa-turn-up rotate-90 text-gray-300"></i>
                                                    <span class="text-sm font-medium">{{ $child->nama_menu }}</span>
                                                </div>
                                            </td>
                                            {{-- PERBAIKAN DISINI: link_url --}}
                                            <td class="px-6 py-3 text-xs text-gray-500 font-mono">
                                                {{ $child->link_url ?? '#' }}</td>
                                            {{-- PERBAIKAN DISINI: urutan --}}
                                            <td class="px-6 py-3 text-xs text-gray-400">{{ $child->urutan ?? '0' }}</td>
                                            <td class="px-6 py-3 text-right">
                                                <a href="{{ route('menu.edit', $child->id) }}"
                                                    class="p-1 text-blue-400 hover:text-blue-600">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($menus->isEmpty())
                    <div class="p-12 text-center text-gray-400">
                        <i class="fa-solid fa-layer-group text-4xl mb-3 block opacity-20"></i>
                        Belum ada menu yang dibuat.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
