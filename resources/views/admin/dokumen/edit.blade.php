<x-admin-panel-layout title="Edit Dokumen Publik">
    <x-slot name="header">Edit Dokumen Publik</x-slot>

    <div class="w-full pb-12">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('admin.dokumen.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
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
                <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-yellow-500 shadow-inner text-gray-700 font-bold transition-all" required>
                                <option value="">-- Pilih Kategori --</option>
                            
                                <option value="SOP" {{ old('kategori', $dokumen->kategori) == 'SOP' ? 'selected' : '' }}>
                                    SOP
                                </option>
                            
                                <option value="Dasar Hukum" {{ old('kategori', $dokumen->kategori) == 'Dasar Hukum' ? 'selected' : '' }}>
                                    Dasar Hukum
                                </option>
                            
                                <option value="Alur Pelayanan" {{ old('kategori', $dokumen->kategori) == 'Alur Pelayanan' ? 'selected' : '' }}>
                                    Alur Pelayanan
                                </option>
                            
                                <option value="Laporan PPID" {{ old('kategori', $dokumen->kategori) == 'Laporan PPID' ? 'selected' : '' }}>
                                    Laporan PPID
                                </option>
                                
                            </select>
                            @error('kategori') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Instansi OPD --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Instansi (OPD) <span class="text-red-500">*</span></label>
                            <select name="opd_id" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-yellow-500 shadow-inner text-gray-700 font-bold transition-all" required>
                                <option value="">-- Pilih OPD --</option>
                                @foreach($opds as $opd)
                                    <option value="{{ $opd->id }}" {{ old('opd_id', $dokumen->opd_id) == $opd->id ? 'selected' : '' }}>{{ $opd->nama_opd }}</option>
                                @endforeach
                            </select>
                            @error('opd_id') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Judul / Nama Dokumen --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul / Nama Dokumen <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-yellow-500 shadow-inner text-gray-700 placeholder-gray-300 font-bold transition-all" 
                                placeholder="Masukkan judul dokumen..." required>
                            @error('judul') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tahun --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Tahun <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun" value="{{ old('tahun', $dokumen->tahun) }}" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-yellow-500 shadow-inner text-gray-700 font-bold transition-all" required>
                            @error('tahun') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Keterangan (Opsional)</label>
                            <textarea name="keterangan" rows="3" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-yellow-500 shadow-inner text-gray-700 font-bold transition-all" 
                                placeholder="Tambahkan keterangan jika perlu...">{{ old('keterangan', $dokumen->keterangan) }}</textarea>
                            @error('keterangan') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- File PDF --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Update File PDF (Opsional)</label>
                            <div class="relative group">
                                <input type="file" name="file" id="file_pdf" class="hidden" accept=".pdf" onchange="updateFileName(this)">
                                <label for="file_pdf" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-100 rounded-[2rem] bg-gray-50 hover:bg-white hover:border-yellow-400 transition-all cursor-pointer">
                                    <div class="text-center p-6">
                                        <div id="file-icon" class="w-12 h-12 bg-white text-yellow-500 rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p id="file-label" class="text-sm text-gray-500 font-bold uppercase tracking-widest">
                                            @if($dokumen->file_path)
                                                Biarkan kosong jika tidak ingin mengubah file
                                            @else
                                                Pilih Dokumen PDF
                                            @endif
                                        </p>
                                        <p class="text-[10px] text-gray-400 mt-2 font-black italic uppercase">* Maksimal 10MB (Format .pdf)</p>
                                    </div>
                                </label>
                            </div>
                            @if($dokumen->file_path)
                                <div class="mt-4 flex items-center gap-2 bg-yellow-50 text-yellow-700 px-4 py-3 rounded-xl">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <span class="text-sm font-bold">File saat ini:</span>
                                    <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="text-sm underline hover:text-yellow-800">Lihat File</a>
                                </div>
                            @endif
                            @error('file') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4 flex gap-4">
                        <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-yellow-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Perbarui Dokumen Publik
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
                label.classList.replace('text-gray-500', 'text-yellow-600');
                icon.classList.replace('text-yellow-500', 'bg-yellow-600');
                icon.classList.add('text-white');
            }
        }
    </script>
</x-admin-panel-layout>
