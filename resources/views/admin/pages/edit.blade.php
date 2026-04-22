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
                                <div id="editor-wrapper" class="bg-white">
                                    <div id="editor">{!! $page->isi_konten !!}</div>
                                </div>
                                <input type="hidden" name="isi_konten" id="isi_konten">
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
            if (typeof Quill === 'undefined') return;

            // Register Video Blot (Tetap dipertahankan dari kode lama Anda)
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
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }, {
                    'align': []
                }],
                ['link', 'image', 'video'],
                ['table'],
                ['clean']
            ];

            const quill = new Quill("#editor", {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {
                            image: function() {
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
                                        });
                                };
                            }
                        }
                    },
                    table: true,
                    imageResize: {
                        displaySize: true,
                        modules: ['Resize', 'DisplaySize', 'Toolbar']
                    }
                },
                theme: "snow",
                placeholder: "Tulis konten anda di sini...",
            });

            // Logic Tabel (Context Menu)
            const tableModule = quill.getModule('table');
            document.addEventListener('click', (e) => {
                const tableBtn = e.target.closest('.ql-table');
                if (tableBtn) {
                    const tooltip = document.querySelector('.ql-table-tooltip');
                    if (!tooltip) {
                        const menu = document.createElement('div');
                        menu.className =
                            'ql-table-tooltip bg-white shadow-xl border border-gray-200 rounded-lg p-2 absolute z-[50] grid grid-cols-1 gap-1';
                        menu.innerHTML = `
                            <button type="button" class="insert-row-below text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">➕ Baris (Bawah)</button>
                            <button type="button" class="insert-col-right text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">➡️ Kolom (Kanan)</button>
                            <hr class="my-1">
                            <button type="button" class="delete-row text-left px-3 py-1 hover:bg-red-50 text-red-600 rounded text-xs font-bold">🗑️ Hapus Baris</button>
                            <button type="button" class="delete-col text-left px-3 py-1 hover:bg-red-50 text-red-600 rounded text-xs font-bold">🗑️ Hapus Kolom</button>
                            <button type="button" class="delete-table text-left px-3 py-1 hover:bg-red-600 hover:text-white text-red-600 rounded text-xs font-bold">🔥 Hapus Tabel</button>
                        `;
                        document.body.appendChild(menu);
                        const rect = tableBtn.getBoundingClientRect();
                        menu.style.top = `${rect.bottom + window.scrollY + 5}px`;
                        menu.style.left = `${rect.left + window.scrollX}px`;

                        menu.addEventListener('click', (event) => {
                            if (event.target.classList.contains('insert-row-below')) tableModule
                                .insertRowBelow();
                            if (event.target.classList.contains('insert-col-right')) tableModule
                                .insertColumnRight();
                            if (event.target.classList.contains('delete-row')) tableModule
                                .deleteRow();
                            if (event.target.classList.contains('delete-col')) tableModule
                                .deleteColumn();
                            if (event.target.classList.contains('delete-table')) tableModule
                                .deleteTable();
                            menu.remove();
                        });

                        document.addEventListener('mousedown', (clickOut) => {
                            if (!menu.contains(clickOut.target) && !tableBtn.contains(clickOut
                                    .target)) menu.remove();
                        }, {
                            once: true
                        });
                    }
                }
            });

            const form = document.querySelector("#editPageForm");
            form.onsubmit = function() {
                // Menggunakan getSemanticHTML agar output table lebih bersih untuk disimpan ke DB
                document.querySelector("#isi_konten").value = quill.getSemanticHTML();
            };
        });
    </script>

    <style>
        /* Toolbar & Editor Styling */
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
            min-height: 500px;
        }

        .ql-editor {
            min-height: 500px;
            max-height: 1000px;
        }

        /* Table Design dalam Editor */
        .ql-editor table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
            margin: 1rem 0;
        }

        .ql-editor table td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
        }

        /* Video Styling */
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
        }
    </style>
</x-app-layout>
