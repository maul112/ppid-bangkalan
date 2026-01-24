<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard - PPID Bangkalan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col fixed h-full">
            <div class="p-6 border-b border-gray-100">
                <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo" class="h-10 mx-auto">
                <p class="text-center text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Panel Kontrol</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.permohonan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.permohonan.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Permohonan
                </a>
                </nav>
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm text-red-600 font-bold bg-red-50 hover:bg-red-100 rounded-xl transition-all">
                        LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-64 p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">{{ $header }}</h2>
                    <p class="text-gray-500 font-medium">PPID Kabupaten Bangkalan</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="bg-red-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">Admin Mode</span>
                    <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center border border-gray-200 shadow-sm font-bold text-gray-700 uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            {{ $slot }}
        </main>
    </div>
</body>
</html>