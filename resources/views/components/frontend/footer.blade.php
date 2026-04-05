<footer class="bg-[#1a1a1a] text-white py-12 mt-10 border-t-4 border-red-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 items-start">

            <div class="space-y-6 flex flex-col items-center md:items-start">
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500">Didukung Oleh :</h3>
                <div class="flex items-center">
                    <x-footer-logo />
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500 text-center md:text-left">
                    Lokasi Kami :</h3>
                <div class="overflow-hidden rounded-xl shadow-2xl border border-gray-800 group">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.7261999242146!2d111.89357867586381!3d-7.604745892410243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e784b72377cfc55%3A0xcbfdc33bfbbb959b!2sPublic%20Safety%20Center%20(PSC)%20119%20Nganjuk!5e0!3m2!1sid!2sid!4v1775188172298!5m2!1sid!2sid"
                        class="w-full h-48 sm:h-40 lg:h-40 transition-all duration-500" style="border:0;"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500 text-center">
                    Media Sosial :</h3>
                <div class="flex flex-col items-center gap-4">
                    <a href="https://www.instagram.com/psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 group text-gray-400 hover:text-white transition-all w-full max-w-[150px]">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-red-700 transition-colors shrink-0">
                            <i class="fab fa-instagram text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold">Instagram</span>
                    </a>
                    <a href="https://www.facebook.com/psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 group text-gray-400 hover:text-white transition-all w-full max-w-[150px]">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-blue-600 transition-colors shrink-0">
                            <i class="fab fa-facebook text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold">Facebook</span>
                    </a>
                    <a href="https://www.tiktok.com/@psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 group text-gray-400 hover:text-white transition-all w-full max-w-[150px]">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-black transition-colors shrink-0">
                            <i class="fab fa-tiktok text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold">TikTok</span>
                    </a>
                    <a href="https://www.youtube.com/@psc119nganjuk" target="_blank"
                        class="flex items-center gap-3 group text-gray-400 hover:text-white transition-all w-full max-w-[150px]">
                        <div class="bg-gray-800 p-2 rounded-lg group-hover:bg-red-600 transition-colors shrink-0">
                            <i class="fab fa-youtube text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold">YouTube</span>
                    </a>
                </div>
            </div>

            <div
                class="flex flex-col items-center justify-center space-y-4 bg-gray-800/30 p-6 rounded-2xl border border-gray-800/50">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Butuh bantuan?</p>
                <a href="https://wa.me/628123456789" target="_blank"
                    class="w-full bg-green-600 hover:bg-green-500 text-white px-6 py-3 rounded-xl flex items-center justify-center gap-3 transition-all shadow-lg hover:-translate-y-1 active:scale-95">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span class="font-extrabold tracking-tight">WHATSAPP</span>
                </a>
                <p class="text-[10px] text-gray-500 text-center uppercase font-medium">Layanan Darurat 24 Jam</p>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] text-center md:text-left">
                    © {{ date('Y') }} Dinas Kominfo Kabupaten Nganjuk
                </p>
                <div class="flex gap-6 text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                    <a href="#" class="hover:text-red-700 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-red-700 transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>
