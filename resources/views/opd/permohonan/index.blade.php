<x-opd-panel-layout title="Daftar Permohonan - OPD Bangkalan">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Laporan Permohonan</h2>
            <p class="text-gray-500 font-medium">OPD Kabupaten Bangkalan</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ Auth::user()->opd->nama_opd ?? 'Admin OPD' }}</p>
            </div>
            <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center border border-gray-200 shadow-sm font-bold text-gray-700 uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </header>

    <div class="flex items-center gap-2 mb-8">
        <form action="{{ route('admin.opd.permohonan.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama, NIK atau tiket..." 
                   class="w-64 rounded-xl border-gray-200 text-sm focus:ring-red-500 focus:border-red-500 shadow-sm">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-800 transition shadow-md">
                CARI
            </button>
            @if(request('search'))
                <a href="{{ route('admin.opd.permohonan.index') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-300 transition flex items-center">
                    RESET
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-black text-gray-500 uppercase tracking-widest">
                    <th class="p-5">Nomor Tiket</th>
                    <th class="p-5">Nama Pemohon</th>
                    <th class="p-5">Sisa Waktu</th>
                    <th class="p-5">Status</th>
                    <th class="p-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($permohonans as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-5">
                        <span class="font-mono text-red-600 font-bold bg-red-50 px-3 py-1 rounded-lg text-sm">{{ $p->nomor_tiket }}</span>
                    </td>
                    <td class="p-5">
                        <div class="font-bold text-gray-800 text-sm">{{ $p->nama_pemohon }}</div>
                        <div class="text-xs text-gray-400 italic">NIK: {{ $p->nik ?? '-' }}</div>
                    </td>
                    <td class="p-5">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter shadow-sm
                            {{ $p->sisa_waktu <= 3 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ $p->sisa_waktu }} Hari
                        </span>
                    </td>
                    <td class="p-5">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter shadow-sm
                            {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $p->status == 'diverifikasi' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $p->status == 'selesai' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $p->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="p-5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.opd.permohonan.show', $p->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-bold rounded-xl hover:bg-red-600 transition shadow-sm">
                                DETAIL & TANGGAPI
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-20 text-center">
                        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-400 font-medium italic">Data tidak ditemukan atau belum ada laporan masuk.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-5 border-t border-gray-100">
            {{ $permohonans->appends(request()->query())->links() }}
        </div>
    </div>
</x-opd-panel-layout>
