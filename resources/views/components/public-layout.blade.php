<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PPID Bangkalan') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
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
    <!-- Navbar Replikasi (Isi Sesuai Jember) -->
    <nav class="bg-blue-700 text-white shadow-md relative z-50" x-data="{ navOpen: false, dropdownProfilOpen: false, dropdownPejabatOpen: false, dropdownDIPOpen: false, dropdownLayananOpen: false, dropdownPelaksanaOpen: false, dropdownLoginOpen: false }">
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
                <li class="relative" @mouseenter="dropdownProfilOpen = true" @mouseleave="dropdownProfilOpen = false">
                    <button @click="dropdownProfilOpen = !dropdownProfilOpen" class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Profil PPID
                        <svg class="ml-1 w-4 h-4 transform transition-transform" :class="dropdownProfilOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul x-show="dropdownProfilOpen" x-transition class="absolute bg-white text-gray-800 shadow-xl rounded-lg mt-1 w-56 z-50 py-2 border border-gray-100" @click.away="dropdownProfilOpen = false" x-cloak>
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
                <li class="relative" @mouseenter="dropdownPejabatOpen = true" @mouseleave="dropdownPejabatOpen = false">
                    <button @click="dropdownPejabatOpen = !dropdownPejabatOpen" class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Pejabat PPID
                        <svg class="ml-1 w-4 h-4 transform transition-transform" :class="dropdownPejabatOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul x-show="dropdownPejabatOpen" x-transition class="absolute bg-white text-gray-800 shadow-xl rounded-lg mt-1 w-56 z-50 max-h-96 overflow-y-auto py-2 border border-gray-100" @click.away="dropdownPejabatOpen = false" x-cloak>
                        <li><a href="{{ route('public.profil_pejabat_bupati') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Bupati</a></li>
                        <li><a href="{{ route('public.profil_pejabat_wakilbupati') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Wakil Bupati</a></li>
                        <li><a href="{{ route('public.profil_pejabat_sekda') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Sekda</a></li>
                        <li><a href="{{ route('public.profil_pejabat_asisten') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Asisten</a></li>
                        <li><a href="{{ route('public.profil_pejabat_stafahli') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Staf Ahli</a></li>
                        <li><a href="{{ route('public.profil_pejabat_inspektur') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Inspektur</a></li>
                        <li><a href="{{ route('public.profil_pejabat_kepalabadan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Badan</a></li>
                        <li><a href="{{ route('public.profil_pejabat_kepaladinas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Dinas</a></li>
                        <li><a href="{{ route('public.profil_pejabat_kepalabagian') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Bagian</a></li>
                        <li><a href="{{ route('public.profil_pejabat_kepalapuskesmas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kepala Puskesmas</a></li>
                        <li><a href="{{ route('public.profil_pejabat_camat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Camat</a></li>
                        <li><a href="{{ route('public.profil_pejabat_lurah') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Lurah</a></li>
                        <li><a href="{{ route('public.profil_pejabat_direkturrsd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Direktur RSD</a></li>
                        <li><a href="{{ route('public.profil_pejabat_direkturbumd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Direktur BUMD</a></li>
                    </ul>
                </li>

                <!-- DIP -->
                <li class="relative" @mouseenter="dropdownDIPOpen = true" @mouseleave="dropdownDIPOpen = false">
                    <button @click="dropdownDIPOpen = !dropdownDIPOpen" class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Daftar Informasi Publik
                        <svg class="ml-1 w-4 h-4 transform transition-transform" :class="dropdownDIPOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul x-show="dropdownDIPOpen" x-transition class="absolute bg-white text-gray-800 shadow-xl rounded-lg mt-1 w-64 z-50 py-2 border border-gray-100" @click.away="dropdownDIPOpen = false" x-cloak>
                        <li><a href="{{ route('public.dip_berkala') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Berkala</a></li>
                        <li><a href="{{ route('public.dip_setiapsaat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Setiap Saat</a></li>
                        <li><a href="{{ route('public.dip_sertamerta') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Serta Merta</a></li>
                        <li><a href="{{ route('public.dip_dikecualikan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <!-- Layanan Informasi -->
                <li class="relative" @mouseenter="dropdownLayananOpen = true" @mouseleave="dropdownLayananOpen = false">
                    <button @click="dropdownLayananOpen = !dropdownLayananOpen" class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        Layanan Informasi Publik
                        <svg class="ml-1 w-4 h-4 transform transition-transform" :class="dropdownLayananOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul x-show="dropdownLayananOpen" x-transition class="absolute bg-white text-gray-800 shadow-xl rounded-lg mt-1 w-56 z-50 py-2 border border-gray-100" @click.away="dropdownLayananOpen = false" x-cloak>
                        <li><a href="https://www.lapor.go.id/" target="_blank" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">SP4N LAPOR!</a></li>
                        <li><a href="{{ route('public.layanan_berita') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Daftar Berita PPID</a></li>
                        <li><a href="https://elhkpn.kpk.go.id/portal/user/login" target="_blank" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">LHKPN</a></li>
                        <li><a href="{{ route('public.layanan_permohonan_informasi') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Permohonan Informasi</a></li>
                        <li><a href="{{ route('public.layanan_formulir_keberatan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Formulir Keberatan</a></li>
                        <li><a href="{{ route('public.layanan_agenda_bulanan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Agenda Bulanan</a></li>
                        <li><a href="{{ route('public.layanan_agenda_tahunan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Agenda Tahunan</a></li>
                    </ul>
                </li>

                <!-- Transparansi -->
                <li>
                    <a href="{{ route('public.transparansi_pemkab') }}" class="block py-2 px-4 hover:text-yellow-300">Transparansi Pemkab</a>
                </li>

                <!-- PPID Pelaksana -->
                <li class="relative" @mouseenter="dropdownPelaksanaOpen = true" @mouseleave="dropdownPelaksanaOpen = false">
                    <button @click="dropdownPelaksanaOpen = !dropdownPelaksanaOpen" class="flex items-center w-full py-2 px-4 hover:text-yellow-300 focus:outline-none">
                        PPID Pelaksana
                        <svg class="ml-1 w-4 h-4 transform transition-transform" :class="dropdownPelaksanaOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </button>
                    <ul x-show="dropdownPelaksanaOpen" x-transition class="absolute right-0 bg-white text-gray-800 shadow-xl rounded-lg mt-1 w-56 z-50 py-2 border border-gray-100" @click.away="dropdownPelaksanaOpen = false" x-cloak>
                        <li><a href="{{ route('public.ppidpelaksana_badan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Badan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_bagian') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Bagian</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_inspektorat') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Inspektorat</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_setwan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Sekretariat DPRD</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_dinas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Dinas</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_kecamatan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kecamatan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_kelurahan') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Kelurahan</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_rsd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">RSD</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_puskesmas') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">Puskesmas</a></li>
                        <li><a href="{{ route('public.ppidpelaksana_bumd') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700">BUMD</a></li>
                    </ul>
                </li>

                <!-- Login Dropdown -->
                <li class="relative" @mouseenter="dropdownLoginOpen = true" @mouseleave="dropdownLoginOpen = false">
                    <button @click="dropdownLoginOpen = !dropdownLoginOpen" class="bg-yellow-400 text-blue-900 px-6 py-1.5 rounded text-xs font-black hover:bg-yellow-500 transition shadow-sm flex items-center focus:outline-none">
                        MASUK <i class="fa-solid fa-right-to-bracket ml-2"></i>
                    </button>
                    <ul x-show="dropdownLoginOpen" x-transition class="absolute right-0 bg-white text-gray-800 shadow-xl rounded-md mt-1 w-48 z-50 py-2 border-t-4 border-yellow-500 text-left" @click.away="dropdownLoginOpen = false" x-cloak>
                        <li><p class="px-4 py-1 text-[9px] font-bold text-gray-400 uppercase tracking-widest">Login Internal</p></li>
                        <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold">Admin PPID</a></li>
                        <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold border-t border-gray-50">Admin OPD</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>
    
    <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-12 text-sm">
        <p>&copy; {{ date('Y') }} PPID Bangkalan. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
