<x-admin-panel-layout>
    <x-slot name="header">Edit Pejabat PPID</x-slot>

    <div class="w-full pb-12">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.pejabat.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.pejabat.update', $pejabat->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kategori Pejabat</label>
                        <select name="kategori_pejabat" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" required>
                            <option value="">Pilih Kategori</option>
                            @foreach(['Bupati', 'Wakil Bupati', 'Sekda', 'Asisten', 'Staf Ahli', 'Sekretaris DPRD', 'Inspektur', 'Kepala Dinas', 'Kepala Badan', 'Direktur RSUD', 'Camat', 'Kepala Pelaksana BPBD', 'Kepala Bagian'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori_pejabat', $pejabat->kategori_pejabat) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori_pejabat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" value="{{ old('nama', $pejabat->nama) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: Dr. H. Fulan, M.Si" required>
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jabatan Keterangan</label>
                        <input type="text" name="jabatan_keterangan" value="{{ old('jabatan_keterangan', $pejabat->jabatan_keterangan) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: Asisten Pemerintahan" required>
                        @error('jabatan_keterangan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Instansi / Unit Kerja</label>
                        <input type="text" name="instansi" value="{{ old('instansi', $pejabat->instansi) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: Sekretariat Daerah">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $pejabat->nip) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: 198001012005011001">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Pangkat</label>
                        <input type="text" name="pangkat" value="{{ old('pangkat', $pejabat->pangkat) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: Pembina Utama Muda">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Golongan</label>
                        <input type="text" name="golongan" value="{{ old('golongan', $pejabat->golongan) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3" placeholder="Contoh: IV/c">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status Aktif</label>
                        <label class="relative inline-flex items-center cursor-pointer mt-2">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $pejabat->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan Pejabat</span>
                        </label>
                    </div>

                    <!-- Data Lanjutan (Khusus Bupati / Wakil Bupati) -->
                    <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6" id="advanced-fields" style="display: none;">
                        <div class="col-span-1 md:col-span-2 mt-4">
                            <h3 class="text-sm font-bold text-gray-800 border-b pb-2 mb-2">Data Khusus Pimpinan Daerah</h3>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pejabat->tempat_lahir) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pejabat->tanggal_lahir) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Riwayat Pendidikan</label>
                            <textarea name="riwayat_pendidikan" rows="4" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">{{ old('riwayat_pendidikan', $pejabat->riwayat_pendidikan) }}</textarea>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Riwayat Karir</label>
                            <textarea name="riwayat_karir" rows="4" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">{{ old('riwayat_karir', $pejabat->riwayat_karir) }}</textarea>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Penghargaan</label>
                            <textarea name="penghargaan" rows="4" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">{{ old('penghargaan', $pejabat->penghargaan) }}</textarea>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2 mt-4">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Foto Profil</label>
                        @if($pejabat->foto)
                            <div class="mb-4">
                                <img src="{{ asset('storage/'.$pejabat->foto) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/*" class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-2xl file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition-all px-4 py-2">
                        <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG. Maksimal 10MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                        @error('foto') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl text-sm font-black shadow-lg shadow-blue-100 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        PERBARUI PEJABAT
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const kategoriSelect = document.querySelector('select[name="kategori_pejabat"]');
            const advancedFields = document.getElementById('advanced-fields');

            function toggleAdvancedFields() {
                if (kategoriSelect.value === 'Bupati' || kategoriSelect.value === 'Wakil Bupati') {
                    advancedFields.style.display = 'grid';
                } else {
                    advancedFields.style.display = 'none';
                }
            }

            kategoriSelect.addEventListener('change', toggleAdvancedFields);
            toggleAdvancedFields(); // Run on load in case of old input
        });
    </script>
</x-admin-panel-layout>
