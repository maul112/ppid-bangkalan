<x-admin-panel-layout>
    <x-slot name="header">Tambah Agenda</x-slot>

    <div class="w-full pb-12">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                Kembali ke Daftar Agenda
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
            <form action="{{ route('admin.agenda.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium" required>
                        @error('tanggal') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Waktu Pelaksanaan (Opsional)</label>
                        <input type="text" name="waktu" value="{{ old('waktu') }}" placeholder="Misal: 09.00 s/d Selesai" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium">
                        @error('waktu') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Judul Agenda <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Rapat Paripurna DPRD" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium" required>
                        @error('judul') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Uraian / Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="uraian" rows="4" placeholder="Tuliskan uraian ringkas kegiatan di sini..." class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium" required>{{ old('uraian') }}</textarea>
                        @error('uraian') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Misal: Pendopo Agung Kabupaten" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium" required>
                        @error('lokasi') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Peserta / Sasaran (Opsional)</label>
                        <input type="text" name="peserta" value="{{ old('peserta') }}" placeholder="Misal: Seluruh Kepala OPD" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium">
                        @error('peserta') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Jumlah Peserta (Opsional)</label>
                        <input type="text" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" placeholder="Misal: 100 Orang" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium">
                        @error('jumlah_peserta') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" rows="2" placeholder="Catatan tambahan, contoh: Pakaian Batik Bebas Rapi" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Dibuat Oleh (Instansi) <span class="text-red-500">*</span></label>
                        <input type="text" name="dibuat_oleh" value="{{ old('dibuat_oleh', 'DISKOMINFO Bangkalan') }}" placeholder="Nama Instansi Pembuat" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-5 py-4 font-medium" required>
                        @error('dibuat_oleh') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-2xl text-sm font-black tracking-widest transition-all shadow-lg shadow-red-200 hover:shadow-xl hover:-translate-y-1">
                        SIMPAN AGENDA
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-panel-layout>
