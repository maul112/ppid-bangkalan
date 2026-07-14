@extends('layouts.publik')

@section('content')
<div class="bg-gray-50 pb-20">
    <x-public-header title="Daftar Pejabat" subtitle="Daftar {{ $namaKategori }} Kabupaten Bangkalan" />

    <div class="max-w-7xl mx-auto px-4 -mt-12 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($pejabats as $p)
            <div class="bg-white rounded-[2rem] shadow-lg shadow-gray-200/50 overflow-hidden group hover:-translate-y-2 hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                <div class="relative w-full aspect-[4/5] bg-gray-100 overflow-hidden">
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <i class="fa-solid fa-user text-6xl"></i>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-sm">{{ $p->pangkat ?? 'Pegawai' }}</span>
                    </div>
                </div>
                
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-black text-gray-800 leading-tight mb-1">{{ $p->nama }}</h3>
                        <p class="text-blue-600 font-bold text-sm mb-4">{{ $p->jabatan_keterangan }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-500 mb-6 border-t border-gray-100 pt-4">
                            @if($p->instansi)
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-building text-blue-400 mt-1"></i>
                                <span>{{ $p->instansi }}</span>
                            </div>
                            @endif
                            @if($p->nip)
                            <div class="flex items-start gap-3">
                                <i class="fa-regular fa-id-card text-blue-400 mt-1"></i>
                                <span>NIP. {{ $p->nip }}</span>
                            </div>
                            @endif
                            @if($p->golongan)
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-layer-group text-blue-400 mt-1"></i>
                                <span>Gol. {{ $p->golongan }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        @if($p->lhkpns && $p->lhkpns->count() > 0)
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Dokumen LHKPN</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($p->lhkpns as $lhkpn)
                                    <a href="{{ asset('storage/'.$lhkpn->file_path) }}" target="_blank" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg text-xs font-bold transition-colors flex items-center gap-2 border border-red-100 hover:border-red-600">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        Tahun {{ $lhkpn->tahun }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-400 font-medium">
                                <i class="fa-regular fa-folder-open"></i>
                                <span>Dokumen LHKPN belum tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-[2rem] p-12 text-center shadow-lg border border-gray-100 flex flex-col items-center justify-center">
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
</div>
@endsection
