<x-admin-panel-layout>
    <x-slot name="header">Kelola Pejabat PPID</x-slot>

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
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Daftar Pejabat</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.pejabat.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-2">
                    <select name="kategori" class="w-full sm:w-auto border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 pl-4 pr-10 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all cursor-pointer" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach(['Bupati', 'Wakilbupati', 'Sekda', 'Asisten', 'Staf Ahli', 'Sekretaris DPRD', 'Inspektur', 'Kepala Dinas', 'Kepala Badan', 'Direktur RSUD', 'Camat', 'Kepala Pelaksana BPBD', 'Kepala Bagian'] as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/jabatan..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.pejabat.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center justify-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.pejabat.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    TAMBAH PEJABAT
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Foto</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Profil Pejabat</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori & Jabatan</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pejabats as $p)
                    <tr class="hover:bg-gray-50/80 transition-all">
                        <td class="px-8 py-5">
                            @if($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}" class="w-16 h-16 object-cover rounded-full shadow-sm ring-2 ring-gray-100">
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-[10px] text-gray-400 font-bold uppercase">No Image</div>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <span class="font-bold text-gray-800 text-lg block leading-tight">{{ $p->nama }}</span>
                            <span class="text-xs text-gray-500 mt-1 block">NIP: {{ $p->nip ?? '-' }} | Gol: {{ $p->golongan ?? '-' }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ $p->kategori_pejabat }}</span>
                            <span class="block text-sm text-gray-600 mt-2">{{ $p->jabatan_keterangan }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            @if($p->is_active)
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                @if(in_array($p->kategori_pejabat, ['Bupati', 'Wakil Bupati', 'Sekda', 'Asisten', 'Staf Ahli']))
                                <a href="{{ route('admin.lhkpn.create', ['pejabat_id' => $p->id]) }}" title="Tambah LHKPN" class="w-10 h-10 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </a>
                                @endif
                                <a href="{{ route('admin.pejabat.edit', $p->id) }}" title="Edit Pejabat" class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pejabat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Hapus Pejabat" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="w-20 h-20 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada pejabat yang ditambahkan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-panel-layout>
