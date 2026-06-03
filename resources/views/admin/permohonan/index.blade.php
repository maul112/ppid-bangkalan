<x-admin-panel-layout>
    <x-slot name="header">Daftar Permohonan Informasi</x-slot>

    <div class="flex items-center gap-2 mb-8">
        <form action="{{ route('admin.permohonan.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama, NIK atau tiket..." 
                   class="w-64 rounded-xl border-gray-200 text-sm focus:ring-red-500 focus:border-red-500 shadow-sm">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-800 transition shadow-md">
                CARI
            </button>
            @if(request('search'))
                <a href="{{ route('admin.permohonan.index') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-300 transition flex items-center">
                    RESET
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm text-sm font-bold">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-black text-gray-500 uppercase tracking-widest">
                    <th class="p-5">Nomor Tiket</th>
                    <th class="p-5">Nama Pemohon</th>
                    <th class="p-5">Status</th>
                    <th class="p-5">Tanggal</th>
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
                            {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $p->status == 'diverifikasi' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $p->status == 'selesai' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $p->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="p-5 text-gray-600 text-sm">
                        {{ $p->created_at->format('d/m/Y') }}
                    </td>
                    <td class="p-5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.permohonan.show', $p->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-bold rounded-xl hover:bg-red-600 transition shadow-sm">
                                DETAIL
                            </a>
                            
                            @if($p->opd_id === null && $p->status === 'pending')
                            <button type="button" onclick="openDisposisiModal('{{ $p->id }}')" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm border border-blue-100">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                DISPOSISI
                            </button>
                            @else
                            <button type="button" disabled class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-400 text-[10px] font-bold rounded-xl shadow-sm border border-gray-100 cursor-not-allowed">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                DIDISPOSISI
                            </button>
                            @endif
                            
                            <form action="{{ route('admin.permohonan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus permohonan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 text-[10px] font-bold rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-20 text-center">
                        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-400 font-medium italic">Data tidak ditemukan atau belum ada permohonan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="p-5 border-t border-gray-100">
            {{ $permohonans->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Modal Disposisi -->
    <div id="disposisiModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDisposisiModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="disposisiForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    Disposisi Permohonan
                                </h3>
                                <div class="mt-4">
                                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Pilih Instansi (OPD) Tujuan</label>
                                    <select name="opd_id" required class="w-full rounded-2xl border-gray-200 focus:border-blue-600 focus:ring-0 p-3 text-sm font-bold bg-gray-50">
                                        <option value="">-- Pilih OPD --</option>
                                        @foreach($opds as $opd)
                                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-bold text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-all">
                            Kirim Disposisi
                        </button>
                        <button type="button" onclick="closeDisposisiModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDisposisiModal(id) {
            document.getElementById('disposisiModal').classList.remove('hidden');
            document.getElementById('disposisiForm').action = '/admin/permohonan/' + id + '/disposisi';
        }
        function closeDisposisiModal() {
            document.getElementById('disposisiModal').classList.add('hidden');
        }
    </script>
</x-admin-panel-layout>