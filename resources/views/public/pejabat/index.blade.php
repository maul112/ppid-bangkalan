@extends('layouts.publik')

@section('content')
<x-public-header title="Daftar {{ $namaKategori }}" subtitle="Daftar {{ $namaKategori }} Kabupaten Bangkalan" />
<div class="bg-gray-100 pb-20">

    <section class="py-8 px-4">
        <div class="max-w-7xl mx-auto overflow-x-auto">                        
            <div class="flex flex-wrap justify-center gap-6 pb-4">
                @forelse($pejabats as $p)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden w-[360px] flex flex-col">
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" alt="foto_pejabat_ppid" class="w-full h-[420px] object-cover">
                    @else
                        <div class="w-full h-[420px] bg-gray-200 flex items-center justify-center text-gray-400">
                            <i class="fa-solid fa-user text-6xl"></i>
                        </div>
                    @endif
                    <div class="p-5 flex-grow flex flex-col">
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $p->nama }}
                        </h2>
                        <p class="text-gray-600 font-medium mb-4">{{ $p->jabatan_keterangan ?? $p->instansi ?? $namaKategori }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-700 mb-4">
                            @if($p->nip)
                            <p><span class="font-semibold">NIP : </span> {{ $p->nip }}</p>
                            @endif
                            @if($p->pangkat)
                            <p><span class="font-semibold">Pangkat : </span> {{ $p->pangkat }}</p>
                            @endif
                            @if($p->golongan)
                            <p><span class="font-semibold">Golongan : </span> {{ $p->golongan }}</p>
                            @endif
                            @if($p->jabatan_keterangan)
                            <p><span class="font-semibold">Keterangan : </span>
                                {{ $p->jabatan_keterangan }}
                            </p>
                            @endif
                        </div>
                        
                        @if(in_array(strtolower($namaKategori), ['sekda', 'asisten', 'staf ahli']))
                        <div class="mt-auto border-t pt-3 text-sm text-gray-700">
                            @if($p->lhkpns && $p->lhkpns->count() > 0)
                                <h3 class="font-bold text-blue-800 mb-2">Daftar LHPKN:</h3>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($p->lhkpns as $lhkpn)
                                    <li>
                                        <a href="{{ asset('uploads/lhkpn/'.$lhkpn->file_path) }}" class="relative items-center font-medium justify-center gap-2 whitespace-nowrap h-6 text-xs rounded-md px-2 inline-flex bg-yellow-400 hover:bg-yellow-500 text-zinc-800 border border-zinc-200 shadow-none transition-colors" target="_blank">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z" clip-rule="evenodd"/>
                                            </svg>
                                            Tahun {{ $lhkpn->tahun }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-xs text-gray-500 italic">
                                    Dokumen LHKPN belum tersedia
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="w-full">
                    <div class="bg-white rounded-xl p-12 text-center shadow-lg border border-gray-100 flex flex-col items-center justify-center max-w-2xl mx-auto">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-6">
                            <i class="fa-solid fa-users-slash text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-800 mb-2">Belum Ada Data</h3>
                        <p class="text-gray-500">Data pejabat untuk kategori <strong>{{ $namaKategori }}</strong> saat ini belum tersedia di sistem.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
