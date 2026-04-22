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
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form id="pageForm" method="POST" action="{{ route('pages.store') }}"
                        enctype="multipart/form-data" class="space-y-8">
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
                            <div class="w-full">
                                <div id="editor-wrapper" class="bg-white">
                                    <div id="editor"></div>
                                </div>
                                <input type="hidden" name="isi_konten" id="isi_konten">
                            </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Quill === 'undefined') return;

            const toolbarOptions = [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'font': []
                }, {
                    'size': ['small', false, 'large', 'huge']
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
                }, {
                    'list': 'check'
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
                        handleStyles: {
                            backgroundColor: '#b91c1c',
                            border: 'none',
                            color: 'white'
                        },
                        modules: ['Resize', 'DisplaySize', 'Toolbar']
                    },
                },
                theme: "snow",
                placeholder: "Tulis konten anda di sini...",
            });

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
                            <button type="button" class="insert-row-below text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">➕ Tambah Baris (Bawah)</button>
                            <button type="button" class="insert-row-above text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">➕ Tambah Baris (Atas)</button>
                            <hr class="my-1">
                            <button type="button" class="insert-col-right text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">➡️ Tambah Kolom (Kanan)</button>
                            <button type="button" class="insert-col-left text-left px-3 py-1 hover:bg-gray-100 rounded text-xs font-bold">⬅️ Tambah Kolom (Kiri)</button>
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
                            if (event.target.classList.contains('insert-row-above')) tableModule
                                .insertRowAbove();
                            if (event.target.classList.contains('insert-col-right')) tableModule
                                .insertColumnRight();
                            if (event.target.classList.contains('insert-col-left')) tableModule
                                .insertColumnLeft();
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

            const form = document.querySelector("#pageForm");
            form.onsubmit = function() {
                document.querySelector("#isi_konten").value = quill.getSemanticHTML();
            };
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
            min-height: 500px;
        }

        .ql-editor {
            min-height: 500px;
            max-height: 1000px;
        }

        .ql-editor img {
            cursor: pointer;
            transition: outline 0.1s ease;
        }

        .ql-editor img:hover {
            outline: 2px solid #b91c1c;
        }

        .ql-editor table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
            margin: 1rem 0;
        }

        .ql-editor table td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            min-width: 20px;
        }
    </style>
</x-app-layout>
