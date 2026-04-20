<nav class="bg-[#8B0000] border-b border-white/10 px-8 py-4 flex items-center justify-between shadow-md">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg hover:bg-white/10 text-white transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16" />
            </svg>
        </button>
        <h2 class="font-semibold text-white">Dashboard Admin PSC 119 Kab. Nganjuk</h2>
    </div>

    <div class="flex items-center gap-4">
        <div class="text-right mr-2">
            <p class="text-sm font-bold text-white leading-none">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
        </div>
        <div
            class="h-10 w-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-white font-bold shadow-inner">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </div>
</nav>
