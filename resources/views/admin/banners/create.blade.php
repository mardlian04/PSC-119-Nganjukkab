<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">
                Tambah <span class="text-red-700">Banner</span>
            </h2>
            <a href="{{ route('banners.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-2 bg-gray-50 min-h-screen font-sans">
        <div class="w-full mx-auto">

            @if ($errors->any())
                <div
                    class="mb-6 flex p-4 text-sm text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-lg shadow-sm">
                    <svg class="flex-shrink-0 inline w-5 h-5 me-3" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div>
                        <span class="font-bold">Perhatian:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                @csrf

                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Utama</label>
                        <input type="text" name="welcome_title" value="{{ old('welcome_title') }}"
                            placeholder="Masukkan judul banner..."
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Teks Deskripsi</label>
                            <input type="text" name="teks" value="{{ old('teks') }}" placeholder="Teks utama..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sub Teks</label>
                            <input type="text" name="sub_teks" value="{{ old('sub_teks') }}"
                                placeholder="Teks tambahan..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Banner</label>
                        <div class="relative flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-red-50 hover:border-red-400 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="placeholder">
                                    <svg class="w-12 h-12 mb-3 text-gray-400 group-hover:text-red-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-bold">Klik untuk pilih
                                            gambar</span></p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG atau WEBP (Max. 2MB)</p>
                                </div>
                                <input type="file" name="path_gambar" id="imageInput" accept="image/*"
                                    class="hidden">

                                <div id="previewContainer" class="hidden absolute inset-0 p-2 bg-white rounded-xl">
                                    <img id="preview" class="w-full h-full object-cover rounded-lg shadow-inner">
                                    <button type="button" id="resetBtn"
                                        class="absolute top-4 right-4 bg-red-600 text-white p-2 rounded-full hover:bg-red-700 shadow-xl transform active:scale-90 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6 flex items-center justify-end border-t border-gray-100 space-x-4">
                    <button type="reset"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-800 transition">Reset</button>
                    <button type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white font-bold py-3 px-10 rounded-xl shadow-lg hover:shadow-red-200 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Simpan Data
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
