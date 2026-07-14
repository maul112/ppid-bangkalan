<x-admin-panel-layout>
    <x-slot name="header">Edit Hari Libur</x-slot>

    <div class="w-full pb-12">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.hari-libur.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-600 font-bold transition-colors group">
                <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg border border-gray-200 group-hover:border-red-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200">
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm font-bold">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hari-libur.update', $hariLibur->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-widest mb-2">Tanggal Libur</label>
                <input type="date" name="tanggal" required class="w-full rounded-2xl border-gray-200 focus:ring-red-500 focus:border-red-500 p-4 text-sm font-bold bg-gray-50" value="{{ old('tanggal', $hariLibur->tanggal) }}">
            </div>
            <div>
                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-widest mb-2">Keterangan / Nama Libur</label>
                <input type="text" name="keterangan" required class="w-full rounded-2xl border-gray-200 focus:ring-red-500 focus:border-red-500 p-4 text-sm font-bold bg-gray-50" value="{{ old('keterangan', $hariLibur->keterangan) }}">
            </div>
            <div class="flex pt-4 border-t border-gray-100">
                <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-xl shadow-red-200 hover:bg-red-700 transition-all">SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </div>
    </div>
</x-admin-panel-layout>
