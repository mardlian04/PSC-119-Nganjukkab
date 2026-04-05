<x-front-layout>
    <section
        class="relative min-h-[200px] md:min-h-[300px] flex items-end pb-12 overflow-hidden bg-slate-900 shadow-xl mb-12">

        @if ($page->gambar_fitur)
            <img src="{{ asset('storage/' . $page->gambar_fitur) }}" class="absolute inset-0 w-full h-full object-cover"
                alt="{{ $page->judul_halaman }}">

            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
        @else
            <div class="absolute inset-0 bg-slate-900"></div>
        @endif

        <div class="relative w-full max-w-4xl mx-auto px-6 z-10">

            <nav class="flex items-center gap-2 mb-6 text-[10px] uppercase tracking-[0.2em] font-bold text-slate-300/80">
                <a href="/" class="hover:text-red-500 transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[8px] opacity-50"></i>
                <span class="text-white">{{ $page->judul_halaman }}</span>
            </nav>

            <h1 class="text-3xl md:text-5xl font-black text-white leading-[1.1] mb-6 tracking-tight">
                {{ $page->judul_halaman }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-sm text-slate-300">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar-check text-red-500"></i>
                    <span>Terbit: <strong class="text-white">{{ $page->created_at->format('d M Y') }}</strong></span>
                </div>

                <div class="hidden md:block w-1 h-1 rounded-full bg-slate-500"></div>

                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-clock text-red-500"></i>
                    <span>Update: <span class="text-white">{{ $page->updated_at->diffForHumans() }}</span></span>
                </div>
            </div>

        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 pb-24">

        <div class="relative">

            <article class="ck-content prose prose-lg max-w-none text-slate-700 leading-relaxed">

                {!! $page->isi_konten !!}

            </article>

            <div
                class="mt-20 p-8 rounded-3xl bg-slate-50 border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="bg-white p-2 rounded-2xl shadow-sm">
                        <img src="{{ asset('Logo PSC.png') }}" class="h-10 w-auto">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 uppercase">Public Safety Center 119</h4>
                        <p class="text-xs text-slate-500">Dinas Kesehatan Kabupaten Nganjuk</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="window.print()"
                        class="p-3 rounded-xl bg-white border border-slate-200 hover:bg-slate-100">
                        <i class="fa-solid fa-print"></i>
                    </button>

                    <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"
                        class="flex items-center gap-2 px-6 py-3 rounded-xl bg-[#25D366] text-white font-bold text-sm hover:brightness-110">
                        <i class="fa-brands fa-whatsapp"></i>
                        Bagikan
                    </a>
                </div>
            </div>

            <div class="mt-16 flex justify-center">
                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-3 text-slate-400 hover:text-red-700 font-bold">
                    <span class="w-12 h-12 rounded-full border flex items-center justify-center">
                        <i class="fa-solid fa-arrow-left"></i>
                    </span>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <style>
        .ck-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
        }

        .ck-content figure {
            text-align: center;
        }

        .ck-content figcaption {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
        }

        .ck-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .ck-content table th,
        .ck-content table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
        }

        .ck-content iframe {
            width: 100%;
            min-height: 400px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .ck-content ul {
            list-style: disc;
            padding-left: 20px;
        }

        .ck-content ol {
            list-style: decimal;
            padding-left: 20px;
        }

        .ck-content h1,
        .ck-content h2,
        .ck-content h3 {
            font-weight: bold;
            color: #0f172a;
        }
    </style>

</x-front-layout>
