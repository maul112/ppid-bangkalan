<x-admin-panel-layout>
    <x-slot name="header">Daftar Regulasi</x-slot>

    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-2 md:ml-4 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Dasar Hukum & Aturan</span>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.regulasi.index') }}" method="GET" class="w-full sm:w-auto flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul/nomor..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.regulasi.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.regulasi.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    TAMBAH REGULASI
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nomor Aturan</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tentang / Judul</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Dokumen</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($regulasis as $r)
                    <tr class="hover:bg-gray-50/80 transition-all">
                        <td class="px-8 py-5">
                            <span class="text-gray-800 font-black text-sm block"># {{ $r->nomor }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-gray-600 font-bold leading-relaxed max-w-xl">{{ $r->judul }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <a href="{{ asset('uploads/regulasi/'.$r->file_pdf) }}" target="_blank" class="inline-flex items-center gap-2 text-red-600 hover:bg-red-600 hover:text-white font-bold text-[10px] border-2 border-red-600 px-4 py-2 rounded-xl transition-all uppercase tracking-widest">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Buka PDF
                            </a>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.regulasi.edit', $r->id) }}" class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-500 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('admin.regulasi.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus regulasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <p class="text-gray-400 font-black uppercase tracking-widest text-[10px]">Belum ada regulasi yang diunggah</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-100">
                {{ $regulasis->links() }}
            </div>
        </div>
    </div>
</x-admin-panel-layout>