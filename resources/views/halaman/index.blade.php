<x-front-layout>
    <section
        class="relative min-h-[140px] md:min-h-[280px] lg:min-h-[320px] flex items-end pb-6 md:pb-10 overflow-hidden bg-slate-900 shadow-lg mb-8">

        @if ($page->gambar_fitur)
            <img src="{{ asset('storage/' . $page->gambar_fitur) }}" class="absolute inset-0 w-full h-full object-cover"
                alt="{{ $page->judul_halaman }}">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent"></div>
        @else
            <div class="absolute inset-0 bg-[#1a1a1a]"></div>
        @endif

        <div class="relative w-full max-w-7xl mx-auto px-4 md:px-8 z-10">
            <nav
                class="flex items-center gap-2 mb-3 md:mb-4 text-[10px] md:text-xs font-medium text-slate-300/90 tracking-wide">
                <a href="/" class="hover:text-white transition shrink-0">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[8px] opacity-40"></i>
                <span class="text-white/70 truncate">{{ $page->judul_halaman }}</span>
            </nav>

            <h1
                class="text-xl sm:text-2xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4 md:mb-5 tracking-normal">
                {{ $page->judul_halaman }}
            </h1>

            <div
                class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5 text-xs md:text-sm text-slate-300 font-normal">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar text-red-500"></i>
                    <span>Terbit: <span class="text-white">{{ $page->created_at->format('d M Y') }}</span></span>
                </div>

                <div class="hidden sm:block w-px h-3 bg-slate-700"></div>

                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-clock text-red-500"></i>
                    <span>Terakhir Diperbarui: <span
                            class="text-white">{{ $page->updated_at->diffForHumans() }}</span></span>
                </div>
            </div>
        </div>
    </section>
    <div class="max-w-7xl mx-auto px-6 pb-10">
        <div class="relative">
            <article
                class="prose prose-lg md:prose-xl max-w-none text-slate-700 prose-slate prose-headings:text-slate-900 prose-a:text-red-700 prose-img:rounded-3xl prose-img:shadow-2xl">
                {!! $page->isi_konten !!}
            </article>

            <div class="mt-20 pt-10 border-t border-slate-100 flex justify-center">
                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-4 text-slate-400 hover:text-red-700 font-bold group transition-all">
                    <span
                        class="w-14 h-14 rounded-full border border-slate-200 flex items-center justify-center group-hover:border-red-700 group-hover:bg-red-50 transition-all">
                        <i class="fa-solid fa-arrow-left"></i>
                    </span>
                    <span class="text-lg">Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>

    <style>
        .prose {
            line-height: 1.8;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #334155;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            color: #0f172a;
            font-weight: 800;
            line-height: 1.3;
            margin-top: 2.5rem !important;
            margin-bottom: 1.25rem !important;
            letter-spacing: -0.025em;
        }

        .prose h2 {
            font-size: 1.875rem;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 0.5rem;
        }

        .prose h3 {
            font-size: 1.5rem;
        }

        .prose h4 {
            font-size: 1.25rem;
        }

        .prose p {
            margin-bottom: 1.75rem;
            font-size: 1.125rem;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1.75rem;
            padding-left: 1.5rem;
        }

        .prose li {
            margin-bottom: 0.75rem;
            padding-left: 0.5rem;
        }

        .prose ul>li {
            list-style-type: disc;
        }

        .prose ul>li::marker {
            color: #ef4444;
        }

        .prose ol>li {
            list-style-type: decimal;
        }

        .prose ol>li::marker {
            color: #ef4444;
            font-weight: 700;
        }

        .prose img {
            margin: 1rem auto !important;
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .prose a {
            color: #b91c1c;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 2px solid #fee2e2;
            transition: all 0.2s ease;
        }

        .prose a:hover {
            background-color: #fef2f2;
            border-bottom-color: #b91c1c;
        }

        .prose blockquote {
            margin: 2.5rem 0;
            padding: 1.5rem 2rem;
            border-left: 4px solid #ef4444;
            background-color: #f8fafc;
            border-radius: 0 1rem 1rem 0;
            font-style: italic;
            color: #475569;
            font-size: 1.25rem;
        }

        .prose blockquote p {
            margin-bottom: 0;
        }

        .prose .table-wrapper {
            overflow-x: auto;
            margin: 2rem 0;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
        }

        .prose table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            background: white;
        }

        .prose th {
            background-color: #f8fafc;
            font-weight: 700;
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .prose td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }

        .prose iframe,
        .prose .ql-video {
            width: 100%;
            max-width: 720px;
            display: block;
            margin: 2rem auto;
            aspect-ratio: 16 / 9;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .prose pre {
            background-color: #1e293b;
            color: #f8fafc;
            padding: 1.5rem;
            border-radius: 1rem;
            overflow-x: auto;
            font-size: 0.875rem;
            margin-bottom: 1.75rem;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('oembed[url]').forEach(element => {
                const url = element.getAttribute('url');
                let videoId = '';
                if (url.includes('youtu.be/')) {
                    videoId = url.split('/').pop().split('?')[0];
                } else if (url.includes('youtube.com/watch')) {
                    const urlParams = new URLSearchParams(new URL(url).search);
                    videoId = urlParams.get('v');
                }

                if (videoId) {
                    const iframe = document.createElement('iframe');
                    iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}`);
                    iframe.setAttribute('allow',
                        'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                    );
                    iframe.setAttribute('allowfullscreen', 'true');
                    element.innerHTML = '';
                    element.appendChild(iframe);
                }
            });
        });
    </script>
</x-front-layout>
