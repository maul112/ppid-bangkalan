<x-admin-panel-layout>
    <x-slot name="header">Tambah Data DIP</x-slot>

    <div class="w-full pb-12">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('admin.dip.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <form action="{{ route('admin.dip.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Kategori Informasi</label>
                        <select name="kategori" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" required>
                            <option value="Informasi Berkala">Informasi Berkala</option>
                            <option value="Informasi Serta Merta">Informasi Serta Merta</option>
                            <option value="Informasi Setiap Saat">Informasi Setiap Saat</option>
                            <option value="Informasi Dikecualikan">Informasi Dikecualikan</option>
                        </select>
                    </div>

                    {{-- Judul --}}
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul Dokumen</label>
                        <input type="text" name="judul" 
                            class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 placeholder-gray-300 font-bold transition-all" 
                            placeholder="Contoh: Laporan Keuangan Semester I 2024" required>
                    </div>

                    {{-- File PDF --}}
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Upload File (PDF)</label>
                        <div class="relative group">
                            <input type="file" name="file_pdf" id="file_pdf" class="hidden" accept=".pdf" onchange="updateFileName(this)">
                            <label for="file_pdf" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-100 rounded-[2rem] bg-gray-50 hover:bg-white hover:border-red-400 transition-all cursor-pointer">
                                <div class="text-center p-6">
                                    <div id="file-icon" class="w-12 h-12 bg-white text-red-500 rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p id="file-label" class="text-sm text-gray-500 font-bold uppercase tracking-widest">Pilih Dokumen PDF</p>
                                    <p class="text-[10px] text-gray-400 mt-2 font-black italic uppercase">* Maksimal 5MB (Format PDF)</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4 flex gap-4">
                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Simpan Data DIP
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-label');
            const icon = document.getElementById('file-icon');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                label.classList.replace('text-gray-500', 'text-red-600');
                icon.classList.replace('text-red-500', 'bg-red-600');
                icon.classList.add('text-white');
            }
        }
    </script>
</x-admin-panel-layout>