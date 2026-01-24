<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PPID Kabupaten Bangkalan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <header class="bg-white py-4 shadow-sm relative z-[60]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo PPID" class="h-16 w-auto">
                    <div class="h-10 w-[1px] bg-gray-200 hidden md:block"></div>
                    <div>
                        <h1 class="text-xl font-black text-blue-900 leading-none">PPID KABUPATEN</h1>
                        <p class="text-sm font-bold text-gray-500 tracking-[0.2em]">BANGKALAN</p>
                    </div>
                </div>
                <div class="hidden lg:block text-right">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">E-Mail Resmi</p>
                    <p class="text-sm font-bold text-blue-600 italic">ppid@bangkalankab.go.id</p>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-[#2B7FFF] sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center space-x-1">
                    <a href="/" class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold transition">BERANDA</a>
                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            PROFIL <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="/profil/struktur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Struktur Organisasi</a>
                                <a href="/profil/visi-misi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Visi dan Misi</a>
                                <a href="/profil/tugas-fungsi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Tugas dan Fungsi</a>
                            </div>
                        </div>
                    </div>
                    <a href="/informasi-publik" class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold">INFORMASI PUBLIK</a>
                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            LAYANAN ONLINE <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-64">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="/permohonan/buat" class="block px-4 py-2 text-sm text-blue-700 hover:bg-blue-50 font-black italic underline">
                                    <i class="fa-solid fa-file-pen mr-2"></i> AJUKAN PERMOHONAN
                                </a>
                                <a href="{{ route('permohonan.daftar_publik') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">
                                    <i class="fa-solid fa-list-ul mr-2"></i> DAFTAR PERMOHONAN
                                </a>
                                <a href="{{ route('permohonan.tracking') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">
                                    <i class="fa-solid fa-magnifying-glass mr-2"></i> CEK STATUS (TRACKING)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative dropdown">
                    <button class="bg-yellow-400 text-blue-900 px-6 py-1.5 rounded text-xs font-black hover:bg-yellow-500 transition shadow-sm flex items-center">
                        MASUK <i class="fa-solid fa-right-to-bracket ml-2"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden pt-2 right-0 w-48">
                        <div class="bg-white shadow-2xl rounded-md py-2 border-t-4 border-yellow-500 text-left">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold">Admin PPID</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-[#0b0f1a] text-white pt-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 text-center text-gray-400">
            <p>© {{ date('Y') }} PEMERINTAH KABUPATEN BANGKALAN - DISKOMINFO</p>
        </div>
    </footer>

</body>
</html>