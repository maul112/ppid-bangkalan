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

    <header style="background-image: url('{{ asset('img/IMG_5775.png') }}')" class="bg-center bg-no-repeat bg-contains bg-cover py-4 shadow-sm relative z-[60]">
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
                <div class="flex items-center justify-center gap-4 space-x-1 w-full">
                    <a href="/" class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold transition">Beranda</a>
                    
                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Profil PPID <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="{{ route('profil.tentang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Tentang PPID</a>
                                <a href="{{ route('profil.tugas_fungsi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Tugas dan Fungsi</a>
                                <a href="{{ route('profil.visi_misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Visi dan Misi</a>
                                <a href="{{ route('profil.struktur_organisasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Struktur Organisasi</a>
                                <a href="{{ route('profil.dasar_hukum') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Dasar Hukum</a>
                                <a href="{{ route('profil.sop') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">SOP</a>
                                <a href="{{ route('profil.maklumat_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Maklumat Pelayanan</a>
                                <a href="{{ route('profil.alur_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Alur Pelayanan</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Laporan PPID</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Pejabat PPID <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="{{ route('profil.tentang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Bupati</a>
                                <a href="{{ route('profil.tugas_fungsi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Wakl Bupati</a>
                                <a href="{{ route('profil.visi_misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Sekda</a>
                                <a href="{{ route('profil.struktur_organisasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Asisten</a>
                                <a href="{{ route('profil.dasar_hukum') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Staf ahli</a>
                                <a href="{{ route('profil.sop') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Inspektur</a>
                                <a href="{{ route('profil.maklumat_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Kepala Badan</a>
                                <a href="{{ route('profil.alur_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Kepala Dinas</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Kepala Bagian</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Kepala Puskesmas</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Camat</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Lurah</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Direktur RSD</a>
                                <a href="{{ route('profil.laporan_pelayanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Direktur BUMD</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Daftar Informasi Publik <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Bupati</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Wakil Bupati</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Layanan Informasi Publik <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Bupati</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Wakil Bupati</a>
                            </div>
                        </div>
                    </div>


                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Transparansi Pemkap <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Transparansi Pemkab</a>
                            </div>
                        </div>
                    </div>


                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded group hover:bg-white/10 text-sm font-bold flex items-center">
                            Layanan Online <i class="fa-solid fa-chevron-down ml-2 text-[10px] group-hover:-rotate-180 transition duration-75"></i>
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
                                <hr class="my-2 border-gray-100">
                                <a href="/prosedur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Prosedur Informasi</a>
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
                            <p class="px-4 py-1 text-[9px] font-bold text-gray-400 uppercase tracking-widest">Login Internal</p>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold">Admin PPID</a>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold border-t border-gray-50">Admin OPD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#0b0f1a] text-white pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="flex items-center gap-4 md:gap-8">
                <div class="w-2/5 md:w-1/5">
                    <img class="block w-full" src="{{ asset('img/logo_ppid_2.png') }}" alt="logo">
                </div>
                <div>
                    <p>Website Resmi PPID (Pejabat Pengelola Informasi dan Dokumentasi Kabupaten Bangkalan).</p>
                </div>
            </div>
            <hr class="my-8 border-gray-500">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center">
                        <span class="w-1 h-6 bg-blue-600 mr-3 rounded-full"></span>Hubungi Kami
                    </h4>
                    <div class="space-y-5 text-gray-400 text-sm">
                        <div class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-4 text-blue-500"></i>
                            <p>Jl. Letnan Abdullah No.1, Alun-Alun Barat, Kabupaten Bangkalan, Jawa Timur 69112</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-phone mr-4 text-blue-500"></i>
                            <p>(031) 3095331</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-envelope mr-4 text-blue-500"></i>
                            <p>diskominfo@bangkalankab.go.id</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center">
                        <span class="w-1 h-6 bg-blue-600 mr-3 rounded-full"></span>Navigasi
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Tentang PPID</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Informasi Publik Terbuka</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Daftar Informasi Publik (DIP)</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>SOP Pelayanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center">
                        <span class="w-1 h-6 bg-blue-600 mr-3 rounded-full"></span>Lokasi Kami
                    </h4>
                    <div class="rounded-xl overflow-hidden h-48 shadow-2xl border border-gray-800">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.882885489838!2d112.7337!3d-7.0259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd8015337583f6f%3A0xb3387b38d3890f5d!2sBangkalan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="w-full h-full grayscale opacity-70 hover:grayscale-0 transition-all duration-700" 
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#070a12] py-6 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 text-center text-[10px] font-bold text-gray-600 tracking-[0.3em] uppercase">
                © {{ date('Y') }} PEMERINTAH KABUPATEN BANGKALAN - DISKOMINFO
            </div>
        </div>
    </footer>

    {{-- <footer class="bg-[#0b0f1a] text-white pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 text-center text-gray-400">
            <p>© {{ date('Y') }} PEMERINTAH KABUPATEN BANGKALAN - DISKOMINFO</p>
        </div>
    </footer> --}}

</body>
</html>