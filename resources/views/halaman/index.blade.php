<x-front-layout>
    <section
        class="relative min-h-[160px] md:min-h-[300px] lg:min-h-[350px] flex items-end pb-8 md:pb-12 overflow-hidden bg-slate-900 shadow-xl mb-6 md:mb-10">
        @if ($page->gambar_fitur)
            <img src="{{ asset('storage/' . $page->gambar_fitur) }}" class="absolute inset-0 w-full h-full object-cover"
                alt="{{ $page->judul_halaman }}">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/70 to-transparent"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-slate-800"></div>
        @endif

        <div class="relative w-full max-w-7xl mx-auto px-4 md:px-8 z-10">
            <nav
                class="flex items-center gap-2 mb-3 md:mb-4 text-[9px] md:text-xs font-semibold text-slate-300 uppercase tracking-widest">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[7px] opacity-50"></i>
                <span class="text-white/60 truncate">{{ $page->judul_halaman }}</span>
            </nav>

            <h1
                class="text-xl sm:text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 md:mb-6 tracking-tight">
                {{ $page->judul_halaman }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 md:gap-6 text-[10px] md:text-sm text-slate-300">
                <div
                    class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-2.5 py-1 md:px-3 md:py-1.5 rounded-full border border-white/10">
                    <i class="fa-regular fa-calendar text-red-400"></i>
                    <span>{{ $page->created_at->format('d M Y') }}</span>
                </div>
                <div
                    class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-2.5 py-1 md:px-3 md:py-1.5 rounded-full border border-white/10">
                    <i class="fa-regular fa-clock text-red-400"></i>
                    <span>{{ $page->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="w-full mx-auto px-4 md:px-6 pb-12 md:pb-20">
        <div class="flex justify-center">
            <div class="w-full max-w-7xl overflow-hidden">
                <article class="prose prose-slate max-w-none p-5 md:p-12 lg:p-16 break-words overflow-x-hidden">
                    {!! $page->isi_konten !!}
                </article>
            </div>
        </div>

        <div class="mt-8 md:mt-12 flex justify-center">
            <a href="{{ route('welcome') }}"
                class="group flex items-center gap-3 text-slate-400 hover:text-red-700 font-bold transition-all duration-300">
                <span
                    class="w-10 h-10 md:w-12 md:h-12 rounded-full border border-slate-200 flex items-center justify-center group-hover:border-red-700 group-hover:bg-red-50 transition-all">
                    <i class="fa-solid fa-arrow-left text-sm md:text-base"></i>
                </span>
                <span class="text-sm md:text-lg">Kembali ke Beranda</span>
            </a>
        </div>
    </div>

    <style>
        .prose {
            line-height: 1.7;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #334155;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .prose {
                font-size: 1.125rem;
                line-height: 1.85;
            }
        }

        .prose p {
            margin-top: 1.25rem !important;
            margin-bottom: 1.25rem !important;
            text-align: justify;
            text-justify: inter-word;
        }

        .prose h2,
        .prose h3,
        .prose h4 {
            color: #0f172a !important;
            font-weight: 800 !important;
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
            line-height: 1.3;
            text-align: left;
        }

        .prose h2 {
            font-size: 1.5rem;
            border-left: 4px solid #ef4444;
            padding-left: 0.75rem;
        }

        @media (min-width: 768px) {
            .prose h2 {
                font-size: 1.875rem;
                padding-left: 1rem;
            }
        }

        .prose ul,
        .prose ol {
            margin: 1.25rem 0 !important;
            padding-left: 1.25rem !important;
            text-align: left;
        }

        .prose li {
            margin-bottom: 0.5rem !important;
            padding-left: 0.25rem;
        }

        .prose ol>li {
            list-style-type: decimal !important;
        }

        .prose ul>li {
            list-style-type: disc !important;
        }

        .prose li::marker {
            color: #000000 !important;
            font-weight: 800 !important;
        }

        .prose table {
            display: block;
            width: 100% !important;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin: 2rem 0 !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
        }

        .prose th,
        .prose td {
            min-width: 120px;
            padding: 0.75rem 1rem !important;
            border-bottom: 1px solid #f1f5f9 !important;
            border-right: 1px solid #f1f5f9 !important;
        }

        .prose th {
            background-color: #f8fafc !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .prose tr:nth-child(even) {
            background-color: #fbfcfe !important;
        }

        .prose tr td:last-child,
        .prose tr th:last-child {
            border-right: none !important;
        }

        .prose img {
            border-radius: 1rem !important;
            margin: 2rem auto !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            height: auto;
            max-width: 100%;
        }

        .prose blockquote {
            border-left: 4px solid #ef4444;
            background: #f8fafc;
            padding: 1rem 1.25rem;
            font-style: italic;
            margin: 2rem 0;
            border-radius: 0 0.75rem 0.75rem 0;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('oembed[url], .ql-video').forEach(element => {
                const url = element.getAttribute('url') || element.getAttribute('src');
                let videoId = '';
                if (url && url.includes('youtu.be/')) {
                    videoId = url.split('/').pop().split('?')[0];
                } else if (url && url.includes('youtube.com/watch')) {
                    const urlParams = new URLSearchParams(new URL(url).search);
                    videoId = urlParams.get('v');
                }
                if (videoId) {
                    const container = document.createElement('div');
                    container.className =
                        'my-6 md:my-8 shadow-xl rounded-xl overflow-hidden aspect-video w-full';
                    container.innerHTML =
                        `<iframe src="https://www.youtube.com/embed/${videoId}" class="w-full h-full" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>`;
                    element.parentNode.replaceChild(container, element);
                }
            });
        });
    </script>
</x-front-layout>
