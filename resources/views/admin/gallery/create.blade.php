<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('gallery.index') }}"
                class="group flex items-center justify-center w-10 h-10 rounded-xl bg-white shadow-sm border border-gray-100 text-gray-400 hover:text-[#B32121] hover:border-[#B32121] transition-all duration-300">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Upload Foto Galeri</h2>
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">Lengkapi informasi foto yang
                    akan diunggah</p>
            </div>
        </div>
    </x-slot>

    <div class="py-2 antialiased">
        <div class="w-full mx-auto">
            <div class="bg-white rounded-lg shadow-2xl shadow-gray-200/40 overflow-hidden border border-gray-50">

                <div class="bg-gradient-to-r from-[#B32121] to-[#8E1A1A] px-10 py-6 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center text-white">
                            <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                        </div>
                        <span class="text-white font-bold text-sm tracking-wide">Formulir Unggah Foto</span>
                    </div>
                </div>

                <div class="p-10 md:p-14">
                    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data"
                        class="space-y-10">
                        @csrf

                        <div class="relative group">
                            <label
                                class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-[#B32121] uppercase tracking-wider">Judul
                                Foto</label>
                            <input type="text" name="judul" required
                                class="w-full px-6 py-4 bg-white border-2 border-gray-100 focus:border-[#B32121] focus:ring-0 rounded-2xl transition-all duration-300 text-gray-800 font-semibold"
                                placeholder="Isi judul galeri...">
                        </div>

                        <div class="relative group">
                            <label
                                class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Deskripsi</label>
                            <input type="text" name="deskripsi"
                                class="w-full px-6 py-4 bg-gray-50 border-none focus:bg-white focus:ring-2 focus:ring-[#B32121]/10 rounded-2xl transition-all duration-300 text-gray-800"
                                placeholder="Opsional: Deskripsi singkat...">
                        </div>

                        <div class="relative group">
                            <label
                                class="absolute -top-3 left-4 bg-white px-2 text-xs font-bold text-gray-400 uppercase tracking-wider z-10">Pilih
                                Gambar</label>
                            <div class="relative flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-100 border-dashed rounded-[2rem] cursor-pointer bg-gray-50/50 hover:bg-red-50 hover:border-[#B32121]/30 transition-all duration-300 group/upload">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div
                                            class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#B32121] mb-3 group-hover/upload:scale-110 transition-transform duration-300">
                                            <i class="fa-solid fa-file-image text-xl"></i>
                                        </div>
                                        <p
                                            class="mb-1 text-sm text-gray-500 font-bold group-hover/upload:text-[#B32121]">
                                            Klik untuk unggah</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter">JPG, PNG (Max
                                            2MB)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="gambar" accept="image/*"
                                        class="hidden" onchange="updateFileName(this)" />
                                </label>
                            </div>

                            <p id="file-name-preview" class="mt-2 text-center text-xs font-bold text-[#B32121] hidden">
                                <i class="fa-solid fa-check-circle mr-1"></i> File terpilih: <span
                                    class="text-gray-600"></span>
                            </p>

                            <img id="image-preview" class="hidden mx-auto mt-4 rounded-xl max-h-40" />
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="button" onclick="history.back()"
                                class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest">
                                Batal
                            </button>

                            <button type="submit"
                                class="bg-[#B32121] hover:bg-[#8e1a1a] text-white px-12 py-4 rounded-2xl font-extrabold transition-all duration-300 shadow-xl shadow-red-900/20 hover:shadow-[#B32121]/40 transform hover:-translate-y-1 flex items-center gap-3">
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const preview = document.getElementById('file-name-preview');
            const span = preview.querySelector('span');
            const imagePreview = document.getElementById('image-preview');

            if (input.files && input.files.length > 0) {
                const file = input.files[0];
                span.innerText = file.name;
                preview.classList.remove('hidden');

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                imagePreview.classList.add('hidden');
            }
        }
    </script>

    <style>
        input:focus,
        select:focus,
        textarea:focus {
            outline: none !important;
        }
    </style>
</x-app-layout>
