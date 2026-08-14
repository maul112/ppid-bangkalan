@extends('layouts.publik')

@section('content')
    <div class="relative h-[450px] md:h-[550px] overflow-hidden bg-blue-900 shadow-inner">
        @if($banners->count() > 0)
            <div id="slider-container">
                @foreach($banners as $index => $banner)
                <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-transparent z-10"></div>
                    <img src="{{ asset('uploads/banner/' . $banner->gambar) }}" class="w-full h-full object-cover" alt="{{ $banner->judul }}">
                    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4">
                        <h2 class="text-4xl md:text-6xl font-black text-white max-w-4xl leading-tight mb-6 drop-shadow-2xl">
                            {{ $banner->judul }}
                        </h2>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="/permohonan/buat" class="bg-yellow-500 text-blue-900 px-12 py-5 text-lg md:text-xl rounded-full font-black hover:bg-yellow-400 hover:-translate-y-1 transition transform shadow-2xl ring-4 ring-yellow-500/30">
                                Mulai Ajukan Permohonan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="absolute inset-0 flex items-center justify-center bg-blue-800 text-white font-bold">
                Selamat Datang di PPID Kabupaten Bangkalan
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-30">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-xl border-b-4 border-blue-600 flex items-center gap-4">
                <div class="p-4 bg-blue-100 rounded-lg text-blue-600"><i class="fa-solid fa-folder-open text-2xl"></i></div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-black">Informasi Publik</p>
                    <p class="text-2xl font-black text-gray-800">{{ $total_dokumen }}+ Dokumen</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-xl border-b-4 border-green-600 flex items-center gap-4">
                <div class="p-4 bg-green-100 rounded-lg text-green-600"><i class="fa-solid fa-newspaper text-2xl"></i></div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-black">Berita Terkini</p>
                    <p class="text-2xl font-black text-gray-800">{{ $beritas->count() }} Postingan</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-xl border-b-4 border-yellow-500 flex items-center gap-4">
                <div class="p-4 bg-yellow-100 rounded-lg text-yellow-600"><i class="fa-solid fa-clock text-2xl"></i></div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-black">Waktu Respon</p>
                    <p class="text-2xl font-black text-gray-800">3-10 Hari Kerja</p>
                </div>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-black text-blue-900 tracking-tight">Berita & Artikel</h2>
                <div class="mt-2 h-1 w-16 bg-blue-600 rounded-full"></div>
            </div>
            <a href="{{ route('public.layanan_berita') }}" class="text-blue-600 font-bold hover:text-blue-800 transition flex items-center">
                Lihat Semua Berita <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @forelse($beritas as $berita)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group flex flex-col">
                <div class="relative overflow-hidden">
                    @if($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-300 group-hover:scale-110 transition duration-500">
                            <i class="fa-regular fa-image text-5xl"></i>
                        </div>
                    @endif
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
            <div class="col-span-3 py-20 text-center text-gray-400 italic font-medium">Belum ada berita yang diterbitkan.</div>
            @endforelse
        </div>
    </section>





    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            slides.forEach((slide) => slide.classList.replace('opacity-100', 'opacity-0'));
            slides[index].classList.replace('opacity-0', 'opacity-100');
            currentSlide = index;
        }

        function nextSlide() {
            if(slides.length > 0) {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }
        }

        if(slides.length > 0) {
            setInterval(nextSlide, 5000);
        }
    </script>
@endsection