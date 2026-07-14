<x-public-layout title="{{ $kategoriTitle }}">
    <x-public-header title="{{ $kategoriTitle }}" subtitle="Daftar Dokumen {{ $kategoriTitle }} PPID" />

    <!-- Content Section -->
    <section class="py-12 bg-gray-50 min-h-[50vh]">
        <div class="max-w-6xl mx-auto px-4">
            <div class="space-y-4">
                @forelse($dokumens as $dokumen)
                    <div class="flex flex-col sm:flex-row sm:items-center bg-white p-5 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition duration-300 gap-4">
                        <a href="{{ route('public.dokumen.download', $dokumen->slug) }}" class="flex-shrink-0 w-14 h-14 flex items-center justify-center rounded-2xl border-2 border-blue-100 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition" title="Unduh Langsung">
                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                        </a>
                        <div class="flex-1">
                            <a href="{{ route('public.dokumen.show', $dokumen->slug) }}" class="text-lg font-bold text-gray-800 hover:text-blue-600 hover:underline line-clamp-2">
                                {{ $dokumen->judul }}
                            </a>
                            <div class="mt-2 flex flex-wrap items-center gap-4 text-xs text-gray-500 font-medium">
                                <span class="bg-gray-100 px-2 py-1 rounded-md"><i class="fa-solid fa-calendar-days mr-1"></i> {{ $dokumen->tahun }}</span>
                                <span><i class="fa-solid fa-eye mr-1"></i> Dilihat: {{ $dokumen->dilihat }} kali</span>
                                <span><i class="fa-solid fa-download mr-1"></i> Diunduh: {{ $dokumen->didownload }} kali</span>
                                <span class="text-gray-400"><i class="fa-solid fa-clock mr-1"></i> {{ $dokumen->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('public.dokumen.show', $dokumen->slug) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition">
                                Lihat Detail <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-3xl border border-gray-100">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-4">
                            <i class="fa-solid fa-folder-open text-3xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700">Belum Ada Dokumen</h3>
                        <p class="text-gray-500 mt-2">Dokumen untuk kategori ini belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-10">
                {{ $dokumens->links() }}
            </div>
        </div>
    </section>
</x-public-layout>
