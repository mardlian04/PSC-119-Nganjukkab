<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="bg-red-50 p-2 rounded-lg">
                <i class="fa-solid fa-pen-to-square text-red-700"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">Edit Galeri
            </h2>
        </div>
    </x-slot>

    <div class="w-full mx-auto py-2 px-4 sm:px-6 lg:px-8 font-poppins">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">

            <div class="p-8 md:p-12">
                <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">File
                                    Saat Ini</label>
                                <div
                                    class="relative group rounded-3xl overflow-hidden border-2 border-dashed border-slate-200 bg-slate-50 p-4 flex items-center justify-center min-h-[250px]">
                                    @if ($gallery->tipe_file == 'image')
                                        <img src="{{ asset('storage/' . $gallery->path_file) }}"
                                            class="max-w-full max-h-[200px] rounded-xl shadow-md object-contain transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="text-center">
                                            <i class="fa-solid fa-file-pdf text-5xl text-red-500 mb-2"></i>
                                            <p class="text-xs font-semibold text-slate-500 italic">Dokumen PDF Terlampir
                                            </p>
                                        </div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span
                                            class="text-white text-xs font-bold px-4 py-2 bg-black/20 backdrop-blur-md rounded-full border border-white/30">
                                            Preview File
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Ganti
                                    File (Opsional)</label>
                                <div class="relative">
                                    <input type="file" name="path_file"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-900 file:text-white hover:file:bg-red-700 file:transition-all cursor-pointer">
                                </div>
                                <p class="mt-2 text-[10px] text-slate-400 italic font-medium">*Biarkan kosong jika tidak
                                    ingin mengubah file</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Judul
                                    File</label>
                                <input type="text" name="judul_file" value="{{ $gallery->judul_file }}"
                                    placeholder="Masukkan nama galeri..."
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-slate-700 font-semibold focus:ring-2 focus:ring-red-600/20 transition-all placeholder:text-slate-300">
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Kategori
                                    File</label>
                                <div class="relative">
                                    <select name="tipe_file"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-slate-700 font-semibold focus:ring-2 focus:ring-red-600/20 appearance-none transition-all">
                                        <option value="image" {{ $gallery->tipe_file == 'image' ? 'selected' : '' }}>📸
                                            Gambar / Foto</option>
                                        <option value="pdf" {{ $gallery->tipe_file == 'pdf' ? 'selected' : '' }}>📄
                                            Dokumen PDF</option>
                                    </select>
                                    <div
                                        class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Keterangan
                                    / Deskripsi</label>
                                <textarea name="keterangan" rows="4" placeholder="Berikan deskripsi singkat..."
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-red-600/20 transition-all placeholder:text-slate-300 resize-none">{{ $gallery->keterangan }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div
                        class="pt-8 mt-8 border-t border-slate-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('galleries.index') }}"
                            class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> Batal & Kembali
                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto bg-red-700 hover:bg-red-800 text-white px-10 py-4 rounded-2xl font-black tracking-tighter text-sm flex items-center justify-center gap-3 shadow-lg shadow-red-200 transition-all active:scale-95">
                            <i class="fa-solid fa-cloud-arrow-up"></i> SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
