<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPID Kabupaten Bangkalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <header class="bg-white py-4 shadow-sm relative z-[60]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo PPID" class="h-16 w-auto">
                    <div class="h-10 w-[1px] bg-gray-200 hidden md:block"></div>
                    <div>
                        <h1 class="text-xl font-black text-blue-900 leading-none">PPID KABUPATEN</h1>
                        <p class="text-sm font-bold text-gray-500 tracking-[0.2em]">BANGKALAN</p>
                    </div>
                </div>
                <div class="hidden lg:block text-right">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">E-Mail Resmi</p>
                    <p class="text-sm font-bold text-blue-600 italic">ppid@bangkalankab.go.id</p>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-[#2B7FFF] sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center space-x-1">
                    <a href="/" class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold transition">BERANDA</a>
                    
                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            PROFIL <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="/profil/struktur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Struktur Organisasi</a>
                                <a href="/profil/visi-misi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Visi dan Misi</a>
                                <a href="/profil/tugas-fungsi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Tugas dan Fungsi</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            Pejabat PPID <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Bupati</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Wakil Bupati</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            Daftar Informasi Publik <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-56">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Bupati</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Wakil Bupati</a>
                            </div>
                        </div>
                    </div>

                    {{-- <a href="/informasi-publik" class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold">INFORMASI PUBLIK</a> --}}

                    <div class="relative dropdown">
                        <button class="text-white px-4 py-2 rounded hover:bg-white/10 text-sm font-bold flex items-center">
                            LAYANAN ONLINE <i class="fa-solid fa-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        <div class="dropdown-menu absolute hidden pt-2 w-64">
                            <div class="bg-white shadow-2xl rounded-b-md py-2 border-t-4 border-blue-800">
                                <a href="/permohonan/buat" class="block px-4 py-2 text-sm text-blue-700 hover:bg-blue-50 font-black italic underline">
                                    <i class="fa-solid fa-file-pen mr-2"></i> AJUKAN PERMOHONAN
                                </a>
                                <a href="{{ route('permohonan.daftar_publik') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">
                                    <i class="fa-solid fa-list-ul mr-2"></i> DAFTAR PERMOHONAN
                                </a>
                                <a href="{{ route('permohonan.tracking') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">
                                    <i class="fa-solid fa-magnifying-glass mr-2"></i> CEK STATUS (TRACKING)
                                </a>
                                <hr class="my-2 border-gray-100">
                                <a href="/prosedur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 font-medium">Prosedur Informasi</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative dropdown">
                    <button class="bg-yellow-400 text-blue-900 px-6 py-1.5 rounded text-xs font-black hover:bg-yellow-500 transition shadow-sm flex items-center">
                        MASUK <i class="fa-solid fa-right-to-bracket ml-2"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden pt-2 right-0 w-48">
                        <div class="bg-white shadow-2xl rounded-md py-2 border-t-4 border-yellow-500 text-left">
                            <p class="px-4 py-1 text-[9px] font-bold text-gray-400 uppercase tracking-widest">Login Internal</p>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold">Admin PPID</a>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 font-bold border-t border-gray-50">Admin OPD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
                            <a href="/permohonan/buat" class="bg-blue-600 text-white px-10 py-3 rounded-full font-bold hover:bg-blue-700 transition transform hover:scale-105 shadow-xl">
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
                    <p class="text-2xl font-black text-gray-800">{{ $regulasis->count() }}+ Dokumen</p>
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
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-blue-900 uppercase tracking-tight italic">Berita & Artikel</h2>
                <div class="mt-2 h-1.5 w-16 bg-blue-600 rounded-full"></div>
            </div>
            <a href="#" class="text-blue-600 font-bold hover:text-blue-800 transition flex items-center">
                LIHAT SEMUA <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
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
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $berita->created_at->format('d M Y') }}</span>
                        <a href="#" class="text-blue-600 font-black text-xs uppercase tracking-tighter hover:tracking-normal transition-all italic">Selengkapnya →</a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-20 text-center text-gray-400 italic font-medium">Belum ada berita yang diterbitkan.</div>
            @endforelse
        </div>
    </section>

    <footer class="bg-[#0b0f1a] text-white pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center italic">
                        <span class="w-2 h-6 bg-blue-600 mr-3 rounded-full"></span>HUBUNGI KAMI
                    </h4>
                    <div class="space-y-5 text-gray-400 text-sm">
                        <div class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-4 text-blue-500"></i>
                            <p>Jl. Letnan Abdullah No.1, Alun-Alun Barat, Kabupaten Bangkalan, Jawa Timur 69112</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-phone mr-4 text-blue-500"></i>
                            <p>(031) 3095331</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-envelope mr-4 text-blue-500"></i>
                            <p>diskominfo@bangkalankab.go.id</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center italic">
                        <span class="w-2 h-6 bg-blue-600 mr-3 rounded-full"></span>NAVIGASI
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Tentang PPID</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Informasi Publik Terbuka</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>Daftar Informasi Publik (DIP)</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2"></i>SOP Pelayanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-black mb-8 flex items-center italic">
                        <span class="w-2 h-6 bg-blue-600 mr-3 rounded-full"></span>LOKASI KAMI
                    </h4>
                    <div class="rounded-xl overflow-hidden h-48 shadow-2xl border border-gray-800">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.882885489838!2d112.7337!3d-7.0259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd8015337583f6f%3A0xb3387b38d3890f5d!2sBangkalan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="w-full h-full grayscale opacity-70 hover:grayscale-0 transition-all duration-700" 
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#070a12] py-6 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 text-center text-[10px] font-bold text-gray-600 tracking-[0.3em] uppercase">
                © {{ date('Y') }} PEMERINTAH KABUPATEN BANGKALAN - DISKOMINFO
            </div>
        </div>
    </footer>

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
</body>
</html>