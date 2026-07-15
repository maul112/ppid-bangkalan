<x-admin-panel-layout>
    <x-slot name="header">Daftar Dokumen LHKPN</x-slot>

    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-2 md:ml-4 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Manajemen LHKPN</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.lhkpn.index') }}" method="GET" class="w-full sm:w-auto flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tahun/nama pejabat..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.lhkpn.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.lhkpn.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    TAMBAH LHKPN
                </a>
            </div>
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
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nama Pejabat</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tahun Pelaporan</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">File Dokumen</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($lhkpns as $lhkpn)
                        <tr class="hover:bg-gray-50/80 transition-all">
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-gray-800">{{ $lhkpn->pejabat->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $lhkpn->pejabat->jabatan }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $lhkpn->tahun }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                @if($lhkpn->file_path)
                                    <a href="{{ asset('uploads/lhkpn/'.$lhkpn->file_path) }}" target="_blank" class="flex items-center gap-2 text-red-500 hover:text-red-700 font-bold text-sm bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl w-max transition">
                                        <i class="fa-solid fa-file-pdf"></i> Lihat PDF
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm italic">Belum ada file</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.lhkpn.edit', $lhkpn->id) }}" class="w-10 h-10 flex items-center justify-center bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white rounded-xl transition-all shadow-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.lhkpn.destroy', $lhkpn->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus LHKPN ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-folder-open text-3xl text-gray-300"></i>
                                    </div>
                                    <p class="text-gray-500 font-bold">Belum ada LHKPN</p>
                                    <p class="text-sm text-gray-400 mt-1">Silakan tambah data dokumen LHKPN baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($lhkpns->hasPages())
            <div class="mt-6">
                {{ $lhkpns->links() }}
            </div>
        @endif
    </div>
</x-admin-panel-layout>
