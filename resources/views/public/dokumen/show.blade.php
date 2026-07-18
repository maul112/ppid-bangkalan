@extends('layouts.publik', ['title' => 'Detail ' . $dokumen->kategori . ' - ' . $dokumen->judul])

@section('content')
    <!-- Header Section -->
    <section class="bg-blue-100 bg-opacity-20 rounded-xl text-blue-700 py-14 px-4 relative mt-10">
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <h4 class="text-3xl md:text-4xl font-bold text-blue-800 uppercase">{{ $dokumen->judul }}</h4>
            <p class="mt-4 text-lg">
                <span class="inline-block bg-yellow-400 text-black font-bold px-3 py-1 rounded-full text-sm">
                    Detail Dokumen PPID Kabupaten Bangkalan
                </span>
            </p>
        </div>
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#2563eb 1px, transparent 1px); background-size: 20px 20px;"></div>
    </section>

    <!-- Content Section -->
    <section class="py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Info Table -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <colgroup>
                            <col style="width: 20%;" class="bg-gray-800">
                            <col style="width: 80%;" class="bg-white">
                        </colgroup>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="p-4 font-bold text-white">Kategori</td>
                                <td class="p-4 font-bold text-gray-800 border-l border-gray-100">
                                    <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">{{ $dokumen->kategori }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Nama File</td>
                                <td class="p-4 font-bold text-gray-800 border-l border-gray-100">{{ $dokumen->judul }}</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Tahun</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->tahun }}</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Dilihat Sebanyak</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->dilihat }} kali</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Jumlah Download</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->didownload }} kali</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Ukuran</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">
                                    {{ number_format($dokumen->file_size / 1048576, 2) }} MB
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Keterangan</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->keterangan ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Instansi</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->opd->nama_opd ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-white">Tgl. Upload</td>
                                <td class="p-4 font-semibold text-gray-700 border-l border-gray-100">{{ $dokumen->created_at->format('d F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

<!-- PDF Viewer -->
<div class="bg-gray-100 rounded-3xl overflow-hidden shadow-inner border border-gray-200 mb-8 p-2">
    <div class="bg-white rounded-2xl overflow-hidden">
        <iframe
            src="{{ asset('storage/' . $dokumen->file_path) }}"
            class="w-full h-[600px] md:h-[800px]"
            frameborder="0">
        </iframe>
    </div>
</div>

            <!-- Download Action -->
            <div class="flex justify-end">
                <a href="{{ route('public.dokumen.download', $dokumen->slug) }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all active:scale-95 group">
                    <i class="fa-solid fa-download mr-3 group-hover:-translate-y-1 transition-transform"></i> Unduh Dokumen
                </a>
            </div>
        </div>
    </section>
@endsection
