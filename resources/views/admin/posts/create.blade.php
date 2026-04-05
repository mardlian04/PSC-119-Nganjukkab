<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('posts.index') }}" class="text-slate-400 hover:text-red-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-xl font-bold text-slate-800">Tambah Post Baru</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-10">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf

                {{-- KOLOM KIRI: INPUT UTAMA --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Post</label>
                            <input type="text" name="judul" id="judul" placeholder="Masukkan judul berita..."
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Slug (URL)</label>
                            <input type="text" name="slug" id="slug" placeholder="judul-post-otomatis"
                                readonly
                                class="w-full bg-slate-50 border-slate-200 text-slate-500 rounded-xl cursor-not-allowed">
                        </div>

                        <div class="w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Isi Konten
                            </label>

                            <textarea name="isi_konten" id="editor" class="w-full">
        {{ old('isi_konten', $post->isi_konten ?? '') }}
    </textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Thumbnail</label>
                            <div
                                class="relative group border-2 border-dashed border-slate-300 rounded-2xl p-4 hover:border-red-400 transition-colors text-center">
                                <input type="file" name="gambar_thumbnail" id="imageInput"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div id="previewContainer" class="hidden mb-2">
                                    <img id="imagePreview" src="#"
                                        class="w-full h-40 object-cover rounded-xl shadow-sm">
                                </div>
                                <div id="uploadPlaceholder">
                                    <svg class="w-10 h-10 mx-auto text-slate-400 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xs text-slate-500">Klik atau seret gambar ke sini</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
                            <select name="kategori"
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl uppercase text-xs font-bold tracking-wider text-slate-600">
                                <option value="berita">Berita</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="artikel">Artikel</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Status Publikasi</label>
                            <select name="status"
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl">
                                <option value="draft">Simpan sebagai Draft</option>
                                <option value="publish">Terbitkan Sekarang</option>
                            </select>
                        </div>

                        <hr class="border-slate-100">

                        <button type="submit"
                            class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-red-200 transition-all transform active:scale-95">
                            Simpan Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Kustomisasi CSS untuk CKEditor --}}
    <style>
        /* Membuat CKEditor Terlihat Lebih Luas dan Panjang */
        .ck-editor__editable_inline {
            min-height: 400px !important;
            /* Tinggi minimal area ketik */
            padding: 0 2rem !important;
            /* Memberikan ruang samping agar tidak mepet */
        }

        /* Memperhalus tampilan border CKEditor agar menyatu dengan Tailwind */
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
            /* Warna merah fokus */
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
