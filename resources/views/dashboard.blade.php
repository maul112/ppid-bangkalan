<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Permohonan Informasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-600">Pantau status permohonan informasi Anda di sini.</p>
                        </div>
                        <a href="{{ route('permohonan.buat') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Ajukan Permohonan Baru') }}
                        </a>
                    </div>

                    <hr class="mb-6">

                    <h4 class="font-bold mb-4 text-blue-800">Riwayat Permohonan Informasi</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left text-xs uppercase font-bold text-gray-600 border-b">
                                    <th class="px-4 py-3">No. Tiket</th>
                                    <th class="px-4 py-3">Rincian Informasi</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse ($permohonans as $item)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-mono text-blue-600 font-bold">{{ $item->nomor_tiket }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ Str::limit($item->rincian_informasi, 50) }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if($item->status == 'pending')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Menunggu Verifikasi</span>
                                            @elseif($item->status == 'diverifikasi')
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">Diverifikasi</span>
                                            @elseif($item->status == 'selesai')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Selesai</span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Ditolak</span>
                                            @else
                                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">{{ ucfirst($item->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('permohonan.show', $item->id) }}" class="inline-block bg-gray-800 text-white px-3 py-1 rounded text-xs font-bold hover:bg-black transition">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500 italic">
                                            Belum ada data permohonan. Klik tombol di atas untuk membuat permohonan pertama Anda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>