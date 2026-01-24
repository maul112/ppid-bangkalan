<x-admin-panel-layout>
    <x-slot name="header">Daftar Informasi Publik (DIP)</x-slot>

    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex justify-between items-center bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-4">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest">Manajemen Dokumen</span>
            </div>
            <a href="{{ route('admin.dip.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-blue-100 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                TAMBAH DIP
            </a>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul Informasi</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">File Dokumen</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($dips as $d)
                    <tr class="hover:bg-gray-50/80 transition-all">
                        <td class="px-8 py-5">
                            @php
                                $color = match($d->kategori) {
                                    'Informasi Berkala' => 'bg-purple-100 text-purple-600',
                                    'Informasi Serta Merta' => 'bg-orange-100 text-orange-600',
                                    'Informasi Setiap Saat' => 'bg-blue-100 text-blue-600',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp
                            <span class="{{ $color }} px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $d->kategori }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-gray-800 font-bold text-base">
                            {{ $d->judul }}
                        </td>
                        <td class="px-8 py-5">
                            @if($d->file_pdf)
                                <a href="{{ asset('uploads/dip/'.$d->file_pdf) }}" target="_blank" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 font-bold text-sm bg-red-50 px-3 py-2 rounded-xl transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    LIHAT PDF
                                </a>
                            @else
                                <span class="text-gray-300 italic text-sm">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center">
                                <form action="{{ route('admin.dip.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Hapus DIP ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Data DIP belum tersedia</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-panel-layout>