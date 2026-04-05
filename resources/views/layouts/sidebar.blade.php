<aside class="w-72 bg-[#121212] text-slate-400 min-h-screen fixed flex flex-col shadow-2xl border-r border-white/5">

    {{-- LOGO SECTION --}}
    <div class="px-8 py-10 flex items-center justify-center">
        <x-application-logo class="items-center h-24 w-auto fill-current text-white" />
    </div>

    {{-- MENU SECTION --}}
    <nav class="flex-1 px-4 overflow-y-auto custom-scrollbar">
        <p class="px-4 text-[10px] font-bold text-white uppercase tracking-[0.2em] mb-6">Main Dashboard</p>

        <ul class="space-y-2">
            {{-- Loop Helper untuk Menu --}}
            @php
                $menus = [
                    [
                        'route' => 'dashboard',
                        'icon' =>
                            'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                        'label' => 'Dashboard',
                    ],
                    [
                        'route' => 'posts.index',
                        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM7 8h5m-5 4h10',
                        'label' => 'Kelola Postingan',
                    ],
                    [
                        'route' => 'banners.index',
                        'icon' =>
                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'label' => 'Kelola Banner',
                    ],
                    [
                        'route' => 'menu.index',
                        'icon' =>
                            'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        'label' => 'Kelola Navigasi Menu',
                    ],
                    [
                        'route' => 'pages.index',
                        'icon' =>
                            'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                        'label' => 'Kelola Pages',
                    ],
                    [
                        'route' => 'galleries.index',
                        'icon' =>
                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'label' => 'Kelola Gallery',
                    ],
                    [
                        'route' => 'galleries.index',
                        'icon' =>
                            'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'label' => 'Kelola Kontak',
                    ],
                ];
            @endphp

            @foreach ($menus as $menu)
                <li>
                    <a href="{{ route($menu['route']) }}"
                        class="group flex items-center px-4 py-3.5 text-sm font-medium rounded-xl transition-all duration-300
                    {{ request()->routeIs($menu['route'])
                        ? 'bg-red-800 text-white shadow-lg shadow-red-900/40 translate-x-1'
                        : 'hover:bg-white/5 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors duration-300 {{ request()->routeIs($menu['route']) ? 'text-white' : 'text-slate-500 group-hover:text-red-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="{{ $menu['icon'] }}" />
                        </svg>

                        {{ $menu['label'] }}

                        @if (request()->routeIs($menu['route']))
                            <span
                                class="ml-auto w-1.5 h-1.5 rounded-full bg-white/50 shadow-[0_0_8px_rgba(255,255,255,0.8)]"></span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="p-4 border-t border-white/5 bg-black/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="flex items-center w-full px-4 py-3 text-sm font-semibold text-slate-500 rounded-xl hover:bg-red-900/20 hover:text-red-500 transition-all duration-300 group">
                <div class="p-1.5 rounded-lg bg-slate-800 group-hover:bg-red-900/30 mr-3 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                Logout
            </button>
        </form>
    </div>

</aside>
