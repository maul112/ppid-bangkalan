<x-guest-layout>
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm font-bold">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded text-blue-800 shadow-sm">
        <p class="text-sm font-bold italic">
            ⚠️ Khusus Pengelola PPID & OPD
        </p>
        <p class="text-xs mt-1">
            Masyarakat umum tidak perlu login untuk mengajukan permohonan informasi.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Pengelola')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3 bg-blue-900 hover:bg-blue-800">
                {{ __('Masuk Panel Admin') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>