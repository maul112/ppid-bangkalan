<x-admin-panel-layout>
    <x-slot name="header">Tambah Dokumen LHKPN</x-slot>

    <div class="w-full">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.lhkpn.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
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
                <form action="{{ route('admin.lhkpn.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Pejabat --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Pejabat <span class="text-red-500">*</span></label>
                            <select name="pejabat_id" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" required>
                                <option value="">-- Pilih Pejabat --</option>
                                @foreach($pejabats as $pejabat)
                                    <option value="{{ $pejabat->id }}" {{ old('pejabat_id', $selectedPejabatId ?? '') == $pejabat->id ? 'selected' : '' }}>{{ $pejabat->nama }} ({{ $pejabat->kategori_pejabat }})</option>
                                @endforeach
                            </select>
                            @error('pejabat_id') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tahun --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Tahun Pelaporan <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-700 font-bold transition-all" placeholder="Contoh: 2023" required min="2000" max="{{ date('Y') + 1 }}">
                            @error('tahun') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- File PDF --}}
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">File Dokumen (PDF) <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <input type="file" name="file_pdf" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer bg-gray-50 rounded-2xl shadow-inner file:cursor-pointer" required>
                            </div>
                            <p class="text-[11px] text-gray-400 mt-2 ml-1 font-medium"><i class="fa-solid fa-circle-info mr-1"></i> Format: PDF (Maks: 5MB)</p>
                            @error('file_pdf') <p class="text-red-500 text-xs mt-2 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.lhkpn.index') }}" class="px-8 py-4 rounded-2xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition-all">
                            BATAL
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl text-sm font-black shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-1">
                            SIMPAN LHKPN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-panel-layout>
