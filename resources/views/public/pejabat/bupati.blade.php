@extends('layouts.publik')
@section('content')

<div class="animate__animated animate__fadeIn">
<x-public-header title="Profil {{ $namaKategori }}" subtitle="Informasi data diri, riwayat pendidikan, dan LHKPN {{ $namaKategori }}" />

    <!-- Main Content Section -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            @if($pejabat)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                
                <!-- Grid Layout (Left: Photo, Right: Info) -->
                <div class="grid md:grid-cols-[350px_1fr]">
                    <div class="flex items-center justify-center p-6">
                        @if($pejabat->foto)
                            <img src="{{ asset('storage/' . $pejabat->foto) }}" alt="Foto {{ $pejabat->nama }}" class="rounded-xl shadow-lg w-[300px] h-[450px] object-cover">
                        @else
                            <div class="rounded-xl shadow-lg w-[300px] h-[450px] bg-gray-200 flex items-center justify-center text-gray-400">
                                <i class="fa-solid fa-user text-6xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col justify-center">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $pejabat->nama }}</h2>
                        <p class="text-gray-600 text-lg font-medium mb-4">{{ $pejabat->jabatan_keterangan ?? $pejabat->instansi ?? $namaKategori }}</p>

                        <div class="space-y-3 text-gray-700">
                            @if($pejabat->nip)
                            <p><span class="font-semibold">NIP:</span> {{ $pejabat->nip }}</p>
                            @endif
                            @if($pejabat->pangkat)
                            <p><span class="font-semibold">Pangkat:</span> {{ $pejabat->pangkat }}</p>
                            @endif
                            @if($pejabat->golongan)
                            <p><span class="font-semibold">Golongan:</span> {{ $pejabat->golongan }}</p>
                            @endif
                            @if($pejabat->tempat_lahir && $pejabat->tanggal_lahir)
                            <p><span class="font-semibold">Tempat, Tanggal Lahir:</span> {{ $pejabat->tempat_lahir }}, {{ \Carbon\Carbon::parse($pejabat->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                            @endif
                            
                            @if($pejabat->riwayat_pendidikan)
                            <div>
                                <p class="font-semibold mb-1">Pendidikan:</p>
                                <div class="pl-5 list-disc space-y-1">
                                    {!! nl2br(e($pejabat->riwayat_pendidikan)) !!}
                                </div>
                            </div>
                            @endif
                            
                            @if($pejabat->riwayat_karir)
                            <div>
                                <p class="font-semibold mb-1">Riwayat Karir:</p>
                                <div class="pl-5 list-disc space-y-1">
                                    {!! nl2br(e($pejabat->riwayat_karir)) !!}
                                </div>
                            </div>
                            @endif
                            
                            @if($pejabat->penghargaan)
                            <div>
                                <p class="font-semibold mb-1">Penghargaan:</p>
                                <div class="pl-5 list-disc space-y-1">
                                    {!! nl2br(e($pejabat->penghargaan)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- LHKPN Section -->
                <div class="bg-gray-50 p-6 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Laporan Harta Kekayaan Penyelenggara Negara (LHKPN)</h3>
                    @if($pejabat->lhkpns && $pejabat->lhkpns->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <colgroup>
                                <col style="width: 90%;">
                                <col style="width: 10%;">
                            </colgroup>
                            <thead class="bg-blue-800 text-white">
                                <tr>
                                    <th class="p-2 text-left">Tahun</th>
                                    <th class="p-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pejabat->lhkpns as $lhkpn)
                                <tr class="border border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-200">
                                    <td class="p-3 border border-gray-200 font-semibold text-left">
                                        LHKPN {{ $namaKategori }} Tahun {{ $lhkpn->tahun }}
                                    </td>
                                    <td class="p-3 border border-gray-200 font-semibold text-center">
                                        <a href="{{ asset('uploads/lhkpn/'.$lhkpn->file_path) }}" 
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-zinc-800 font-medium rounded shadow-sm text-sm transition-colors whitespace-nowrap" 
                                           target="_blank">
                                            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                                <path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd"/>
                                            </svg>
                                            Lihat LHKPN
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="text-sm text-gray-500 italic p-4 bg-white border rounded">
                            Dokumen LHKPN belum tersedia
                        </div>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-white rounded-2xl shadow-lg p-10 text-center">
                <p class="text-gray-500 text-lg">Data profil {{ $namaKategori }} belum tersedia.</p>
            </div>
            @endif
        </div>
    </section>

</div>

@endsection
