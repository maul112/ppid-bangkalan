<x-admin-panel-layout>
    <x-slot name="header">Tambah Regulasi Baru</x-slot>

    <div class="w-full pb-12">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.regulasi.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header Form --}}
            <div class="p-8 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-red-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight">Pengarsipan Regulasi</h3>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Input Dasar Hukum & Aturan Publik</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-8">
                @csrf

                {{-- Nomor Regulasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Nomor Regulasi</label>
                        <input type="text" name="nomor" 
                            class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-red-500 shadow-inner text-gray-700 font-bold placeholder-gray-300 transition-all" 
                            placeholder="Contoh: Perbup No. 12 Tahun 2023" required>
                    </div>
                    
                    {{-- Upload File --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Dokumen PDF</label>
                        <input type="file" name="file_pdf" id="file_pdf" class="hidden" accept=".pdf" required onchange="updateFileLabel(this)">
                        <label for="file_pdf" class="w-full flex items-center justify-between bg-gray-50 hover:bg-white border-2 border-dashed border-gray-100 hover:border-red-400 rounded-2xl px-6 py-4 cursor-pointer transition-all group">
                            <span id="file-name" class="text-sm font-bold text-gray-400 group-hover:text-red-600 truncate mr-2">Klik untuk pilih file...</span>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </label>
                    </div>
                </div>

                {{-- Judul / Tentang --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Tentang / Judul Lengkap Aturan</label>
                    <textarea name="judul" rows="5" 
                        class="w-full border-none bg-gray-50 rounded-[2rem] px-6 py-6 focus:ring-2 focus:ring-red-500 shadow-inner text-gray-600 font-bold leading-relaxed placeholder-gray-300 transition-all" 
                        placeholder="Contoh: Tata Cara Permohonan Informasi Publik di Lingkungan Pemerintah Kabupaten Bangkalan..." required></textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Arsip Regulasi
                    </button>
                    <p class="text-center text-[10px] text-gray-400 mt-4 font-black uppercase tracking-widest italic">* Pastikan dokumen dalam format PDF dan tidak melebihi 5MB</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateFileLabel(input) {
            const label = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                label.classList.remove('text-gray-400');
                label.classList.add('text-red-600');
            }
        }
    </script>
</x-admin-panel-layout>