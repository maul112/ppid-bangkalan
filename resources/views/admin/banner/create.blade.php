<x-admin-panel-layout>
    {{-- Slot Header hanya untuk judul --}}
    <x-slot name="header">
        Upload Banner Baru
    </x-slot>

    <div class="w-full">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.banner.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    {{-- Input Judul --}}
                    <div>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-3">Judul / Label Banner <span class="text-gray-400 font-medium">(Opsional)</span></label>
                        <input type="text" name="judul" 
                            class="w-full border-none bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-red-500 shadow-inner text-gray-700 placeholder-gray-300 transition-all" 
                            placeholder="Contoh: Selamat Datang di PPID Bangkalan">
                    </div>

                    {{-- Input File Custom --}}
                    <div>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-3">Pilih File Gambar</label>
                        <div class="relative group">
                            <input type="file" name="gambar" id="gambar" class="hidden" required onchange="previewImage(this)">
                            <label for="gambar" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-200 rounded-[2rem] bg-gray-50 hover:bg-white hover:border-red-400 transition-all cursor-pointer overflow-hidden">
                                
                                {{-- Placeholder saat belum pilih file --}}
                                <div id="placeholder-upload" class="flex flex-col items-center justify-center py-10">
                                    <div class="w-16 h-16 bg-white text-red-500 rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-bold" id="file-name">Klik untuk pilih gambar banner</p>
                                    <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-widest font-black italic">* Rekomendasi: 1920x600 px (Landscape)</p>
                                </div>

                                {{-- Preview Container --}}
                                <img id="img-preview" class="hidden w-full h-full object-cover">
                            </label>
                        </div>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-100 transition-all flex items-center justify-center gap-3 uppercase tracking-[0.2em]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Banner Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk Preview Gambar --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('img-preview');
            const placeholder = document.getElementById('placeholder-upload');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
                fileName.textContent = input.files[0].name;
            }
        }
    </script>
</x-admin-panel-layout>