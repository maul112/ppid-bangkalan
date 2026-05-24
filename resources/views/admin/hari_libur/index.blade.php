<x-admin-panel-layout>
    <x-slot name="header">Master Hari Libur</x-slot>

    <div class="flex justify-end items-center mb-6">
        <a href="{{ route('admin.hari-libur.create') }}" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl font-bold tracking-widest text-[10px] uppercase shadow-md hover:bg-red-600 transition-all">+ Tambah Libur</a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-3xl overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-black text-gray-500 uppercase tracking-widest">
                    <th class="p-5">Tanggal</th>
                    <th class="p-5">Keterangan</th>
                    <th class="p-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($hariLiburs as $libur)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-5">
                        <span class="font-bold text-gray-800 text-sm">{{ \Carbon\Carbon::parse($libur->tanggal)->translatedFormat('d F Y') }}</span>
                    </td>
                    <td class="p-5">
                        <span class="text-gray-600 text-sm">{{ $libur->keterangan }}</span>
                    </td>
                    <td class="p-5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.hari-libur.edit', $libur->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-bold rounded-xl hover:bg-blue-600 transition shadow-sm">
                                EDIT
                            </a>
                            <form action="{{ route('admin.hari-libur.destroy', $libur->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 text-[10px] font-bold rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($hariLiburs->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="text-gray-400 font-medium italic">Belum ada hari libur yang ditambahkan.</p>
            </div>
        @endif
        <div class="p-5 border-t border-gray-100">
            {{ $hariLiburs->links() }}
        </div>
    </div>
</x-admin-panel-layout>
