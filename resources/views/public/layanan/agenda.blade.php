@extends('layouts.publik')

@section('content')
    <x-public-header title="Agenda Kegiatan" subtitle="Layanan Informasi" />

    <div class="max-w-7xl mx-auto pb-16 pt-8 px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-gray-500 text-lg font-medium">Informasi jadwal dan agenda kegiatan Pemerintah Kabupaten Bangkalan.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <form action="{{ route('public.layanan_agenda') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau uraian..." class="flex-1 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3">
                <select name="status" class="w-full md:w-48 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition-all px-4 py-3 cursor-pointer">
                    <option value="">Semua Status</option>
                    @foreach(['Hari Ini', 'Mendatang', 'Lewat'] as $stat)
                        <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>{{ $stat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-colors shadow-lg shadow-blue-200 whitespace-nowrap">
                    <i class="fa-solid fa-search mr-2"></i> CARI AGENDA
                </button>
            </form>
        </div>

        <!-- Table Data -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="bg-gray-800 text-white text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-bold rounded-tl-2xl">No</th>
                            <th class="px-6 py-4 font-bold">Waktu & Tanggal</th>
                            <th class="px-6 py-4 font-bold">Judul</th>
                            <th class="px-6 py-4 font-bold">Uraian</th>
                            <th class="px-6 py-4 font-bold">Lokasi</th>
                            <th class="px-6 py-4 font-bold">Peserta</th>
                            <th class="px-6 py-4 font-bold">Jumlah</th>
                            <th class="px-6 py-4 font-bold">Keterangan</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold rounded-tr-2xl">Dibuat Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($agendas as $index => $agenda)
                            <tr class="hover:bg-gray-50 transition-colors odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500 font-medium">
                                    {{ $agendas->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                                    <div class="font-bold text-blue-600">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $agenda->waktu ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900 min-w-[200px]">
                                    {{ $agenda->judul }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 min-w-[250px] whitespace-pre-line">
                                    {{ $agenda->uraian }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 min-w-[150px]">
                                    {{ $agenda->lokasi }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $agenda->peserta ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $agenda->jumlah_peserta ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 min-w-[150px]">
                                    {{ $agenda->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($agenda->status == 'Hari Ini')
                                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Hari Ini</span>
                                    @elseif($agenda->status == 'Mendatang')
                                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Mendatang</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Lewat</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-700 whitespace-nowrap">
                                    {{ $agenda->dibuat_oleh }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Belum ada data agenda yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($agendas->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $agendas->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
