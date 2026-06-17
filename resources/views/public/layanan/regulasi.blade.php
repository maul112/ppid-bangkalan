@extends('layouts.publik')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb Navigation --}}
        <nav class="flex mb-10" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-600 font-medium flex items-center transition">
                        <i class="fa-solid fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-gray-600 font-bold">Regulasi & Kebijakan</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Uniform Header Design --}}
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Regulasi & Kebijakan</h1>
            <div class="mt-4 mx-auto h-1 w-20 bg-blue-600 rounded-full"></div>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Daftar peraturan, kebijakan, dan dasar hukum keterbukaan informasi publik di Kabupaten Bangkalan.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-600">
                            <th class="py-5 px-8 text-[11px] font-black text-white uppercase tracking-widest border-b border-gray-100">Nomor Regulasi</th>
                            <th class="py-5 px-8 text-[11px] font-black text-white uppercase tracking-widest border-b border-gray-100">Tentang / Judul</th>
                            <th class="py-5 px-8 text-[11px] font-black text-white uppercase tracking-widest border-b border-gray-100 text-center w-32">Unduh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($regulasis as $regulasi)
                        <tr class="hover:bg-blue-50/50 transition duration-150 group">
                            <td class="py-5 px-8 whitespace-nowrap">
                                <span class="font-bold text-gray-800">{{ $regulasi->nomor }}</span>
                            </td>
                            <td class="py-5 px-8">
                                <p class="text-gray-700 font-medium group-hover:text-blue-700 transition">{{ $regulasi->judul }}</p>
                            </td>
                            <td class="py-5 px-8 text-center whitespace-nowrap">
                                <a href="{{ asset('uploads/regulasi/' . $regulasi->file_pdf) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition shadow-sm" title="Unduh PDF">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-16 text-center">
                                <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-scale-balanced text-3xl"></i>
                                </div>
                                <p class="text-gray-400 font-bold italic">Belum ada regulasi yang diterbitkan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-6 bg-gray-50 border-t border-gray-100">
                {{ $regulasis->links() }}
            </div>
        </div>
    </div>
@endsection
