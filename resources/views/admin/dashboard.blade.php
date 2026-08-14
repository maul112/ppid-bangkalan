<x-admin-panel-layout>
    <x-slot name="header">Dashboard Administrator</x-slot>

    <div class="bg-gray-900 rounded-[2rem] p-10 mb-10 shadow-2xl relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-3xl font-bold text-white mb-3">Selamat Datang kembali, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-400 max-w-2xl text-lg leading-relaxed">Akses penuh pengelolaan informasi publik. Pastikan semua permohonan segera diverifikasi untuk menjaga kualitas layanan.</p>
        </div>
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-red-600 opacity-20 rounded-full blur-3xl"></div>
    </div>

    <!-- Statistik Ringkasan -->
    <div class="mb-8">
        <h4 class="text-xl font-bold text-gray-800 mb-4 px-2">Ringkasan Sistem</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Permohonan -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Permohonan</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_permohonan'] ?? 0 }}</h3>
                </div>
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-signature text-2xl"></i>
                </div>
            </div>

            <!-- Permohonan Menunggu -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Menunggu Review</p>
                    <h3 class="text-3xl font-black text-orange-600">{{ $stats['pending_permohonan'] ?? 0 }}</h3>
                </div>
                <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>

            <!-- Total Berita -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Berita Dipublikasi</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_berita'] ?? 0 }}</h3>
                </div>
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            </div>

            <!-- Total Dokumen -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Dokumen Tersedia</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_dokumen'] ?? 0 }}</h3>
                </div>
                <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-folder-open text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pintasan Cepat -->
    <div class="mb-4 px-2">
        <h4 class="text-xl font-bold text-gray-800">Pintasan Cepat</h4>
        <p class="text-gray-500 text-sm">Akses cepat ke seluruh modul manajemen PPID.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Permohonan Informasi -->
        <a href="{{ route('admin.permohonan.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block relative overflow-hidden">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-envelope-open-text text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Permohonan</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola tiket permohonan informasi.</p>
        </a>

        <!-- Berita -->
        <a href="{{ route('admin.berita.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-newspaper text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Berita</h4>
            <p class="text-gray-500 text-sm mt-1">Publikasikan kegiatan terbaru.</p>
        </a>

        <!-- Dokumen PPID -->
        <a href="{{ route('admin.dokumen.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-folder-open text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Dokumen PPID</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola SOP, Laporan & Dasar Hukum.</p>
        </a>

        <!-- PPID Pelaksana -->
        <a href="{{ route('admin.ppid_pelaksana.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-building text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">PPID Pelaksana</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola data instansi, dinas & kecamatan.</p>
        </a>

        <!-- Pejabat -->
        <a href="{{ route('admin.pejabat.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-user-tie text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Pejabat</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola profil pimpinan & pejabat.</p>
        </a>

        <!-- LHKPN -->
        <a href="{{ route('admin.lhkpn.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-file-invoice-dollar text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">LHKPN</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola laporan harta kekayaan.</p>
        </a>

        <!-- DIP -->
        <a href="{{ route('admin.dip.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-list-ul text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">DIP</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola Daftar Informasi Publik.</p>
        </a>


        <!-- Agenda -->
        <a href="{{ route('admin.agenda.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-calendar-alt text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Agenda</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola jadwal & acara pemkab.</p>
        </a>

        <!-- Struktur Organisasi -->
        <a href="{{ route('admin.struktur-organisasi.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-sitemap text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Struktur</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola bagan struktur organisasi.</p>
        </a>

        <!-- Banner -->
        <a href="{{ route('admin.banner.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-gray-50 text-gray-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-images text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Banner</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola gambar promosi & slider.</p>
        </a>

        <!-- Hari Libur -->
        <a href="{{ route('admin.hari-libur.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <i class="fas fa-calendar-times text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Hari Libur</h4>
            <p class="text-gray-500 text-sm mt-1">Pengaturan operasional layanan.</p>
        </a>
    </div>
</x-admin-panel-layout>










































