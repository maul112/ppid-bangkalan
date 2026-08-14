@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PPID Kabupaten Bangkalan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <header style="background-image: url('{{ asset('img/IMG_5775.png') }}')" class="bg-center bg-no-repeat bg-contains bg-cover py-4 shadow-sm relative z-[60]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-4 hover:opacity-80 transition-opacity">
                    <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo PPID" class="h-16 w-auto">
                    <div class="h-10 w-[1px] bg-gray-200 hidden md:block"></div>
                    <div>
                        <h1 class="text-xl font-black text-blue-900 leading-none">PPID KABUPATEN</h1>
                        <p class="text-sm font-bold text-gray-500 tracking-[0.2em]">BANGKALAN</p>
                    </div>
                </a>
                <div class="hidden lg:block text-right">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">E-Mail Resmi</p>
                    <p class="text-sm font-bold text-blue-600 italic">ppid@bangkalankab.go.id</p>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-blue-700 text-white shadow-md relative z-50" x-data="{ navOpen: false }">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between lg:justify-center flex-wrap">
            
            <a href="/" class="text-xl font-bold lg:hidden">PPID Bangkalan</a>

            <!-- Mobile Toggle -->
            <button @click="navOpen = !navOpen" class="text-white lg:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Navigation Menu -->
            <ul :class="navOpen ? 'block' : 'hidden'" class="w-full lg:flex lg:space-x-4 lg:items-center lg:w-auto mt-4 lg:mt-0 text-sm font-semibold">

                <li>
                    <a href="/" class="block py-2 px-4 hover:text-yellow-300">Beranda</a>
                </li>

                <!-- Profil PPID -->
                <li class="relative group">
                    <button class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Profil PPID
                        <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-xl rounded-lg w-56 z-50 py-2 border border-gray-100">
                        <li><a href="{{ route('public.profil_ppid_tentang') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Tentang PPID</a></li>
                        <li><a href="{{ route('public.profil_ppid_tupoksi') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Tugas Pokok dan Fungsi</a></li>
                        <li><a href="{{ route('public.profil_ppid_visimisi') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Visi dan Misi</a></li>
                        <li><a href="{{ route('public.profil_ppid_strukturorganisasi') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Struktur Organisasi</a></li>
                        <li><a href="{{ route('public.profil_ppid_dasarhukum') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Dasar Hukum</a></li>
                        <li><a href="{{ route('public.profil_ppid_sop') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">SOP</a></li>
                        <li><a href="{{ route('public.profil_ppid_maklumatpelayanan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Maklumat Pelayanan</a></li>
                        <li><a href="{{ route('public.profil_ppid_alurpelayanan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Alur Pelayanan</a></li>
                        <li><a href="{{ route('public.profil_ppid_laporan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Laporan PPID</a></li>
                    </ul>
                </li>

                <!-- Pejabat PPID -->
                <li class="relative group">
                    <button class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Pejabat PPID
                        <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-xl rounded-lg w-56 z-50 max-h-96 overflow-y-auto py-2 border border-gray-100">
                        <li><a href="{{ route('public.profil_pejabat_bupati') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Profil</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'sekda') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Sekda</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'asisten') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Asisten</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'stafahli') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Staf Ahli</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'sekretaris-dprd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Sekretaris DPRD</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'inspektur') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Inspektur</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'kepala-dinas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Dinas</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'kepala-badan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Badan</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'direktur-rsud') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Direktur RSUD</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'camat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Camat</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'kepala-pelaksana-bpbd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Pelaksana BPBD</a></li>
                        <li><a href="{{ route('public.profil_pejabat', 'kepala-bagian') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Bagian</a></li>
                    </ul>
                </li>

                <!-- DIP -->
                <li class="relative group">
                    <button class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Daftar Informasi Publik
                        <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-xl rounded-lg w-64 z-50 py-2 border border-gray-100">
                        <li><a href="{{ route('public.dip_berkala') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Berkala</a></li>
                        <li><a href="{{ route('public.dip_setiapsaat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Setiap Saat</a></li>
                        <li><a href="{{ route('public.dip_sertamerta') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Serta Merta</a></li>
                        <li><a href="{{ route('public.dip_dikecualikan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <!-- Layanan Informasi -->
                <li class="relative group">
                    <button class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Layanan Informasi Publik
                        <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-xl rounded-lg w-56 z-50 py-2 border border-gray-100">
                        <li><a href="https://www.lapor.go.id/" target="_blank" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">SP4N LAPOR!</a></li>
                        <li><a href="{{ route('public.layanan_berita') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Berita PPID</a></li>
                        <li><a href="{{ route('public.lhkpn') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">LHKPN</a></li>
                        <li><a href="{{ route('public.layanan_permohonan_informasi') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Permohonan Informasi</a></li>
                        <li><a href="{{ route('public.layanan_formulir_keberatan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Formulir Keberatan</a></li>
                        <li><a href="{{ route('public.layanan_agenda') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Agenda PPID</a></li>
                    </ul>
                </li>

                <!-- Transparansi -->
                <li>
                    <a href="{{ route('public.transparansi_pemkab') }}" class="block py-2 px-4 hover:text-yellow-300">Transparansi Pemkabbb</a>
                </li>

                <!-- PPID Pelaksana -->
                <li class="relative group">
                    <button class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        PPID Pelaksana
                        <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul class="absolute hidden group-hover:block right-0 bg-white text-gray-800 shadow-xl rounded-lg w-56 z-50 py-2 border border-gray-100">
                        <li><a href="{{ route('public.ppidpelaksana_badan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Badan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_bagian') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Bagian</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_inspektorat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Inspektorat</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_setwan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Sekretariat DPRD</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_dinas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Dinas</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_kecamatan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kecamatan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_kelurahan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kelurahan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_rsud') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">RSUD</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_puskesmas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Puskesmas</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_bumd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">BUMD</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        {{ $slot }}
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
