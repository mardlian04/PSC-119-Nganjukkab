<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pages.index') }}" class="text-gray-400 hover:text-red-700 transition-colors">
                <i class="fa-solid fa-arrow-left-long text-xl"></i>
            </a>
            <h2 class="text-xl font-bold text-gray-800">Edit Konten Halaman</h2>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form id="editPageForm" method="POST" action="{{ route('pages.update', $page) }}"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                Halaman</label>
                            <input type="text" name="judul_halaman" value="{{ $page->judul_halaman }}" required
                                class="w-full border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all py-3 px-4 text-lg font-medium"
                                placeholder="Masukkan judul...">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Isi
                                Konten</label>
                            <div class="w-full">
                                <div class="prose max-w-none">
                                    <div id="editor" class="bg-white">{!! $page->isi_konten !!}</div>
                                    <input type="hidden" name="isi_konten" id="isi_konten">
                                </div>
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
                    iframe.setAttribute("style", "width: 100%; min-height: 450px; border:0;");
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
                    header: [1, 2, 3, 4, 5, 6, false]
                }],
                ["bold", "italic", "underline", "strike"],
                ["blockquote", "code-block"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }],
                [{
                    script: "sub"
                }, {
                    script: "super"
                }],
                [{
                    indent: "-1"
                }, {
                    indent: "+1"
                }],
                [{
                    direction: "rtl"
                }],
                [{
                    color: []
                }, {
                    background: []
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
                        modules: ["Resize", "DisplaySize", "Toolbar"],
                    },
                },
                theme: "snow",
                placeholder: "Tulis konten anda di sini...",
            });

            const form = document.querySelector("#editPageForm");
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
                        .then((response) => response.json())
                        .then((result) => {
                            const range = quill.getSelection();
                            quill.insertEmbed(range.index, "image", result.url);
                        })
                        .catch((error) => console.error("Error:", error));
                };
            });
        });
    </script>

    <style>
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #e5e7eb;
            background-color: #f9fafb;
            padding: 0.75rem;
        }

        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #e5e7eb;
            font-size: 1rem;
            background-color: white;
            min-height: 500px;
        }

        .ql-editor {
            min-height: 500px;
            max-height: 800px;
            overflow-y: auto;
        }

        .ql-video-container {
            position: relative;
            width: 100%;
            max-width: 720px;
            margin: 2rem auto;
            aspect-ratio: 16 / 9;
            border-radius: 1rem;
            overflow: hidden;
        }

        .ql-video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border: none;
        }
    </style>
</x-app-layout>
