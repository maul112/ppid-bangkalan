@extends('layouts.publik')

@section('content')
    <x-public-header title="LHKPN" subtitle="Daftar Informasi Publik" />

    <div class="max-w-7xl mx-auto pb-16 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="text-center max-w-3xl mx-auto mb-10 mt-8">
            <p class="text-gray-500 text-lg font-medium">Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) Pejabat Pemerintah Kabupaten Bangkalan.</p>
        </div>

        {{-- Search Form --}}
        <div class="mb-6 max-w-md mx-auto sm:mx-0 sm:ml-auto">
            <form action="{{ route('public.lhkpn') }}" method="GET" class="flex gap-2">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pejabat..." class="w-full pl-10 pr-4 py-3 rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition shadow-sm whitespace-nowrap">
                    Cari
                </button>
            </form>
        </div>

        {{-- Content --}}
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-5 px-8 text-[11px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">No</th>
                            <th class="py-5 px-8 text-[11px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Nama Pejabat</th>
                            <th class="py-5 px-8 text-[11px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Tahun Pelaporan</th>
                            <th class="py-5 px-8 text-[11px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $counter = $pejabats->firstItem(); @endphp
                        @forelse($pejabats as $pejabat)
                            @if($pejabat->lhkpns->count() > 0)
                                @foreach($pejabat->lhkpns as $lhkpn)
                                <tr class="hover:bg-blue-50/50 transition duration-150 group">
                                    <td class="py-5 px-8 whitespace-nowrap text-sm font-bold text-gray-400">
                                        {{ $counter++ }}
                                    </td>
                                    <td class="py-5 px-8">
                                        <div class="font-bold text-gray-800 text-base group-hover:text-blue-700 transition">{{ $pejabat->nama }}</div>
                                        <div class="text-xs text-gray-500 italic mt-1">{{ $pejabat->jabatan }}</div>
                                    </td>
                                    <td class="py-5 px-8">
                                        <span class="inline-flex items-center bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">{{ $lhkpn->tahun }}</span>
                                    </td>
                                    <td class="py-5 px-8 text-center whitespace-nowrap">
                                        <div class="flex justify-center">
                                            @if($lhkpn->file_path)
                                                <a href="{{ asset('uploads/lhkpn/'.$lhkpn->file_path) }}" target="_blank" 
                                                    class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition shadow-sm" title="Unduh PDF">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic text-xs font-bold">Belum ada file</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="hover:bg-blue-50/50 transition duration-150 group">
                                    <td class="py-5 px-8 whitespace-nowrap text-sm font-bold text-gray-400">
                                        {{ $counter++ }}
                                    </td>
                                    <td class="py-5 px-8">
                                        <div class="font-bold text-gray-800 text-base group-hover:text-blue-700 transition">{{ $pejabat->nama }}</div>
                                        <div class="text-xs text-gray-500 italic mt-1">{{ $pejabat->jabatan }}</div>
                                    </td>
                                    <td class="py-5 px-8 text-center">
                                        <span class="inline-flex items-center text-gray-400 px-3 py-1 rounded-full text-xs font-bold">-</span>
                                    </td>
                                    <td class="py-5 px-8 text-center whitespace-nowrap">
                                        <span class="text-gray-400 font-black text-xl">-</span>
                                    </td>
                                </tr>
                            @endif
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400 font-bold italic">Belum ada Pejabat saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pejabats->hasPages())
                <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50">
                    {{ $pejabats->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
