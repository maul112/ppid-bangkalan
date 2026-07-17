<x-admin-panel-layout>
    <x-slot name="header">Kelola PPID Pelaksana</x-slot>

    <div class="space-y-6">
        {{-- Alert Success --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <p class="text-green-700 font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Action Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-2 md:ml-4 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Daftar Instansi</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.ppid_pelaksana.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-2">
                    <select name="kategori" class="w-full sm:w-auto border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 pl-4 pr-10 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all cursor-pointer" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach(['Badan', 'Bagian', 'Inspektorat', 'Sekretariat DPRD', 'Dinas', 'Camat', 'Lurah', 'Direktur RSUD', 'Kepala Puskesmas', 'Direktur'] as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari instansi..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center justify-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.ppid_pelaksana.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center justify-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.ppid_pelaksana.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    TAMBAH INSTANSI
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">No</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nama Instansi</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Pimpinan</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($ppidPelaksanas as $index => $ppid)
                            <tr class="hover:bg-red-50/30 transition-colors group">
                                <td class="px-8 py-4 text-center">
                                    <span class="text-sm font-bold text-gray-500">{{ $ppidPelaksanas->firstItem() + $index }}</span>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                        {{ $ppid->kategori }}
                                    </span>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $ppid->pejabat->instansi ?? '-' }}</div>
                                    <div class="text-xs font-medium text-gray-500 mt-0.5 truncate max-w-[200px]" title="{{ $ppid->alamat }}">{{ $ppid->alamat }}</div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="text-sm font-bold text-gray-700">{{ $ppid->pejabat->nama ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.ppid_pelaksana.edit', $ppid->id) }}" class="w-10 h-10 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-500 hover:text-white transition-all shadow-sm" title="Edit Profil & Dokumen">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.ppid_pelaksana.destroy', $ppid->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-base font-bold text-gray-500">Belum Ada Data Instansi</p>
                                        <p class="text-sm">Silakan tambahkan data instansi PPID Pelaksana baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($ppidPelaksanas->hasPages())
                <div class="bg-gray-50/50 border-t border-gray-100 px-8 py-5">
                    {{ $ppidPelaksanas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-panel-layout>
