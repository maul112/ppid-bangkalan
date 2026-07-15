<x-admin-panel-layout>
    {{-- Slot Header untuk Judul Besar --}}
    <x-slot name="header">
        Kelola Banner
    </x-slot>

    {{-- Konten Utama --}}
    <div class="space-y-8">
        
        {{-- Action Bar: Tombol Kembali dan Tambah --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 ml-2 md:ml-4 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200 transition-all shadow-sm flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <span class="text-sm font-black text-gray-400 uppercase tracking-widest hidden sm:inline">Daftar Banner Aktif</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mr-2">
                <form action="{{ route('admin.banner.index') }}" method="GET" class="w-full sm:w-auto flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul/deskripsi..." class="w-full sm:w-64 border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 px-4 py-3 focus:ring-2 focus:ring-red-100 focus:border-red-300 transition-all">
                    <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-gray-200 transition flex items-center gap-2 hover:bg-gray-800">
                        CARI
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.banner.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-2xl text-sm font-black transition flex items-center gap-2 hover:bg-gray-200">
                            RESET
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.banner.create') }}" class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-red-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    TAMBAH BANNER
                </a>
            </div>
        </div>

        {{-- Grid Kartu Banner --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($banners as $banner)
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                {{-- Preview Gambar --}}
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('uploads/banner/'.$banner->gambar) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                    <div class="absolute bottom-5 left-6 right-6">
                        <p class="text-[10px] font-black text-red-400 uppercase tracking-[0.2em] mb-1">Judul Banner</p>
                        <h4 class="text-white font-bold text-lg leading-tight truncate">{{ $banner->judul ?? 'Tanpa Judul' }}</h4>
                    </div>
                </div>

                {{-- Footer Kartu --}}
                <div class="p-6 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-[11px] font-bold uppercase tracking-wider">{{ $banner->created_at->format('d M Y') }}</span>
                    </div>

                    <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-11 h-11 flex items-center justify-center bg-red-50 text-red-500 rounded-2xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            {{-- State Jika Kosong --}}
            <div class="col-span-full bg-white rounded-[2.5rem] p-20 text-center border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada banner</h3>
                <p class="text-gray-500 mb-8">Tambahkan banner baru untuk ditampilkan di halaman utama publik.</p>
                <a href="{{ route('admin.banner.create') }}" class="text-blue-600 font-black uppercase tracking-widest text-sm hover:underline">+ Tambah Sekarang</a>
            </div>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $banners->appends(request()->query())->links() }}
        </div>
    </div>
</x-admin-panel-layout>