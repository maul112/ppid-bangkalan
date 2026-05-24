<x-admin-panel-layout>
    <x-slot name="header">Tambah Hari Libur</x-slot>

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

        <form action="{{ route('admin.hari-libur.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-widest mb-2">Tanggal Libur</label>
                <input type="date" name="tanggal" required class="w-full rounded-2xl border-gray-200 focus:ring-red-500 focus:border-red-500 p-4 text-sm font-bold bg-gray-50" value="{{ old('tanggal') }}">
            </div>
            <div>
                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-widest mb-2">Keterangan / Nama Libur</label>
                <input type="text" name="keterangan" required class="w-full rounded-2xl border-gray-200 focus:ring-red-500 focus:border-red-500 p-4 text-sm font-bold bg-gray-50" value="{{ old('keterangan') }}" placeholder="Contoh: Idul Fitri 1445 H">
            </div>
            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.hari-libur.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-gray-200 transition-all">BATAL</a>
                <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-xl shadow-red-200 hover:bg-red-700 transition-all">SIMPAN</button>
            </div>
        </form>
    </div>
</x-admin-panel-layout>
