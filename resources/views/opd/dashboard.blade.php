<x-opd-panel-layout>
    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Dashboard Administrator</h2>
            <p class="text-gray-500 font-medium">OPD Kabupaten Bangkalan</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ Auth::user()->opd->nama_opd ?? 'Admin OPD' }}</p>
            </div>
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
        <a href="{{ route('admin.opd.permohonan.index') }}" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group block">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800">Tabel Laporan</h4>
            <p class="text-gray-500 text-sm mt-1">Kelola permohonan masuk ke instansi.</p>
        </a>
    </div>
</x-opd-panel-layout>