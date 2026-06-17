@extends('layouts.publik')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb Navigation --}}
        <nav class="flex mb-8 w-full" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-600 font-medium flex items-center transition">
                        <i class="fa-solid fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="{{ route('public.layanan_berita') }}" class="text-gray-400 hover:text-blue-600 font-medium transition">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-gray-600 font-bold line-clamp-1 w-32 sm:w-64">{{ $berita->judul }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Uniform Header Design --}}
        <div class="text-center mb-10 w-full">
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight">{{ $berita->judul }}</h1>
            <div class="mt-6 mx-auto h-1 w-20 bg-blue-600 rounded-full"></div>
            <div class="mt-6 flex items-center justify-center gap-6 text-xs font-bold text-gray-400 uppercase tracking-widest">
                <span class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar text-blue-500 text-lg"></i> 
                    {{ $berita->created_at->translatedFormat('d F Y') }}
                </span>
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-user-circle text-blue-500 text-lg"></i> 
                    Administrator PPID
                </span>
            </div>
        </div>

        <div class="w-full">
            {{-- Berita Image --}}
            @if($berita->gambar)
                <div class="mb-10 rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative">
                    <div class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-lg z-10">
                        Berita Terkini
                    </div>
                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full max-h-[500px] object-cover hover:scale-105 transition duration-700">
                </div>
            @endif

            {{-- Article Content --}}
            <div class="bg-white p-8 md:p-12 shadow-xl rounded-3xl border border-gray-100">
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed font-medium">
                    {!! nl2br(e($berita->isi)) !!}
                </div>

                {{-- Share Buttons --}}
                <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-500 uppercase tracking-widest">Bagikan Artikel:</span>
                    <div class="flex items-center gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-400 flex items-center justify-center hover:bg-blue-400 hover:text-white transition shadow-sm">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition shadow-sm">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rekomendasi Berita Lainnya --}}
        @if($beritaLain->count() > 0)
            <div class="mt-20 max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Baca Berita Lainnya</h2>
                        <div class="mt-2 h-1 w-12 bg-blue-600 rounded-full"></div>
                    </div>
                    <a href="{{ route('public.layanan_berita') }}" class="text-blue-600 font-bold hover:text-blue-800 transition flex items-center text-sm">
                        Indeks Berita <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($beritaLain as $lain)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group flex flex-col border border-gray-100">
                            @if($lain->gambar)
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ asset('uploads/berita/' . $lain->gambar) }}" alt="{{ $lain->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                            @endif
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-base font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-blue-600 transition">{{ $lain->judul }}</h3>
                                <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                                    <span class="text-[10px] font-bold text-gray-400 tracking-widest">{{ $lain->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('public.layanan_berita_show', $lain->slug) }}" class="text-blue-600 font-black text-xs tracking-tighter hover:tracking-normal transition-all">Baca &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
