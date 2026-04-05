<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('posts.index') }}"
                class="group p-2 bg-white border border-slate-200 rounded-lg hover:bg-red-50 transition-colors shadow-sm">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-red-700" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800 leading-tight">Edit Post</h2>
                <p class="text-xs text-slate-500 mt-0.5">Memperbarui konten: <span
                        class="italic text-red-600">"{{ $post->judul }}"</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-10">
            <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data"
                class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf
                @method('PUT')

                {{-- KOLOM KIRI: KONTEN UTAMA --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Post</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $post->judul) }}"
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Slug (URL)</label>
                            <input type="text" name="slug" id="slug" value="{{ $post->slug }}" readonly
                                class="w-full bg-slate-50 border-slate-200 text-slate-500 rounded-xl cursor-not-allowed italic text-sm">
                        </div>

                        <div class="w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Konten</label>

                            <div class="w-full">
                                <textarea name="isi_konten" id="editor" class="w-full">
            {{ old('isi_konten', $post->isi_konten) }}
        </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Thumbnail</label>
                            <div
                                class="relative group border-2 border-dashed border-slate-300 rounded-2xl p-4 hover:border-red-400 transition-colors text-center bg-slate-50/50">
                                <input type="file" name="gambar_thumbnail" id="imageInput"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                {{-- Preview Area --}}
                                <div id="previewContainer"
                                    class="{{ $post->gambar_thumbnail ? '' : 'hidden' }} mb-2 relative">
                                    <img id="imagePreview"
                                        src="{{ $post->gambar_thumbnail ? asset('storage/' . $post->gambar_thumbnail) : '#' }}"
                                        class="w-full h-44 object-cover rounded-xl shadow-md border border-white">
                                    <div
                                        class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span
                                            class="text-white text-xs font-medium bg-black/50 px-3 py-1 rounded-full">Ganti
                                            Gambar</span>
                                    </div>
                                </div>

                                {{-- Placeholder jika kosong --}}
                                <div id="uploadPlaceholder" class="{{ $post->gambar_thumbnail ? 'hidden' : '' }}">
                                    <svg class="w-10 h-10 mx-auto text-slate-400 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xs text-slate-500 font-medium">Klik untuk upload thumbnail</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
                            <select name="kategori"
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl text-sm font-medium text-slate-600">
                                <option value="berita" {{ $post->kategori == 'berita' ? 'selected' : '' }}>Berita
                                </option>
                                <option value="pengumuman" {{ $post->kategori == 'pengumuman' ? 'selected' : '' }}>
                                    Pengumuman</option>
                                <option value="artikel" {{ $post->kategori == 'artikel' ? 'selected' : '' }}>Artikel
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
                            <select name="status"
                                class="w-full border-slate-200 focus:border-red-500 focus:ring-red-500 rounded-xl text-sm font-medium">
                                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Terbitkan
                                </option>
                            </select>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-200 transition-all active:scale-[0.98]">
                                Simpan Perubahan
                            </button>
                            <p class="text-[10px] text-center text-slate-400 mt-4 uppercase tracking-tighter">Terakhir
                                diupdate: {{ $post->updated_at->diffForHumans() }}</p>
                        </div>
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
