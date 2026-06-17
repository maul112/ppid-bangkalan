@props(['title', 'dips', 'description'])

<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 min-h-screen">
    {{-- Header --}}
    <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-red-600 font-black tracking-[0.2em] uppercase text-sm mb-4 block">DAFTAR INFORMASI PUBLIK</span>
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">{{ $title }}</h1>
        <p class="text-gray-500 text-lg">{{ $description }}</p>
    </div>

    {{-- Content --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-red-500 to-orange-500"></div>
        
        <div class="p-8 md:p-12">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-black text-gray-400 uppercase tracking-[0.2em]">
                            <th class="p-5 rounded-tl-xl">No</th>
                            <th class="p-5">Judul Informasi</th>
                            <th class="p-5">Tanggal Dibuat</th>
                            <th class="p-5 text-center rounded-tr-xl">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($dips as $index => $d)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="p-5 text-sm font-bold text-gray-400">
                                {{ $dips->firstItem() + $index }}
                            </td>
                            <td class="p-5">
                                <div class="font-bold text-gray-800 text-base group-hover:text-red-600 transition-colors">{{ $d->judul }}</div>
                                <div class="text-xs text-gray-400 italic mt-1">{{ $d->kategori }}</div>
                            </td>
                            <td class="p-5">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ $d->created_at->translatedFormat('d F Y') }}</span>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center">
                                    @if($d->file_pdf)
                                        <a href="{{ asset('uploads/dip/'.$d->file_pdf) }}" target="_blank" 
                                           class="inline-flex items-center gap-2 bg-red-50 text-red-600 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Unduh PDF
                                        </a>
                                    @else
                                        <span class="text-gray-300 italic text-xs font-medium">Belum ada file</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-20 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4 text-gray-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="text-gray-400 font-bold tracking-widest text-xs uppercase">Belum ada informasi pada kategori ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $dips->links() }}
            </div>
        </div>
    </div>
</div>
