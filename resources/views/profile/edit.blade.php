<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="p-2 bg-red-100 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Pengaturan Profil Admin') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-1">
                    <div class="sticky top-10">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Akun</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Pastikan data diri Anda valid untuk keperluan koordinasi layanan darurat di lapangan.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-6">
                    <div class="p-6 bg-white shadow-sm border border-gray-100 sm:rounded-xl transition hover:shadow-md">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-6 bg-white shadow-sm border border-gray-100 sm:rounded-xl transition hover:shadow-md">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div
                        class="p-6 bg-red-50/50 border border-red-100 shadow-sm sm:rounded-xl transition hover:shadow-md">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
