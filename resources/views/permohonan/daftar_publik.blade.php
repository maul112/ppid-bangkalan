@extends('layouts.publik')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Daftar Permohonan Publik</h1>
            <div class="mt-4 mx-auto h-1 w-20 bg-blue-600 rounded-full"></div>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Arsip data transparansi permohonan informasi publik Pemerintah Kabupaten Bangkalan.</p>
        </div>

        <div class="max-w-6xl mx-auto">
            
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                
                {{-- Filter & Search Header --}}
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-blue-900 uppercase italic leading-none">Arsip Permohonan</h3>
                        <p class="text-[10px] md:text-xs text-gray-500 font-medium mt-1">Data transparansi permohonan informasi Kabupaten Bangkalan</p>
                    </div>
                    
                    <div class="relative w-full md:w-80">
                        <input type="text" id="searchInput" value="{{ request('search') }}" 
                            placeholder="Cari nama atau nomor tiket..." 
                            class="w-full border-gray-300 rounded-full pl-4 pr-10 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all">
                        
                        <div id="loadingIndicator" class="hidden absolute right-10 top-2.5">
                            <i class="fa-solid fa-circle-notch fa-spin text-blue-500 text-sm"></i>
                        </div>
                        <i class="fa-solid fa-magnifying-glass absolute right-4 top-3 text-gray-400"></i>
                    </div>
                </div>

                {{-- Table Data --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2B7FFF] text-white uppercase text-[11px] font-black tracking-wider">
                                <th class="px-6 py-4 text-center">No</th>
                                <th class="px-6 py-4">No. Register</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Pemohon</th>
                                {{-- Kolom Tujuan (OPD) telah dihapus --}}
                                <th class="px-6 py-4">Perihal</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableData" class="divide-y divide-gray-100 bg-white text-sm">
                            @include('permohonan.partials.daftar_publik_table')
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div id="paginationLinks" class="p-6 bg-white border-t border-gray-100">
                    {{ $permohonans->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NIK --}}
    <div id="nikModal" class="fixed inset-0 bg-gray-900/60 hidden items-center justify-center z-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 mx-4 transform transition-all">
            <div class="text-center mb-6">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-shield-halved text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-800">Verifikasi Kepemilikan</h3>
                <p class="text-sm text-gray-500">Masukkan NIK untuk melihat detail informasi.</p>
            </div>

            <form id="nikForm" action="{{ route('permohonan.cek') }}" method="POST">
                @csrf
                <input type="hidden" name="nomor_tiket" id="modal_nomor_tiket">
                
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">NIK Pemohon</label>
                    <input type="number" name="nik" required 
                        placeholder="16 Digit Nomor Induk Kependudukan" 
                        class="w-full border-gray-300 rounded-xl px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-center tracking-widest font-bold">
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-blue-200 transition-all active:scale-95">
                        <i class="fa-solid fa-unlock-keyhole"></i> Buka Detail Data
                    </button>
                    <button type="button" onclick="closeNikModal()" class="w-full bg-gray-50 hover:bg-gray-100 text-gray-500 font-semibold py-3 rounded-xl transition-all">
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

            fetch(`{{ route('permohonan.daftar_publik') }}?search=${query}`, {
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