<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('pages.index') }}" class="text-gray-400 hover:text-red-700 transition">
                <i class="fa-solid fa-circle-arrow-left text-2xl"></i>
            </a>
            <h2 class="text-xl font-bold text-gray-800">Buat Halaman Baru</h2>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">

                <div class="p-8">
                    <form method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <div>
                            <label for="judul_halaman"
                                class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                Judul Halaman
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-heading"></i>
                                </div>
                                <input type="text" name="judul_halaman" id="judul_halaman" required
                                    class="w-full pl-11 border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition py-3 text-lg font-medium"
                                    placeholder="Masukkan judul halaman.....">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                Konten Halaman
                            </label>
                            <div class="prose max-w-none ck-editor-container">
                                <textarea name="isi_konten" id="editor"></textarea>
                            </div>
                            <p class="mt-2 text-xs text-gray-400 italic font-medium">
                                <i class="fa-solid fa-circle-info mr-1"></i> Gunakan editor di atas untuk menyusun
                                konten yang informatif.
                            </p>
                        </div>

                        <div
                            class="bg-gray-50 p-6 rounded-2xl border-2 border-dashed border-gray-200 hover:border-red-300 transition-colors group">
                            <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">
                                Gambar Fitur / Header
                            </label>
                            <div class="flex items-center gap-6">
                                <div
                                    class="w-16 h-16 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 group-hover:text-red-500 transition-colors">
                                    <i class="fa-solid fa-image text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="gambar_fitur"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition cursor-pointer">
                                    <p class="mt-2 text-xs text-gray-400">Rekomendasi ukuran: 1200 x 600 pixel (Maks.
                                        2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('pages.index') }}"
                                class="text-sm font-bold text-gray-500 hover:text-gray-700 transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-red-700 hover:bg-red-800 text-white px-12 py-3.5 rounded-xl font-bold transition shadow-lg shadow-red-200 flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                Publikasikan Halaman
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ck-editor__editable_inline {
            min-height: 400px !important;
            padding: 0 2rem !important;
        }

        .ck-editor {
            border-radius: 0.75rem !important;
            overflow: hidden;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .ck.ck-toolbar {
            background-color: #f9fafb !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            padding: 0.5rem !important;
        }

        .ck.ck-content.ck-focused {
            border: none !important;
            box-shadow: inset 0 0 0 2px rgba(185, 28, 28, 0.1) !important;
        }
    </style>

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
