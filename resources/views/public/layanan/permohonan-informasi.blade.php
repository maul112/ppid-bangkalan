@extends('layouts.publik')

@section('content')
    <x-public-header title="Layanan Permohonan Informasi" subtitle="Layanan" />

    <div class="max-w-7xl mx-auto pb-16 pt-8 px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <p class="text-gray-500 text-lg font-medium">Ajukan permohonan informasi publik secara online atau pantau status permohonan yang telah diajukan.</p>
        </div>

        {{-- Call to Action: Ajukan Permohonan --}}
        <div class="flex justify-center mb-12">
            <a href="{{ route('permohonan.buat') }}" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-lg hover:bg-blue-700 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 flex items-center gap-3">
                <i class="fa-solid fa-paper-plane"></i> AJUKAN PERMOHONAN SEKARANG
            </a>
        </div>

        {{-- Statistik Permohonan --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-12">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-file-lines text-xl"></i>
                </div>
                <h4 class="text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Total Permohonan</h4>
                <p class="text-3xl font-black text-gray-800">{{ $total_permohonan }}</p>
            </div>
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                </div>
                <h4 class="text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Sedang Diproses</h4>
                <p class="text-3xl font-black text-gray-800">{{ $diproses }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-check-double text-xl"></i>
                </div>
                <h4 class="text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Selesai / Diterima</h4>
                <p class="text-3xl font-black text-gray-800">{{ $selesai }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-ban text-xl"></i>
                </div>
                <h4 class="text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Ditolak</h4>
                <p class="text-3xl font-black text-gray-800">{{ $ditolak }}</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            
            {{-- Notifikasi Jika NIK Salah --}}
            @if(session('error'))
            <div class="mb-6 flex items-center p-4 text-red-800 border-t-4 border-red-500 bg-red-50 shadow-md rounded-b-lg animate-pulse" role="alert">
                <i class="fa-solid fa-triangle-exclamation mr-3 text-xl"></i>
                <div class="text-sm font-bold">
                    PERHATIAN: {{ session('error') }}
                </div>
                <button type="button" class="ml-auto bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex h-8 w-8 items-center justify-center" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                
                {{-- Filter & Search Header --}}
                <div class="p-6 border-b border-gray-100 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 tracking-tight">Arsip Permohonan</h3>
                            <p class="text-[10px] md:text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Daftar transparansi permohonan informasi</p>
                        </div>
                    </div>
                    
                    <div class="relative w-full md:w-80">
                        <input type="text" id="searchInput" value="{{ request('search') }}" 
                            placeholder="Cari nama pemohon atau register..." 
                            class="w-full bg-gray-50 border-gray-200 rounded-2xl pl-4 pr-10 py-3 text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium text-gray-700">
                        
                        <div id="loadingIndicator" class="hidden absolute right-10 top-3">
                            <i class="fa-solid fa-circle-notch fa-spin text-blue-500 text-sm"></i>
                        </div>
                        <i class="fa-solid fa-magnifying-glass absolute right-4 top-4 text-gray-400"></i>
                    </div>
                </div>

                {{-- Table Data --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-600 text-white uppercase text-[11px] font-black tracking-widest">
                                <th class="px-6 py-5 text-center">No</th>
                                <th class="px-6 py-5">Register</th>
                                <th class="px-6 py-5">Tanggal</th>
                                <th class="px-6 py-5">Nama Pemohon</th>
                                <th class="px-6 py-5">Perihal</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5">Keterangan</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableData" class="divide-y divide-gray-100 bg-white text-sm">
                            @include('permohonan.partials.daftar_publik_table')
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div id="paginationLinks" class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $permohonans->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NIK --}}
    <div id="nikModal" class="fixed inset-0 bg-gray-900/60 hidden items-center justify-center z-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 mx-4 transform transition-all">
            <div class="text-center mb-6">
                <div class="bg-blue-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-sm">
                    <i class="fa-solid fa-shield-halved text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 tracking-tight">Verifikasi Privasi</h3>
                <p class="text-sm text-gray-500 mt-2 font-medium">Masukkan NIK untuk melihat detail informasi.</p>
            </div>

            <form id="nikForm" action="{{ route('permohonan.cek') }}" method="POST">
                @csrf
                <input type="hidden" name="nomor_tiket" id="modal_nomor_tiket">
                
                <div class="mb-6">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">NIK Pemohon</label>
                    <input type="number" name="nik" required 
                        placeholder="16 Digit NIK" 
                        class="w-full bg-gray-50 border-gray-200 rounded-2xl px-4 py-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-center tracking-widest font-black text-gray-700 shadow-inner">
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl flex items-center justify-center gap-2 shadow-lg shadow-blue-200 transition-all active:scale-95">
                        <i class="fa-solid fa-unlock-keyhole"></i> BUKA DETAIL DATA
                    </button>
                    <button type="button" onclick="closeNikModal()" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-500 font-bold py-4 rounded-2xl transition-all">
                        Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Control
        function openNikModal(nomorTiket) {
            document.getElementById('modal_nomor_tiket').value = nomorTiket;
            const modal = document.getElementById('nikModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeNikModal() {
            const modal = document.getElementById('nikModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Live Search AJAX
        const searchInput = document.getElementById('searchInput');
        const tableData = document.getElementById('tableData');
        const paginationLinks = document.getElementById('paginationLinks');
        const loader = document.getElementById('loadingIndicator');

        searchInput.addEventListener('input', function() {
            const query = this.value;
            loader.classList.remove('hidden');

            fetch(`{{ route('public.layanan_permohonan_informasi') }}?search=${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                tableData.innerHTML = data.html;
                paginationLinks.innerHTML = data.pagination;
                loader.classList.add('hidden');
            })
            .catch(err => {
                console.error('Search error:', err);
                loader.classList.add('hidden');
            });
        });

        window.onclick = function(event) {
            const modal = document.getElementById('nikModal');
            if (event.target == modal) {
                closeNikModal();
            }
        }
    </script>
@endsection