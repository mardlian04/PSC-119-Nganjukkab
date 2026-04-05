<nav class="bg-[#800000] text-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12">
                        <x-application-logo />
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class="font-bold max-sm:text-sm text-lg tracking-wide uppercase">
                            Public Safety Center (PSC) 119
                        </span>
                        <span class="text-xs max-sm:text-xs font-medium text-gray-200">
                            DINAS KESEHATAN KABUPATEN NGANJUK
                        </span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-sm font-semibold text-gray-300 hover:text-white transition">
                    Beranda
                </a>
                @foreach ($menus as $menu)
                    @if ($menu->children->count())
                        <div class="relative group">
                            <button
                                class="flex items-center gap-1 text-sm font-semibold text-gray-300 group-hover:text-white transition focus:outline-none py-2">
                                {{ $menu->nama_menu }}
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute w-full h-2 top-full"></div>
                            <div
                                class="absolute left-0 top-full hidden group-hover:block bg-white text-gray-800 w-52 rounded-xl shadow-xl py-2 z-50 border border-gray-100">
                                @foreach ($menu->children as $child)
                                    <a href="{{ url($child->link_url) }}"
                                        class="flex items-center justify-between px-4 py-2.5 text-sm font-medium hover:bg-red-50 hover:text-red-700 transition mx-2 rounded-lg">
                                        {{ $child->nama_menu }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->link_url ? url($menu->link_url) : '#' }}"
                            class="text-sm font-semibold text-gray-300 hover:text-white transition py-2">
                            {{ $menu->nama_menu }}
                        </a>
                    @endif
                @endforeach
                <a href="/login"
                    class="ml-4 bg-red-700 hover:bg-red-600 text-white px-5 py-2 rounded text-sm font-bold transition shadow-inner">
                    LOGIN
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="md:hidden bg-[#910000] border-t border-red-800">
        <div class="px-4 pt-2 pb-6 space-y-1 shadow-inner">
            <a href="/"
                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-800">Beranda</a>

            @foreach ($menus as $menu)
                @if ($menu->children->count())
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-800">
                            {{ $menu->nama_menu }}
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 bg-[#700000] rounded-lg mt-1">
                            @foreach ($menu->children as $child)
                                <a href="{{ url($child->link_url) }}"
                                    class="block px-3 py-2 text-sm text-gray-200 hover:text-white">{{ $child->nama_menu }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $menu->link_url ? url($menu->link_url) : '#' }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-800">{{ $menu->nama_menu }}</a>
                @endif
            @endforeach

            <a href="{{ route('galeri.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-red-800">Galeri</a>

            <div class="pt-4 border-t border-red-800">
                <a href="/login"
                    class="block text-center bg-red-700 text-white px-5 py-3 rounded-lg font-bold">LOGIN</a>
            </div>
        </div>
    </div>
</nav>
