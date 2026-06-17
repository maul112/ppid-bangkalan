<x-admin-panel-layout>
    <x-slot name="header">Edit Regulasi</x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header Form --}}
            <div class="p-8 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-red-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight">Perbarui Regulasi</h3>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Edit Dasar Hukum & Aturan Publik</p>
                    </div>
                </div>
                <a href="{{ route('admin.regulasi.index') }}" class="text-gray-400 hover:text-red-600 font-black text-xs uppercase tracking-widest transition-all">Batal</a>
            </div>

            <form action="{{ route('admin.regulasi.update', $regulasi->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-8">
                @csrf
                @method('PUT')

                {{-- Nomor Regulasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Nomor Regulasi</label>
                        <input type="text" name="nomor" value="{{ old('nomor', $regulasi->nomor) }}"
                            class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-red-500 shadow-inner text-gray-700 font-bold placeholder-gray-300 transition-all" 
                            placeholder="Contoh: Perbup No. 12 Tahun 2023" required>
                    </div>
                    
                    {{-- Upload File --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Dokumen PDF (Opsional)</label>
                        <input type="file" name="file_pdf" id="file_pdf" class="hidden" accept=".pdf" onchange="updateFileLabel(this)">
                        <label for="file_pdf" class="w-full flex items-center justify-between bg-gray-50 hover:bg-white border-2 border-dashed border-gray-100 hover:border-red-400 rounded-2xl px-6 py-4 cursor-pointer transition-all group">
                            <span id="file-name" class="text-sm font-bold text-gray-400 group-hover:text-red-600 truncate mr-2">Biarkan kosong jika tidak diubah...</span>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </label>
                        <p class="text-xs text-gray-500 mt-2 font-medium">File Saat Ini: <a href="{{ asset('uploads/regulasi/' . $regulasi->file_pdf) }}" target="_blank" class="text-blue-600 hover:underline">Lihat PDF</a></p>
                    </div>
                </div>

                {{-- Judul / Tentang --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Tentang / Judul Lengkap Aturan</label>
                    <textarea name="judul" rows="5" 
                        class="w-full border-none bg-gray-50 rounded-[2rem] px-6 py-6 focus:ring-2 focus:ring-red-500 shadow-inner text-gray-600 font-bold leading-relaxed placeholder-gray-300 transition-all" 
                        placeholder="Contoh: Tata Cara Permohonan Informasi Publik di Lingkungan Pemerintah Kabupaten Bangkalan..." required>{{ old('judul', $regulasi->judul) }}</textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Perbarui Arsip Regulasi
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
