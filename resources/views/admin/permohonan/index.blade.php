<x-admin-panel-layout>
    <x-slot name="header">Daftar Permohonan Informasi</x-slot>

    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex justify-between items-center bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-4">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest">Daftar Permohonan</span>
            </div>
            <div class="flex items-center gap-2 mr-2">
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
                            <a href="{{ route('admin.permohonan.show', $p->id) }}" class="w-10 h-10 flex items-center justify-center bg-purple-50 text-purple-500 rounded-xl hover:bg-purple-600 hover:text-white transition-all shadow-sm" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            
                            @php 
                                $sudahDisposisi = $p->opds->count() > 0;
                                $disposisiIds = $p->opds->pluck('id')->toJson();
                            @endphp
                            @if(!$sudahDisposisi && $p->status === 'pending')
                            <button type="button" 
                                onclick="openDisposisiModal('{{ $p->id }}', '[]')"
                                class="inline-flex items-center px-4 h-10 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                DISPOSISI
                            </button>
                            @elseif($sudahDisposisi)
                            <button type="button" 
                                onclick="openDisposisiModal('{{ $p->id }}', '{{ addslashes($disposisiIds) }}')"
                                class="inline-flex items-center px-4 h-10 bg-green-50 text-green-700 text-[10px] font-bold rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                +OPD ({{ $p->opds->count() }})
                            </button>
                            @else
                            <button type="button" disabled class="inline-flex items-center px-4 h-10 bg-gray-50 text-gray-400 text-[10px] font-bold rounded-xl shadow-sm border border-gray-100 cursor-not-allowed">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                SELESAI
                            </button>
                            @endif
                            
                            <form action="{{ route('admin.permohonan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus permohonan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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

    <!-- Modal Disposisi (Multi-OPD) -->
    <div id="disposisiModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDisposisiModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="disposisiForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white px-6 pt-5 pb-4">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900" id="modal-title">Disposisi Permohonan</h3>
                                <p class="text-xs text-gray-400">Pilih satu atau lebih instansi tujuan</p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Pilih Instansi (OPD) Tujuan</label>

                            {{-- Search filter --}}
                            <input type="text" id="opdSearch" onkeyup="filterOpd()" placeholder="Cari OPD..." 
                                   class="w-full mb-3 rounded-xl border-gray-200 text-sm focus:ring-blue-500 focus:border-blue-500 p-2 bg-gray-50">

                            <div id="opdCheckboxList" class="max-h-64 overflow-y-auto space-y-1 border border-gray-100 rounded-xl p-3 bg-gray-50">
                                @foreach($opds as $opd)
                                <label class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 cursor-pointer transition opd-item" data-name="{{ strtolower($opd->nama_opd) }}" data-opd-id="{{ $opd->id }}">
                                    <input type="checkbox" name="opd_ids[]" value="{{ $opd->id }}"
                                           class="opd-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700 flex-1">{{ $opd->nama_opd }}</span>
                                    <span class="opd-badge hidden items-center gap-1 text-[10px] font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        Sudah
                                    </span>
                                </label>
                                @endforeach
                            </div>

                            <div class="mt-2 flex justify-between items-center">
                                <span class="text-xs text-gray-400" id="selectedCount">0 OPD dipilih</span>
                                <div class="flex gap-3">
                                    <button type="button" onclick="selectAllOpd()" class="text-xs text-blue-600 font-bold hover:underline">Pilih Semua</button>
                                    <span class="text-gray-200">|</span>
                                    <button type="button" onclick="deselectAllOpd()" class="text-xs text-red-500 font-bold hover:underline">Tidak Pilih Semua</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 flex flex-row-reverse gap-2 border-t border-gray-100">
                        <button type="submit" class="inline-flex justify-center rounded-xl px-5 py-2 bg-blue-600 text-sm font-bold text-white hover:bg-blue-700 transition shadow-sm">
                            Kirim Disposisi
                        </button>
                        <button type="button" onclick="closeDisposisiModal()" class="inline-flex justify-center rounded-xl border border-gray-300 px-5 py-2 bg-white text-sm font-bold text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDisposisiModal(id, disposisiIdsJson) {
            const disposisiIds = JSON.parse(disposisiIdsJson || '[]').map(Number);

            // Reset semua checkbox dan badge
            document.querySelectorAll('.opd-item').forEach(item => {
                const cb = item.querySelector('.opd-checkbox');
                const badge = item.querySelector('.opd-badge');
                const opdId = parseInt(item.dataset.opdId);

                if (disposisiIds.includes(opdId)) {
                    // Sudah terdisposisi: centang (tapi TETAP bisa diubah), tampilkan badge
                    cb.checked = true;
                    cb.disabled = false;
                    badge.classList.remove('hidden');
                    badge.classList.add('inline-flex');
                } else {
                    // Belum: reset
                    cb.checked = false;
                    cb.disabled = false;
                    badge.classList.add('hidden');
                    badge.classList.remove('inline-flex');
                }
            });

            updateSelectedCount();
            document.getElementById('opdSearch').value = '';
            filterOpd();
            document.getElementById('disposisiModal').classList.remove('hidden');
            document.getElementById('disposisiForm').action = '/admin/permohonan/' + id + '/disposisi';
        }
        function closeDisposisiModal() {
            document.getElementById('disposisiModal').classList.add('hidden');
        }
        function filterOpd() {
            const val = document.getElementById('opdSearch').value.toLowerCase();
            document.querySelectorAll('.opd-item').forEach(item => {
                item.style.display = item.dataset.name.includes(val) ? '' : 'none';
            });
        }
        function selectAllOpd() {
            document.querySelectorAll('#opdCheckboxList input[type=checkbox]').forEach(cb => cb.checked = true);
            updateSelectedCount();
        }
        function deselectAllOpd() {
            document.querySelectorAll('#opdCheckboxList input[type=checkbox]').forEach(cb => cb.checked = false);
            updateSelectedCount();
        }
        function updateSelectedCount() {
            const count = document.querySelectorAll('#opdCheckboxList input[type=checkbox]:checked').length;
            document.getElementById('selectedCount').textContent = count + ' OPD dipilih';
        }
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('#opdCheckboxList input[type=checkbox]').forEach(cb => {
                cb.addEventListener('change', updateSelectedCount);
            });
        });
    </script>
    </div>
</x-admin-panel-layout>