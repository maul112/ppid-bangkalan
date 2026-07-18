<x-admin-panel-layout>
    <x-slot name="header">Kelola Agenda</x-slot>

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
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Daftar Agenda</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.agenda.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-2">
                    <select name="status" class="w-full sm:w-auto border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 pl-4 pr-10 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all cursor-pointer" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach(['Hari Ini', 'Mendatang', 'Lewat'] as $stat)
                            <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>{{ $stat }}</option>
                        @endforeach
                    </select>
                    
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul/lokasi..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.agenda.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center justify-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.agenda.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    TAMBAH AGENDA
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tanggal</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Lokasi</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($agendas as $agenda)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-6 align-top">
                                    <div class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}</div>
                                    <div class="text-xs text-gray-500 font-medium mt-1">{{ $agenda->waktu ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-6 align-top">
                                    <div class="font-bold text-gray-900 text-sm mb-1 line-clamp-2">{{ $agenda->judul }}</div>
                                </td>
                                <td class="px-8 py-6 align-top">
                                    <span class="text-sm text-gray-700 font-medium">{{ $agenda->lokasi }}</span>
                                </td>
                                <td class="px-8 py-6 align-top text-center">
                                    @if($agenda->status == 'Hari Ini')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-green-100 text-green-700 uppercase tracking-wider">
                                            Hari Ini
                                        </span>
                                    @elseif($agenda->status == 'Mendatang')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-700 uppercase tracking-wider">
                                            Mendatang
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-gray-100 text-gray-600 uppercase tracking-wider">
                                            Lewat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 align-top">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
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
                                        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-sm font-bold uppercase tracking-widest mb-1">Belum Ada Agenda</p>
                                        <p class="text-xs font-medium">Silakan tambahkan data agenda baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($agendas->hasPages())
                <div class="p-6 border-t border-gray-100">
                    {{ $agendas->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-panel-layout>
