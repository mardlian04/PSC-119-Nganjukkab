<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Selamat Datang</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masuk ke akun PSC Kab. Nganjuk</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm"
                type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button
                class="w-full justify-center py-3 bg-red-600 hover:bg-red-700 active:bg-red-800 focus:ring-red-500 transition-all duration-200 ease-in-out shadow-lg shadow-red-200">
                <span class="uppercase tracking-widest font-bold">
                    {{ __('Log in') }}
                </span>
            </x-primary-button>
        </div>

        <p class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} PSC 119 Kab. Nganjuk. All rights reserved.
        </p>
    </form>
</x-guest-layout>
