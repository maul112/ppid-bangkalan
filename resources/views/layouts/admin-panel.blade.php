<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard - PPID Bangkalan' }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('img/IMG_5776.jpeg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col fixed h-full">
            <div class="p-6 border-b border-gray-100">
                <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo" class="h-10 mx-auto">
                <p class="text-center text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Panel Kontrol</p>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.permohonan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.permohonan.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Permohonan
                </a>
                <a href="{{ route('admin.hari-libur.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.hari-libur.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Hari Libur
                </a>
                <a href="{{ route('admin.banner.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.banner.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Banner
                </a>
                <a href="{{ route('admin.berita.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.berita.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                    Berita
                </a>
                <a href="{{ route('admin.dip.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dip.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    DIP
                </a>
                <a href="{{ route('admin.regulasi.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.regulasi.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    Regulasi
                </a>
                <a href="{{ route('admin.dokumen.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dokumen.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Dokumen
                </a>
                <a href="{{ route('admin.lhkpn.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.lhkpn.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    LHKPN
                </a>
                <a href="{{ route('admin.pejabat.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pejabat.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pejabat PPID
                </a>
                <a href="{{ route('admin.struktur-organisasi.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.struktur-organisasi.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Struktur Organisasi
                </a>
                <a href="{{ route('admin.agenda.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.agenda.*') ? 'bg-red-600 text-white shadow-md' : 'text-gray-600 hover:bg-red-50' }} rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Agenda
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