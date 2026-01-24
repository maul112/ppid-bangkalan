<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - PPID Bangkalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">
            <div class="p-6 border-b border-gray-100">
                <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo" class="h-10 mx-auto">
                <p class="text-center text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Panel Kontrol</p>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-red-600 text-white rounded-xl shadow-md transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.permohonan.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Permohonan
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm text-red-600 font-bold bg-red-50 hover:bg-red-100 rounded-xl transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">Dashboard Administrator</h2>
                    <p class="text-gray-500 font-medium">PPID Kabupaten Bangkalan</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="bg-red-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">Admin Mode</span>
                    <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center border border-gray-200 shadow-sm font-bold text-gray-700 uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="bg-gray-900 rounded-[2rem] p-10 mb-10 shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-white mb-3">Selamat Datang kembali, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-400 max-w-2xl text-lg leading-relaxed">Akses penuh pengelolaan informasi publik. Pastikan semua permohonan segera diverifikasi untuk menjaga kualitas layanan.</p>
                </div>
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-red-600 opacity-20 rounded-full blur-3xl"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <a href="{{ route('admin.banner.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Update Banner</h4>
                    <p class="text-gray-500 text-sm mt-1">Kelola gambar promosi halaman depan.</p>
                </a>

                <a href="{{ route('admin.berita.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Update Berita</h4>
                    <p class="text-gray-500 text-sm mt-1">Publikasikan kegiatan terbaru.</p>
                </a>

                <a href="{{ route('admin.dip.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Update DIP</h4>
                    <p class="text-gray-500 text-sm mt-1">Kelola Daftar Informasi Publik.</p>
                </a>

                <a href="{{ route('admin.regulasi.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
                    <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Update Regulasi</h4>
                    <p class="text-gray-500 text-sm mt-1">Kelola dokumen hukum terbaru.</p>
                </a>

            </div>
        </main>
    </div>
</body>
</html>