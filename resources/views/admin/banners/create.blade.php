<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-red-800">Tambah Banner</h2>
    </x-slot>

    <div class="p-6">

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf

            <input type="text" name="teks" value="{{ old('teks') }}" placeholder="Teks Banner"
                class="w-full border p-2 rounded">

            <input type="text" name="sub_teks" value="{{ old('sub_teks') }}" placeholder="Sub Teks"
                class="w-full border p-2 rounded">

            {{-- UPLOAD IMAGE --}}
            <div>
                <label class="block mb-2 font-semibold">Gambar</label>

                <input type="file" name="path_gambar" id="imageInput" accept="image/*"
                    class="w-full border p-2 rounded">

                <img id="preview" class="mt-3 w-40 hidden rounded">
            </div>

            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">
                Simpan
            </button>

        </form>
    </div>

    {{-- PREVIEW SCRIPT --}}
    <script>
        document.getElementById('imageInput').onchange = evt => {
            const [file] = evt.target.files;
            if (file) {
                const preview = document.getElementById('preview');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        }
    </script>

</x-app-layout>
