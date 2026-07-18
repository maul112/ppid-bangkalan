@extends('layouts.publik')
@section('title', 'Daftar ' . ucfirst($kategori) . ' PPID Pelaksana')
@section('content')
<x-public-header title="Daftar {{ ucfirst($kategori) }}" subtitle="Daftar {{ ucfirst($kategori) }} PPID Pelaksana Kabupaten Bangkalan" />
<div class="bg-gray-100 pb-20">
<div class="max-w-7xl mx-auto pt-12 px-4 sm:px-6 lg:px-8">
    <div class="pb-4 mb-6 w-full">
        <form action="{{ route('public.ppidpelaksana.index', $kategori) }}" method="GET" class="w-full">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama instansi..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow text-gray-700 bg-white shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                @if(request('search'))
                    <a href="{{ route('public.ppidpelaksana.index', $kategori) }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider w-16 text-center">No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Nama Instansi / Unit Kerja</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider hidden md:table-cell">Pimpinan</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider hidden lg:table-cell">Alamat</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($ppidPelaksanas as $index => $ppid)
                    <tr class="hover:bg-blue-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $ppidPelaksanas->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                            {{ $ppid->pejabat->instansi ?? $ppid->kategori }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 hidden md:table-cell">
                            {{ $ppid->pejabat->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">
                            <span class="truncate block max-w-xs" title="{{ $ppid->alamat }}">{{ $ppid->alamat ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('public.ppidpelaksana.show', $ppid->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-eye mr-2"></i> Profil
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-search fa-3x text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium text-gray-600">Tidak ada data instansi yang ditemukan.</p>
                                @if(request('search'))
                                    <p class="mt-1 text-sm text-gray-500">Coba gunakan kata kunci pencarian yang lain.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($ppidPelaksanas->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $ppidPelaksanas->links() }}
        </div>
        @endif
    </div>
</div>
</div>
@endsection
