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

    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

    <div class="py-2">
        <div class="w-full sm:px-6">
            <form id="postForm" method="POST" action="{{ route('posts.update', $post) }}"
                enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf
                @method('PUT')

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
                            <div class="prose max-w-none">
                                <div id="editor-wrapper">
                                    <div id="editor">{!! old('isi_konten', $post->isi_konten) !!}</div>
                                </div>
                                <input type="hidden" name="isi_konten" id="isi_konten">
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

    <style>
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #e2e8f0;
            background-color: #f9fafb;
            padding: 0.75rem;
        }

        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #e2e8f0;
            background-color: white;
            min-height: 400px;
        }

        .ql-container.ql-snow:focus-within {
            border-color: #b91c1c;
            box-shadow: 0 0 0 1px rgba(185, 28, 28, 0.1);
        }

        .ql-editor {
            min-height: 400px;
            padding: 1.5rem;
        }

        .ql-snow .ql-picker.ql-size {
            width: 100px;
        }

        .ql-snow .ql-picker.ql-size .ql-picker-label::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item::before {
            content: 'Normal';
        }

        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=small]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=small]::before {
            content: 'Kecil';
        }

        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=large]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=large]::before {
            content: 'Besar';
        }

        .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=huge]::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=huge]::before {
            content: 'Sangat Besar';
        }

        .ql-video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin: 1rem 0;
            border-radius: 0.5rem;
        }

        .ql-video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const BlockEmbed = Quill.import("blots/block/embed");
            class ResponsiveVideo extends BlockEmbed {
                static create(value) {
                    let node = super.create(value);
                    let iframe = document.createElement("iframe");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allowfullscreen", true);
                    iframe.setAttribute("src", value);
                    iframe.setAttribute("style", "width: 100%; min-height: 400px; border:0;");
                    node.appendChild(iframe);
                    return node;
                }
                static value(node) {
                    return node.querySelector("iframe").getAttribute("src");
                }
            }
            ResponsiveVideo.blotName = "video";
            ResponsiveVideo.tagName = "div";
            ResponsiveVideo.className = "ql-video-container";
            Quill.register(ResponsiveVideo, true);

            const toolbarOptions = [
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    header: [1, 2, 3, false]
                }],
                ["bold", "italic", "underline", "strike"],
                ["blockquote", "code-block"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }],
                [{
                    align: []
                }],
                ["link", "image", "video"],
                ["clean"],
            ];

            const quill = new Quill("#editor", {
                modules: {
                    toolbar: toolbarOptions,
                    imageResize: {
                        displaySize: true,
                        modules: ["Resize", "DisplaySize", "Toolbar"]
                    }
                },
                theme: "snow",
                placeholder: "Tulis isi berita menarik hari ini...",
            });

            const form = document.querySelector("#postForm");
            form.onsubmit = function() {
                const isiKonten = document.querySelector("#isi_konten");
                isiKonten.value = quill.root.innerHTML;
            };

            quill.getModule("toolbar").addHandler("image", () => {
                const input = document.createElement("input");
                input.setAttribute("type", "file");
                input.setAttribute("accept", "image/*");
                input.click();
                input.onchange = () => {
                    const file = input.files[0];
                    const formData = new FormData();
                    formData.append("upload", file);
                    formData.append("_token", "{{ csrf_token() }}");
                    fetch("{{ route('ckeditor.upload') }}", {
                            method: "POST",
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(result => {
                            const range = quill.getSelection();
                            quill.insertEmbed(range.index, "image", result.url);
                        })
                        .catch(error => console.error(error));
                };
            });

            const judul = document.querySelector('#judul');
            const slug = document.querySelector('#slug');
            judul.addEventListener('keyup', function() {
                let text = judul.value.toLowerCase()
                    .replace(/[^a-z0-9]/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
                slug.value = text;
            });

            const imageInput = document.querySelector('#imageInput');
            const imagePreview = document.querySelector('#imagePreview');
            const previewContainer = document.querySelector('#previewContainer');
            const uploadPlaceholder = document.querySelector('#uploadPlaceholder');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        uploadPlaceholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</x-app-layout>
