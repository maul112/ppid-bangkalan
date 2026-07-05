<x-admin-panel-layout>
    <x-slot name="header">Dashboard Administrator</x-slot>

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
</x-admin-panel-layout>










































