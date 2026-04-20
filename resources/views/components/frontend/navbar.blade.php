<nav class="bg-[#861413] text-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center">
                <a href="/" class="flex items-center gap-3 group" title="Kembali ke Beranda">
                    <div class="w-12 h-12 transition-transform group-hover:scale-105">
                        <x-application-logo />
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class="font-bold max-sm:text-[12px] text-lg tracking-wide uppercase">
                            Public Safety Center (PSC) 119
                        </span>
                        <span class="text-xs max-sm:text-[10px] font-medium text-red-200">
                            DINAS KESEHATAN KABUPATEN NGANJUK
                        </span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="/"
                    class="text-sm font-semibold {{ request()->is('/') ? 'text-white' : 'text-red-100 hover:text-white' }} transition">
                    Beranda
                </a>

                @foreach ($menuNavigation as $m)
                    @if ($m->children->count())
                        <div class="relative group">
                            <button
                                class="flex items-center gap-1 text-sm font-semibold text-red-100 group-hover:text-white transition focus:outline-none py-2">
                                {{ $m->nama_menu }}
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute w-full h-4 top-full"></div>

                            <div
                                class="absolute left-0 top-full hidden group-hover:block bg-white text-gray-800 w-52 rounded-xl shadow-xl py-2 z-50 border border-gray-100 mt-2">
                                @foreach ($m->children as $child)
                                    <a href="{{ url($child->link_url) }}"
                                        class="flex items-center px-4 py-2.5 text-sm font-medium hover:bg-red-50 hover:text-red-700 transition mx-2 rounded-lg">
                                        {{ $child->nama_menu }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $m->link_url ? url($m->link_url) : '#' }}"
                            class="text-sm font-semibold text-red-100 hover:text-white transition py-2">
                            {{ $m->nama_menu }}
                        </a>
                    @endif
                @endforeach
                <div class="pl-4">
                    <a href="/login"
                        class="flex items-center justify-center w-12 h-12 text-white rounded-2xl transition-all duration-300"
                        title="Login Portal">

                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="stroke-current text-white">
                            <path
                                d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white p-2 focus:outline-none"
                    aria-label="Buka Menu Navigasi">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden absolute top-full left-0 w-full bg-[#910000] border-t border-red-800 shadow-2xl z-[60]">

        <div class="px-4 pt-2 pb-8 space-y-1 shadow-inner max-h-[85vh] overflow-y-auto">
            <a href="/"
                class="block px-4 py-3 rounded-lg text-base font-semibold text-white hover:bg-red-800 transition">
                Beranda
            </a>

            @foreach ($menuNavigation as $m)
                @if ($m->children->count())
                    <div x-data="{ open: false }" class="border-b border-red-800/50 last:border-none">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 rounded-lg text-base font-semibold text-white hover:bg-red-800 transition">
                            {{ $m->nama_menu }}
                            <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="ml-4 mb-2 bg-[#700000] rounded-xl overflow-hidden">
                            @foreach ($m->children as $child)
                                <a href="{{ url($child->link_url) }}"
                                    class="block px-5 py-3 text-sm font-medium text-red-100 hover:text-white hover:bg-red-800 transition">
                                    {{ $child->nama_menu }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $m->link_url ? url($m->link_url) : '#' }}"
                        class="block px-4 py-3 rounded-lg text-base font-semibold text-white hover:bg-red-800 transition border-b border-red-800/50 last:border-none">
                        {{ $m->nama_menu }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</nav>
