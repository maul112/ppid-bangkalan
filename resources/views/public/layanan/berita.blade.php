@extends('layouts.publik')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb Navigation --}}
        <nav class="flex mb-10" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-600 font-medium flex items-center transition">
                        <i class="fa-solid fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-gray-600 font-bold">Layanan Berita</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Berita & Artikel</h1>
            <div class="mt-4 mx-auto h-1 w-20 bg-blue-600 rounded-full"></div>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Kumpulan informasi terkini dan kegiatan seputar Kabupaten Bangkalan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($beritas as $berita)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group flex flex-col">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-lg">Berita Terkini</div>
                </div>
                <div class="p-8 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 line-clamp-2 leading-tight group-hover:text-blue-600 transition">{{ $berita->judul }}</h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-3 leading-relaxed">
                        {{ strip_tags($berita->isi) }}
                    </p>
                    <div class="mt-auto pt-6 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-[10px] font-bold text-gray-400 tracking-widest">{{ $berita->created_at->format('d M Y') }}</span>
                        <a href="{{ route('public.layanan_berita_show', $berita->slug) }}" class="text-blue-600 font-black text-xs tracking-tighter hover:tracking-normal transition-all">Selengkapnya →</a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center">
                <div class="w-20 h-20 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-newspaper text-3xl"></i>
                </div>
                <p class="text-gray-400 font-bold italic">Belum ada berita yang diterbitkan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $beritas->links() }}
        </div>
    </div>
@endsection