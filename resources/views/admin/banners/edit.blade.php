<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">
                Edit <span class="text-red-700">Banner</span>
            </h2>
            <a href="{{ route('banners.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-2 bg-gray-50 min-h-screen">
        <div class="w-full mx-auto">

            @if ($errors->any())
                <div
                    class="mb-6 flex p-4 text-sm text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-lg shadow-sm">
                    <svg class="flex-shrink-0 inline w-5 h-5 me-3" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ml-3">
                        <span class="font-bold">Gagal memperbarui:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('banners.update', $banner) }}" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Utama</label>
                        <input type="text" name="welcome_title"
                            value="{{ old('welcome_title', $banner->welcome_title) }}"
                            placeholder="Masukkan judul banner..."
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Teks Utama</label>
                            <input type="text" name="teks" value="{{ old('teks', $banner->teks) }}"
                                placeholder="Teks banner..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sub Teks</label>
                            <input type="text" name="sub_teks" value="{{ old('sub_teks', $banner->sub_teks) }}"
                                placeholder="Sub teks..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Gambar Saat Ini</label>
                            <div
                                class="relative group aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-200 shadow-inner">
                                @if ($banner->path_gambar)
                                    <img src="{{ asset('storage/' . $banner->path_gambar) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                        <span>Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Ganti Gambar Baru</label>
                            <div class="relative w-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-red-50 hover:border-red-400 transition-all group">
                                    <div class="flex flex-col items-center justify-center py-4" id="placeholder">
                                        <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-red-500 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-xs text-gray-500">Klik untuk upload</p>
                                    </div>
                                    <input type="file" name="path_gambar" id="imageInput" accept="image/*"
                                        class="hidden">

                                    <div id="previewContainer" class="hidden absolute inset-0 p-1 bg-white rounded-xl">
                                        <img id="preview" class="w-full h-full object-cover rounded-lg">
                                        <button type="button" id="resetBtn"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white p-1 rounded-full hover:bg-red-700 shadow-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6 flex items-center justify-end border-t border-gray-100">
                    <button type="submit"
                        class="w-full md:w-auto bg-red-700 hover:bg-red-800 text-white font-bold py-3 px-12 rounded-xl shadow-lg hover:shadow-red-200 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Update Banner
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const input = document.getElementById('imageInput');
        const container = document.getElementById('previewContainer');
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');
        const resetBtn = document.getElementById('resetBtn');

        input.onchange = e => {
            const [file] = input.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
                container.classList.remove('hidden');
                placeholder.classList.add('opacity-0');
            }
        };

        resetBtn.onclick = (e) => {
            e.preventDefault();
            input.value = "";
            container.classList.add('hidden');
            placeholder.classList.remove('opacity-0');
        };
    </script>
</x-app-layout>
