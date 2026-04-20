<footer class="bg-[#1a1a1a] text-white py-12 md:py-20 mt-16 border-t-4 border-red-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 items-start">

            <div class="space-y-8 flex flex-col items-center sm:items-start text-center sm:text-left">
                <div class="space-y-4">
                    <h3 class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-gray-100">
                        Didukung Oleh :
                    </h3>
                    <div
                        class="flex items-center justify-center sm:justify-start transform hover:scale-105 transition-transform duration-300">
                        <x-footer-logo />
                    </div>
                </div>

                <div class="w-full pt-6 border-t border-gray-800/50 space-y-4">
                    <div class="flex items-center gap-4 justify-center sm:justify-start group">
                        <div class="p-2 bg-gray-800/30 rounded-lg group-hover:bg-red-900/20 transition-colors">
                            <i class="fas fa-users text-red-600 text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-[9px] text-gray-500 uppercase font-bold tracking-wider leading-tight">Pengunjung
                                Hari Ini</span>
                            <span
                                class="text-base font-bold text-gray-200">{{ number_format($visitorToday ?? 0) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 justify-center sm:justify-start group">
                        <div class="p-2 bg-gray-800/30 rounded-lg group-hover:bg-red-900/20 transition-colors">
                            <i class="fas fa-chart-line text-red-600 text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-[9px] text-gray-500 uppercase font-bold tracking-wider leading-tight">Total
                                Pengunjung</span>
                            <span
                                class="text-base font-bold text-gray-200">{{ number_format($totalVisitors ?? 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3
                    class="text-xs font-bold uppercase tracking-[0.2em] text-gray-100 text-center sm:text-left border-b border-red-800/30 pb-2 inline-block">
                    Lokasi Kami :
                </h3>
                <div class="overflow-hidden rounded-2xl shadow-2xl hover:border-red-800/50 transition-all duration-500">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.7261999242146!2d111.89357867586381!3d-7.604745892410243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e784b72377cfc55%3A0xcbfdc33bfbbb959b!2sPublic%20Safety%20Center%20(PSC)%20119%20Nganjuk!5e0!3m2!1sid!2sid!4v1775188172298!5m2!1sid!2sid"
                        class="w-full h-48 sm:h-56 lg:h-44 transition-all duration-500" style="border:0;"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="space-y-6">
                <h3
                    class="text-xs font-bold uppercase tracking-[0.2em] text-gray-100 text-center sm:text-left border-b border-red-800/30 pb-2 inline-block">
                    Media Sosial :
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-3">
                    <a href="https://www.youtube.com/@psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 p-2 rounded-xl bg-gray-800/20 border border-transparent hover:border-red-800 hover:bg-gray-800/40 transition-all group">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-red-700 transition-colors shrink-0">
                            <i class="fab fa-youtube text-base"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 group-hover:text-white">YouTube</span>
                    </a>
                    <a href="https://www.instagram.com/psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 p-2 rounded-xl bg-gray-800/20 border border-transparent hover:border-blue-700 hover:bg-gray-800/40 transition-all group">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-blue-700 transition-colors shrink-0">
                            <i class="fab fa-instagram text-base"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 group-hover:text-white">Instagram</span>
                    </a>
                    <a href="https://www.facebook.com/psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 p-2 rounded-xl bg-gray-800/20 border border-transparent hover:border-blue-600 hover:bg-gray-800/40 transition-all group">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-blue-600 transition-colors shrink-0">
                            <i class="fab fa-facebook text-base"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 group-hover:text-white">Facebook</span>
                    </a>
                    <a href="https://www.tiktok.com/@psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 p-2 rounded-xl bg-gray-800/20 border border-transparent hover:border-white hover:bg-gray-800/40 transition-all group">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-black transition-colors shrink-0">
                            <i class="fab fa-tiktok text-base"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 group-hover:text-white">TikTok</span>
                    </a>
                </div>
            </div>

            <div
                class="flex flex-col space-y-4 items-center justify-center bg-gradient-to-b from-gray-800/10 to-gray-800/30 p-8 rounded-3xl border border-gray-800/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Butuh Bantuan?</p>
                <a href="https://wa.me/6281131168119" target="_blank"
                    class="w-full bg-green-600 hover:bg-green-500 text-white px-4 py-4 rounded-2xl flex items-center justify-center gap-3 transition-all shadow-lg hover:-translate-y-1 active:scale-95 shadow-green-900/20">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span class="font-black tracking-tight text-sm md:text-base">Whatsapp</span>
                </a>
                <p class="text-[10px] text-red-500 text-center uppercase font-bold animate-pulse">Layanan Darurat 24 Jam
                </p>
            </div>
        </div>

        <div class="mt-16 pt-10 border-t border-gray-800/50">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left space-y-1">
                    <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] leading-relaxed">
                        © {{ date('Y') }} Dinas Komunikasi dan Informatika Kabupaten Nganjuk
                    </p>
                    <p class="text-[9px] text-gray-600 uppercase tracking-widest font-medium">
                        Public Safety Center 119 Kabupaten Nganjuk • All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
