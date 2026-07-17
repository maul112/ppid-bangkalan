@extends('layouts.publik')
@section('title', $ppidPelaksana->pejabat->instansi ?? 'Profil Instansi')
@section('content')
<x-public-header title="{{ $ppidPelaksana->pejabat->instansi ?? 'Profil Instansi' }}" subtitle="Profil {{ $ppidPelaksana->pejabat->instansi ?? 'Instansi' }} PPID Pelaksana" />
<div class="bg-gray-100 pb-20">
<div class="max-w-7xl mx-auto pt-12 px-4 sm:px-6 lg:px-8">
    <!-- Header Instansi -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8 overflow-hidden">
        <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-1 md:col-span-2 space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Kontak</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-gray-500 font-medium mb-1">Alamat</span>
                        <p class="text-gray-900">{{ $ppidPelaksana->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="block text-gray-500 font-medium mb-1">Telepon</span>
                        <p class="text-gray-900">{{ $ppidPelaksana->telepon ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="block text-gray-500 font-medium mb-1">Email</span>
                        <p class="text-gray-900">{{ $ppidPelaksana->email ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="block text-gray-500 font-medium mb-1">Website</span>
                        @if($ppidPelaksana->website)
                            <a href="{{ $ppidPelaksana->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $ppidPelaksana->website }}</a>
                        @else
                            <p class="text-gray-900">-</p>
                        @endif
                    </div>
                </div>

                <!-- Sosial Media -->
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-6">Sosial Media</h3>
                <div class="flex space-x-4 mt-2">
                    @if($ppidPelaksana->sosmed_facebook)
                        <a href="{{ $ppidPelaksana->sosmed_facebook }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if($ppidPelaksana->sosmed_instagram)
                        <a href="{{ $ppidPelaksana->sosmed_instagram }}" target="_blank" class="text-pink-600 hover:text-pink-800 text-2xl"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($ppidPelaksana->sosmed_youtube)
                        <a href="{{ $ppidPelaksana->sosmed_youtube }}" target="_blank" class="text-red-600 hover:text-red-800 text-2xl"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($ppidPelaksana->sosmed_tiktok)
                        <a href="{{ $ppidPelaksana->sosmed_tiktok }}" target="_blank" class="text-gray-800 hover:text-black text-2xl"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>

            <!-- Profil Pimpinan -->
            @if($ppidPelaksana->pejabat)
            <div class="col-span-1 bg-gray-50 p-5 rounded-xl border border-gray-100 flex flex-col items-center text-center">
                <h3 class="text-md font-bold text-gray-800 mb-4 w-full border-b border-gray-200 pb-2">Pimpinan Instansi</h3>
                
                @if($ppidPelaksana->pejabat->foto)
                    <img src="{{ asset('storage/' . $ppidPelaksana->pejabat->foto) }}" alt="{{ $ppidPelaksana->pejabat->nama }}" class="w-32 h-32 rounded-full object-cover shadow mb-4 border-4 border-white">
                @else
                    <div class="w-32 h-32 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-4xl shadow mb-4 border-4 border-white">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
                
                <h4 class="font-bold text-gray-900 text-lg">{{ $ppidPelaksana->pejabat->nama }}</h4>
                <p class="text-sm text-blue-700 font-medium mb-2">{{ $ppidPelaksana->pejabat->jabatan_keterangan ?? $ppidPelaksana->pejabat->instansi }}</p>
                
                <div class="text-xs text-gray-600 space-y-1 w-full text-left mt-2 bg-white p-3 rounded border border-gray-100">
                    <p><span class="font-semibold">NIP:</span> {{ $ppidPelaksana->pejabat->nip ?? '-' }}</p>
                    <p><span class="font-semibold">Pangkat:</span> {{ $ppidPelaksana->pejabat->pangkat ?? '-' }}</p>
                    <p><span class="font-semibold">Gol:</span> {{ $ppidPelaksana->pejabat->golongan ?? '-' }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($ppidPelaksana->map_url)
    <!-- Peta Lokasi -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-blue-800 pb-2 mb-4">Lokasi Kantor</h3>
        <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="w-full h-[350px] md:h-[400px] rounded-lg overflow-hidden relative group">
                @php
                    $mapUrl = $ppidPelaksana->map_url;
                    $embedUrl = $mapUrl;
                    $isIframe = str_contains($mapUrl, '<iframe');
                    $canEmbed = true;

                    if (!$isIframe) {
                        if (!str_contains($mapUrl, 'output=embed') && !str_contains($mapUrl, '/embed')) {
                            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $mapUrl, $matches)) {
                                $embedUrl = "https://maps.google.com/maps?q={$matches[1]},{$matches[2]}&hl=id&z=15&output=embed";
                            } else {
                                $canEmbed = false;
                            }
                        }
                    }
                @endphp

                @if($isIframe)
                    {!! $mapUrl !!}
                @elseif($canEmbed)
                    <iframe src="{{ $embedUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @else
                    <div class="flex flex-col items-center justify-center h-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg p-6 text-center">
                        <i class="fas fa-map-marked-alt text-4xl text-blue-300 mb-4"></i>
                        <h4 class="text-lg font-bold text-gray-700 mb-2">Peta Tersedia</h4>
                        <p class="text-sm text-gray-500 mb-4">Klik tombol di bawah untuk menavigasi ke lokasi instansi ini.</p>
                        <a href="{{ $mapUrl }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-md shadow-blue-100 transition-colors flex items-center gap-2">
                            <i class="fas fa-external-link-alt"></i> BUKA GOOGLE MAPS
                        </a>
                    </div>
                @endif
                <style>
                    .group iframe {
                        width: 100% !important;
                        height: 100% !important;
                    }
                </style>
            </div>
        </div>
    </div>
    @endif

    <!-- Dokumen Wajib -->
    <div class="mt-12">
        <h3 class="text-2xl font-bold text-gray-800 border-b-2 border-blue-800 pb-2 mb-6">Dokumen Wajib</h3>
        
        @if($ppidPelaksana->dokumenWajib->count() > 0)
        @php
            $dokumenKategoriList = $ppidPelaksana->dokumenWajib->pluck('kategori_dokumen')->unique();
            $dokumenGrouped = $ppidPelaksana->dokumenWajib->groupBy('kategori_dokumen');
        @endphp
        
        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 mb-6 overflow-x-auto">
            <nav class="flex space-x-2 md:space-x-8 pb-px whitespace-nowrap" aria-label="Tabs">
                <button class="tab-btn active border-blue-600 text-blue-600 border-b-2 py-3 px-2 md:px-4 text-sm font-bold transition-colors" data-target="tab-semua">
                    Semua Dokumen
                </button>
                @foreach($dokumenKategoriList as $kat)
                    <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 py-3 px-2 md:px-4 text-sm font-medium transition-colors" data-target="tab-{{ Str::slug($kat) }}">
                        {{ $kat }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Tab Contents -->
        <div class="tab-content-container relative min-h-[200px]">
            <!-- Tab: Semua -->
            <div class="tab-pane transition-opacity duration-300 ease-in-out opacity-100 block" id="tab-semua">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tahun Dokumen</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($ppidPelaksana->dokumenWajib->sortByDesc('tahun') as $index => $doc)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{{ $doc->kategori_dokumen }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600">Tahun {{ $doc->tahun }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 px-4 py-2 rounded-lg transition-colors shadow-sm">
                                            <i class="fas fa-file-pdf mr-2"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab: Kategori Spesifik -->
            @foreach($dokumenGrouped as $kat => $dokumens)
            <div class="tab-pane transition-opacity duration-300 ease-in-out opacity-0 hidden" id="tab-{{ Str::slug($kat) }}">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tahun Dokumen</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($dokumens->sortByDesc('tahun') as $index => $doc)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600">{{ $doc->kategori_dokumen }} Tahun {{ $doc->tahun }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 px-4 py-2 rounded-lg transition-colors shadow-sm">
                                            <i class="fas fa-file-pdf mr-2"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @else
        <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center text-gray-400 shadow-sm">
            <i class="fas fa-folder-open fa-3x mb-4 text-gray-200"></i>
            <p class="text-lg font-medium text-gray-500">Belum Ada Dokumen Wajib</p>
            <p class="text-sm mt-1">Instansi ini belum mengunggah dokumen wajib apapun.</p>
        </div>
        @endif
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // 1. Remove active state from all buttons
                tabBtns.forEach(b => {
                    b.classList.remove('border-blue-600', 'text-blue-600', 'font-bold');
                    b.classList.add('border-transparent', 'text-gray-500', 'font-medium');
                });
                
                // 2. Add active state to clicked button
                this.classList.remove('border-transparent', 'text-gray-500', 'font-medium');
                this.classList.add('border-blue-600', 'text-blue-600', 'font-bold');
                
                // 3. Hide all tab panes
                tabPanes.forEach(pane => {
                    pane.classList.remove('opacity-100');
                    pane.classList.add('opacity-0');
                    // Wait for fade out
                    setTimeout(() => {
                        pane.classList.remove('block');
                        pane.classList.add('hidden');
                    }, 150);
                });
                
                // 4. Show target tab pane
                const targetId = this.getAttribute('data-target');
                const targetPane = document.getElementById(targetId);
                
                if (targetPane) {
                    setTimeout(() => {
                        targetPane.classList.remove('hidden');
                        targetPane.classList.add('block');
                        // Slight delay to ensure display block is applied before opacity transition
                        setTimeout(() => {
                            targetPane.classList.remove('opacity-0');
                            targetPane.classList.add('opacity-100');
                        }, 20);
                    }, 150);
                }
            });
        });
    });
</script>
@endsection
