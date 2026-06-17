<x-admin-panel-layout>
    <x-slot name="header">Edit Berita</x-slot>

    <div class="max-w-5xl mx-auto pb-12">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header Form --}}
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight">Editor Berita</h3>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Perbarui Informasi</p>
                    </div>
                </div>
                <a href="{{ route('admin.berita.index') }}" class="text-gray-400 hover:text-red-600 font-bold text-sm uppercase tracking-widest transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Batal
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 shadow-sm animate-fade-in-down">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-rose-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-rose-800">Ups! Ada beberapa kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm text-rose-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-8">
                @csrf
                @method('PUT')
                
                {{-- Judul Berita --}}
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul Utama</label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                        class="w-full border-none bg-gray-50 rounded-2xl px-6 py-5 focus:ring-2 focus:ring-blue-500 shadow-inner text-xl font-bold text-gray-800 placeholder-gray-300 transition-all" 
                        placeholder="Masukkan judul berita yang menarik..." required>
                </div>

                {{-- Isi Berita --}}
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Konten Berita</label>
                    <textarea name="isi" rows="12" 
                        class="w-full border-none bg-gray-50 rounded-[2rem] px-6 py-6 focus:ring-2 focus:ring-blue-500 shadow-inner text-gray-600 leading-relaxed placeholder-gray-300 transition-all" 
                        placeholder="Tuliskan isi berita secara lengkap di sini..." required>{{ old('isi', $berita->isi) }}</textarea>
                </div>

                {{-- Upload Gambar --}}
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Gambar Sampul (Cover)</label>
                    @if($berita->gambar)
                        <div class="mb-4">
                            <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="Current Image" class="w-48 h-auto rounded-xl shadow-sm border border-gray-100">
                        </div>
                    @endif
                    <div class="relative group">
                        <input type="file" name="gambar" id="gambar" class="hidden" onchange="updateFileName(this)">
                        <label for="gambar" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-100 rounded-[2rem] bg-gray-50 hover:bg-white hover:border-blue-400 transition-all cursor-pointer">
                            <div class="flex flex-col items-center py-6">
                                <svg class="w-10 h-10 text-gray-300 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p id="file-label" class="text-sm text-gray-400 font-bold uppercase tracking-widest">Pilih Gambar Cover (Kosongkan jika tidak ingin mengubah)</p>
                                <p class="text-[10px] text-gray-300 mt-2 italic font-medium">* JPG, PNG. Maks 2MB.</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 flex gap-4">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-100 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                label.classList.remove('text-gray-400');
                label.classList.add('text-blue-600');
            }
        }
    </script>
</x-admin-panel-layout>
