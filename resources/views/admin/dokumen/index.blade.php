<x-admin-panel-layout title="Daftar Dokumen Publik">
    <x-slot name="header">Daftar Dokumen Publik</x-slot>
    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex justify-between items-center bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-4">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest">Manajemen Dokumen Publik</span>
            </div>
            <a href="{{ route('admin.dokumen.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-blue-100 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                TAMBAH DOKUMEN
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl font-bold border border-green-200">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul Dokumen</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tahun & Instansi</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Statistik</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($dokumens as $dokumen)
                        <tr class="hover:bg-gray-50/80 transition-all">
                            <td class="px-8 py-5">
                                @php
                                    $color = match($dokumen->kategori) {
                                        'SOP' => 'bg-indigo-100 text-indigo-600',
                                        'Dasar Hukum' => 'bg-orange-100 text-orange-600',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="{{ $color }} px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $dokumen->kategori }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-gray-800 font-bold text-base">
                                {{ $dokumen->judul }}
                                @if($dokumen->file_path)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 font-bold text-xs bg-red-50 px-2 py-1 rounded-lg transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        LIHAT PDF
                                    </a>
                                </div>
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-gray-800 font-bold">{{ $dokumen->tahun }}</p>
                                <p class="text-xs text-gray-500 font-medium">{{ $dokumen->opd->nama_opd ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-5 text-center text-xs">
                                <span class="text-blue-600 bg-blue-50 px-2 py-1 rounded-md font-bold mr-1" title="Dilihat"><i class="fa-solid fa-eye"></i> {{ $dokumen->dilihat }}</span>
                                <span class="text-green-600 bg-green-50 px-2 py-1 rounded-md font-bold" title="Didownload"><i class="fa-solid fa-download"></i> {{ $dokumen->didownload }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-500 rounded-xl hover:bg-blue-600 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada data dokumen</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-100">
                {{ $dokumens->links() }}
            </div>
        </div>
    </div>
</x-admin-panel-layout>
