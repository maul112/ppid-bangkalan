@forelse($permohonans as $index => $item)
<tr class="hover:bg-blue-50/50 transition-colors text-sm">
    <td class="px-6 py-4 text-center font-bold text-gray-400">
        {{ $permohonans->firstItem() + $index }}
    </td>
    <td class="px-6 py-4 font-black text-blue-600">
        {{ $item->nomor_tiket }}
    </td>
    <td class="px-6 py-4 text-gray-600 font-medium">
        {{ $item->created_at->format('d/m/Y') }}
    </td>
    <td class="px-6 py-4 font-bold text-gray-800 uppercase">
        {{ Str::mask($item->nama_pemohon, '*', 3) }}
    </td>
    <td class="px-6 py-4 text-gray-600">
        <span class="line-clamp-1" title="{{ $item->rincian_informasi }}">
            {{ $item->rincian_informasi }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        @php
            $statusClasses = [
                'pending' => 'bg-gray-100 text-gray-600',
                'proses'  => 'bg-yellow-100 text-yellow-700',
                'ditolak' => 'bg-red-100 text-red-700',
                'selesai' => 'bg-green-100 text-green-700'
            ];
        @endphp
        <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-tighter {{ $statusClasses[$item->status] ?? 'bg-blue-100 text-blue-700' }}">
            {{ $item->status }}
        </span>
    </td>
    <td class="px-6 py-4 text-gray-600 text-xs italic">
        <span class="line-clamp-1" title="{{ $item->alasan_penolakan ?? '-' }}">
            {{ $item->alasan_penolakan ?? '-' }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        {{-- AKSI: Memanggil Modal NIK --}}
        <button onclick="openNikModal('{{ $item->nomor_tiket }}')" 
            class="inline-flex items-center justify-center p-2 bg-white border border-gray-200 rounded-lg text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-eye text-xs"></i>
        </button>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="px-6 py-12 text-center text-gray-400 italic">Data tidak ditemukan.</td>
</tr>
@endforelse