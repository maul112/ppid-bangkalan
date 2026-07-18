<x-admin-panel-layout>
    <x-slot name="header">Edit Instansi & Dokumen</x-slot>

    <div class="space-y-6">
        {{-- Action Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-2 md:ml-4 w-full md:w-auto">
                <a href="{{ route('admin.ppid_pelaksana.index') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Kembali</span>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <p class="text-green-700 font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Edit Profil -->
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-lg font-black text-gray-800">Profil Instansi</h3>
                        <p class="text-sm text-gray-500 mt-1">Ubah detail profil instansi PPID Pelaksana.</p>
                    </div>
                    
                    <form action="{{ route('admin.ppid_pelaksana.update', $ppidPelaksana->id) }}" method="POST" class="p-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Instansi <span class="text-red-500">*</span></label>
                                <select name="kategori" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoriList as $kat)
                                        <option value="{{ $kat }}" {{ old('kategori', $ppidPelaksana->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pimpinan (Pejabat)</label>
                                <select name="pejabat_id" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                                    <option value="">-- Kosongkan Jika Belum Ada --</option>
                                    @foreach($pejabats as $pejabat)
                                        <option value="{{ $pejabat->id }}" {{ old('pejabat_id', $ppidPelaksana->pejabat_id) == $pejabat->id ? 'selected' : '' }}>
                                            {{ $pejabat->nama }} ({{ $pejabat->instansi ?? $pejabat->jabatan_keterangan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">{{ old('alamat', $ppidPelaksana->alamat) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="telepon" value="{{ old('telepon', $ppidPelaksana->telepon) }}" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $ppidPelaksana->email) }}" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Website Utama</label>
                                <input type="url" name="website" value="{{ old('website', $ppidPelaksana->website) }}" placeholder="https://..." class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Link Google Maps (Opsional)</label>
                            <input type="url" name="map_url" value="{{ old('map_url', $ppidPelaksana->map_url) }}" placeholder="https://www.google.com/maps/place/..." class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            <p class="mt-2 text-xs text-red-600 font-bold"><i class="fas fa-exclamation-circle mr-1"></i>PENTING: Anda HARUS menyalin Tautan (URL) langsung dari Kolom Alamat (Address Bar) di bagian atas browser saat membuka Google Maps. JANGAN gunakan link pendek dari tombol "Bagikan / Share" (goo.gl).</p>
                        </div>

                        <div class="pt-4 mt-6 border-t border-gray-100">
                            <h4 class="text-sm font-black text-gray-800 uppercase tracking-wider mb-4">Sosial Media</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Facebook</label>
                                    <input type="url" name="sosmed_facebook" value="{{ old('sosmed_facebook', $ppidPelaksana->sosmed_facebook) }}" placeholder="URL Facebook" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Instagram</label>
                                    <input type="url" name="sosmed_instagram" value="{{ old('sosmed_instagram', $ppidPelaksana->sosmed_instagram) }}" placeholder="URL Instagram" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">YouTube</label>
                                    <input type="url" name="sosmed_youtube" value="{{ old('sosmed_youtube', $ppidPelaksana->sosmed_youtube) }}" placeholder="URL YouTube" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">TikTok</label>
                                    <input type="url" name="sosmed_tiktok" value="{{ old('sosmed_tiktok', $ppidPelaksana->sosmed_tiktok) }}" placeholder="URL TikTok" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl text-sm font-black shadow-lg shadow-blue-100 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                PERBARUI INSTANSI
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Dokumen Wajib -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Form Upload -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-green-100 overflow-hidden relative">
                    <div class="absolute top-0 inset-x-0 h-2 bg-green-500"></div>
                    <div class="p-6 border-b border-gray-100 bg-green-50/30">
                        <h3 class="text-lg font-black text-green-800">Unggah Dokumen</h3>
                        <p class="text-xs text-green-600 mt-1">PDF maks 10MB</p>
                    </div>
                    
                    <form action="{{ route('admin.ppid_dokumen_wajib.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                        @csrf
                        <input type="hidden" name="ppid_pelaksana_id" value="{{ $ppidPelaksana->id }}">
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Kategori Dokumen</label>
                            <select name="kategori_dokumen" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-green-100 focus:border-green-300 transition-all bg-gray-50" required>
                                <option value="">-- Pilih --</option>
                                <option value="SOTK">SOTK</option>
                                <option value="RENSTRA">RENSTRA</option>
                                <option value="IKU">IKU</option>
                                <option value="RKT">RKT</option>
                                <option value="PK">PK</option>
                                <option value="RKA">RKA</option>
                                <option value="DPA">DPA</option>
                                <option value="LAKIP">LAKIP</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tahun</label>
                            <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-green-100 focus:border-green-300 transition-all bg-gray-50" required>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">File Dokumen (PDF)</label>
                            <input type="file" name="file" accept=".pdf" class="w-full border border-gray-200 rounded-xl text-sm text-gray-500 px-3 py-2 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                        </div>
                        
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-black shadow-lg shadow-green-100 transition flex items-center justify-center gap-2 mt-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            UNGGAH
                        </button>
                    </form>
                </div>

                <!-- List Dokumen -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-black text-gray-800">Daftar Dokumen Wajib</h3>
                        <p class="text-xs text-gray-500">Telah diunggah</p>
                    </div>
                    
                    <div class="p-4 space-y-3 max-h-[400px] overflow-y-auto">
                        @forelse($ppidPelaksana->dokumenWajib->sortByDesc('tahun') as $dok)
                            <div class="flex items-center justify-between p-3 border border-gray-100 rounded-2xl bg-gray-50/50 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-800 leading-tight">{{ $dok->kategori_dokumen }}</h4>
                                        <p class="text-xs font-medium text-gray-500">Thn {{ $dok->tahun }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-blue-600 flex items-center justify-center hover:bg-blue-50 transition-colors shadow-sm">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.ppid_dokumen_wajib.destroy', $dok->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus dokumen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-red-600 flex items-center justify-center hover:bg-red-50 transition-colors shadow-sm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-xs font-medium text-gray-400">Belum ada dokumen yang diunggah.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel-layout>
