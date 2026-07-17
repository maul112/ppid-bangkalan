<x-admin-panel-layout>
    <x-slot name="header">Tambah Instansi</x-slot>

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

        {{-- Form Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-black text-gray-800">Form Tambah PPID Pelaksana</h3>
                <p class="text-sm text-gray-500 mt-1">Lengkapi informasi detail instansi PPID Pelaksana di bawah ini.</p>
            </div>
            
            <form action="{{ route('admin.ppid_pelaksana.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Kolom Kiri -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Instansi <span class="text-red-500">*</span></label>
                            <select name="kategori" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoriList as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pimpinan (Pejabat)</label>
                            <select name="pejabat_id" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                                <option value="">-- Kosongkan Jika Belum Ada --</option>
                                @foreach($pejabats as $pejabat)
                                    <option value="{{ $pejabat->id }}" {{ old('pejabat_id') == $pejabat->id ? 'selected' : '' }}>
                                        {{ $pejabat->nama }} ({{ $pejabat->instansi ?? $pejabat->jabatan_keterangan }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-blue-600 font-medium">Nama instansi publik akan otomatis menyesuaikan data 'Instansi' dari profil pejabat ini.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="telepon" value="{{ old('telepon') }}" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Website Utama</label>
                            <input type="url" name="website" value="{{ old('website') }}" placeholder="https://..." class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Link Google Maps (Opsional)</label>
                            <input type="url" name="map_url" value="{{ old('map_url') }}" placeholder="https://www.google.com/maps/place/..." class="w-full border border-gray-200 rounded-2xl text-sm font-medium text-gray-600 px-4 py-3 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50 focus:bg-white">
                            <p class="mt-2 text-xs text-red-600 font-bold"><i class="fas fa-exclamation-circle mr-1"></i>PENTING: Anda HARUS menyalin Tautan (URL) langsung dari Kolom Alamat (Address Bar) di bagian atas browser saat membuka Google Maps. JANGAN gunakan link pendek dari tombol "Bagikan / Share" (goo.gl).</p>
                        </div>

                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <h4 class="text-sm font-black text-gray-800 uppercase tracking-wider mb-4">Sosial Media</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Facebook</label>
                                    <input type="url" name="sosmed_facebook" value="{{ old('sosmed_facebook') }}" placeholder="URL Facebook" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Instagram</label>
                                    <input type="url" name="sosmed_instagram" value="{{ old('sosmed_instagram') }}" placeholder="URL Instagram" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">YouTube</label>
                                    <input type="url" name="sosmed_youtube" value="{{ old('sosmed_youtube') }}" placeholder="URL YouTube" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">TikTok</label>
                                    <input type="url" name="sosmed_tiktok" value="{{ old('sosmed_tiktok') }}" placeholder="URL TikTok" class="w-full border border-gray-200 rounded-xl text-sm font-medium text-gray-600 px-3 py-2 focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all bg-gray-50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        SIMPAN INSTANSI
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-panel-layout>
