<x-admin-panel-layout title="Tambah Dokumen Publik">
    <x-slot name="header">Tambah Dokumen Publik</x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('admin.dokumen.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 font-bold transition-all group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Dokumen
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Kategori --}}
<div>
    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">
        Kategori <span class="text-red-500">*</span>
    </label>

    <select
        name="kategori"
        class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all"
        required
    >
        <option value="">-- Pilih Kategori --</option>

        <option value="SOP" {{ old('kategori') == 'SOP' ? 'selected' : '' }}>
            SOP
        </option>

        <option value="Dasar Hukum" {{ old('kategori') == 'Dasar Hukum' ? 'selected' : '' }}>
            Dasar Hukum
        </option>

        <option value="Alur Pelayanan" {{ old('kategori') == 'Alur Pelayanan' ? 'selected' : '' }}>
            Alur Pelayanan
        </option>

        <option value="Laporan PPID" {{ old('kategori') == 'Laporan PPID' ? 'selected' : '' }}>
            Laporan PPID
        </option>

        <option value="LHKPN" {{ old('kategori') == 'LHKPN' ? 'selected' : '' }}>
            LHKPN
        </option>
    </select>

    @error('kategori')
        <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p>
    @enderror
</div>

                        {{-- Instansi OPD --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Instansi (OPD) <span class="text-red-500">*</span></label>
                            <select name="opd_id" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" required>
                                <option value="">-- Pilih OPD --</option>
                                @foreach($opds as $opd)
                                    <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>{{ $opd->nama_opd }}</option>
                                @endforeach
                            </select>
                            @error('opd_id') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Judul / Nama Dokumen --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul / Nama Dokumen <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul') }}" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 placeholder-gray-300 font-bold transition-all" 
                                placeholder="Masukkan judul dokumen..." required>
                            @error('judul') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tahun --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Tahun <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" required>
                            @error('tahun') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Keterangan (Opsional)</label>
                            <textarea name="keterangan" rows="3" 
                                class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" 
                                placeholder="Tambahkan keterangan jika perlu...">{{ old('keterangan') }}</textarea>
                            @error('keterangan') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- File PDF --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">File PDF <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <input type="file" name="file" id="file_pdf" class="hidden" accept=".pdf" onchange="updateFileName(this)" required>
                                <label for="file_pdf" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-100 rounded-[2rem] bg-gray-50 hover:bg-white hover:border-blue-400 transition-all cursor-pointer">
                                    <div class="text-center p-6">
                                        <div id="file-icon" class="w-12 h-12 bg-white text-blue-500 rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p id="file-label" class="text-sm text-gray-500 font-bold uppercase tracking-widest">Pilih Dokumen PDF</p>
                                        <p class="text-[10px] text-gray-400 mt-2 font-black italic uppercase">* Maksimal 10MB (Format .pdf)</p>
                                    </div>
                                </label>
                            </div>
                            @error('file') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4 flex gap-4">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Simpan Dokumen Publik
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
                label.classList.replace('text-gray-500', 'text-blue-600');
                icon.classList.replace('text-blue-500', 'bg-blue-600');
                icon.classList.add('text-white');
            }
        }
    </script>
</x-admin-panel-layout>
