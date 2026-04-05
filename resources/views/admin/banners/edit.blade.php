<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-red-800">Edit Banner</h2>
    </x-slot>

    <form method="POST" action="{{ route('banners.update', $banner) }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf @method('PUT')

        <input type="text" name="teks" value="{{ $banner->teks }}" class="w-full border p-2 rounded">

        <input type="text" name="sub_teks" value="{{ $banner->sub_teks }}" class="w-full border p-2 rounded">

        {{-- GAMBAR LAMA --}}
        @if ($banner->path_gambar)
            <img src="{{ asset('storage/' . $banner->path_gambar) }}" class="w-40 rounded mb-2">
        @endif

        {{-- UPLOAD BARU --}}
        <input type="file" name="path_gambar" id="imageInput" class="w-full border p-2 rounded">

        <img id="preview" class="mt-3 w-40 hidden rounded">

        <button class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

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
