<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Daftar Akun Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Bergabunglah dengan layanan profesional PSC 119</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-gray-700" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Masukkan nama lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="password" name="password" required autocomplete="new-password" placeholder="Buat password kuat" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="Ulangi password Anda" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4 mt-8">
            <x-primary-button
                class="w-full justify-center py-3 bg-red-600 hover:bg-red-700 active:bg-red-800 focus:ring-red-500 transition-all duration-200 ease-in-out shadow-lg shadow-red-100">
                <span class="uppercase tracking-widest font-bold">
                    {{ __('Daftar Sekarang') }}
                </span>
            </x-primary-button>

            <div class="text-center">
                <a class="text-sm text-gray-600 hover:text-red-600 font-medium transition duration-150 ease-in-out"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun? Silakan masuk') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
