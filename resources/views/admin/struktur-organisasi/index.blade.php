<x-admin-panel-layout>
    <x-slot name="header">Struktur Organisasi</x-slot>

    <div class="space-y-6">
        <div class="flex items-center gap-3 ml-2 md:ml-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Manajemen Struktur Organisasi</span>
        </div>

        @if(session('success'))
            <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Gambar Struktur Organisasi Saat Ini</h3>
            
            @if($struktur)
                <div class="mb-8 border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <img src="{{ asset('uploads/struktur/' . $struktur->gambar) }}" alt="Struktur Organisasi" class="w-full h-auto object-contain max-h-[600px] bg-gray-50">
                </div>
            @else
                <div class="mb-8 p-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300 text-center flex flex-col items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-gray-500 font-bold mb-1">Belum ada gambar yang diunggah.</p>
                    <p class="text-gray-400 text-sm font-medium">Silakan unggah gambar struktur organisasi baru.</p>
                </div>
            @endif

            <form action="{{ $struktur ? route('admin.struktur-organisasi.update', $struktur->id) : route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($struktur)
                    @method('PUT')
                @endif
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ $struktur ? 'Ganti Gambar' : 'Unggah Gambar' }}</label>
                    <input type="file" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition-all border border-gray-200 rounded-xl" required>
                    @error('gambar')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-2xl text-sm font-black shadow-lg hover:bg-gray-800 transition">
                        {{ $struktur ? 'PERBARUI' : 'SIMPAN' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-panel-layout>
