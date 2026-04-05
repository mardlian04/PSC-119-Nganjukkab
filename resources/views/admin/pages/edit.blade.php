<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pages.index') }}" class="text-gray-400 hover:text-red-700 transition-colors">
                <i class="fa-solid fa-arrow-left-long text-xl"></i>
            </a>
            <h2 class="text-xl font-bold text-gray-800">Edit Konten Halaman</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form method="POST" action="{{ route('pages.update', $page) }}" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                Halaman</label>
                            <input type="text" name="judul_halaman" value="{{ $page->judul_halaman }}"
                                class="w-full border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all py-3 px-4 text-lg font-medium"
                                placeholder="Masukkan judul...">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Isi
                                Konten</label>
                            <div class="prose max-w-none">
                                <textarea name="isi_konten" id="editor">{{ $page->isi_konten }}</textarea>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Gambar
                                    Saat Ini</label>
                                @if ($page->gambar_fitur)
                                    <div
                                        class="relative group w-48 shadow-md rounded-xl overflow-hidden border-4 border-white">
                                        <img src="{{ asset('storage/' . $page->gambar_fitur) }}"
                                            class="w-full h-32 object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="text-white text-[10px] font-bold uppercase">Gambar Aktif</span>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="w-48 h-32 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border-2 border-dashed border-gray-200">
                                        <i class="fa-solid fa-image-slash text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Ganti
                                    Gambar (Opsional)</label>
                                <input type="file" name="gambar_fitur"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all cursor-pointer">
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                            <a href="{{ route('pages.index') }}"
                                class="text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</a>
                            <button type="submit"
                                class="bg-red-700 hover:bg-red-800 text-white px-10 py-3 rounded-xl font-bold transition shadow-lg shadow-red-200 flex items-center gap-2">
                                <i class="fa-solid fa-arrows-rotate"></i>
                                Perbarui Halaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Minimalist CKEditor Customization --}}
    <style>
        .ck-editor__editable_inline {
            min-height: 350px !important;
            padding: 0 1.5rem !important;
        }

        .ck.ck-editor {
            border-radius: 0.75rem !important;
            overflow: hidden;
            border: 1px solid #e5e7eb !important;
        }

        .ck.ck-toolbar {
            background-color: #fafafa !important;
            border: none !important;
            border-bottom: 1px solid #f3f4f6 !important;
        }

        .ck.ck-content.ck-focused {
            border: none !important;
            box-shadow: none !important;
        }
    </style>

    {{-- SCRIPT TETAP --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
            })
            .catch(error => {
                console.error(error);
            });

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new UploadAdapter(loader);
            };
        }

        class UploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {

                    let formData = new FormData();
                    formData.append('upload', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch("{{ route('ckeditor.upload') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            resolve({
                                default: result.url
                            });
                        })
                        .catch(error => {
                            reject(error);
                        });

                }));
            }

            abort() {}
        }
    </script>
</x-app-layout>
