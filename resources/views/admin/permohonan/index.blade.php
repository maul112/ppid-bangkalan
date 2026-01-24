<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Permohonan - Admin PPID</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col sticky top-0 h-screen">
            <div class="p-6 border-b border-gray-100 text-center">
                <img src="https://ppid.bangkalankab.go.id/assets/img/logo-ppid.png" alt="Logo" class="h-10 mx-auto">
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Panel Kontrol</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.permohonan.index') }}" class="flex items-center px-4 py-3 bg-red-600 text-white rounded-xl shadow-md font-bold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Permohonan
                </a>
            </nav>
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-red-600 font-bold bg-red-50 hover:bg-red-100 rounded-lg transition">
                        LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">Daftar Permohonan Informasi</h2>
                    <p class="text-gray-500">Kelola dan verifikasi setiap permohonan yang masuk dari masyarakat.</p>
                </div>

                <div class="flex items-center gap-2">
                    <form action="{{ route('admin.permohonan.index') }}" method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama, NIK atau tiket..." 
                               class="w-64 rounded-xl border-gray-200 text-sm focus:ring-red-500 focus:border-red-500 shadow-sm">
                        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-800 transition shadow-md">
                            CARI
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.permohonan.index') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-gray-300 transition flex items-center">
                                RESET
                            </a>
                        @endif
                    </form>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-black text-gray-500 uppercase tracking-widest">
                            <th class="p-5">Nomor Tiket</th>
                            <th class="p-5">Nama Pemohon</th>
                            <th class="p-5">Status</th>
                            <th class="p-5">Tanggal</th>
                            <th class="p-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($permohonans as $p)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-5">
                                <span class="font-mono text-red-600 font-bold bg-red-50 px-3 py-1 rounded-lg text-sm">{{ $p->nomor_tiket }}</span>
                            </td>
                            <td class="p-5">
                                <div class="font-bold text-gray-800 text-sm">{{ $p->nama_pemohon }}</div>
                                <div class="text-xs text-gray-400 italic">NIK: {{ $p->nik ?? '-' }}</div>
                            </td>
                            <td class="p-5">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter shadow-sm
                                    {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $p->status == 'diverifikasi' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $p->status == 'selesai' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $p->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="p-5 text-gray-600 text-sm">
                                {{ $p->created_at->format('d/m/Y') }}
                            </td>
                            <td class="p-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.permohonan.show', $p->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-[10px] font-bold rounded-xl hover:bg-red-600 transition shadow-sm">
                                        DETAIL
                                    </a>
                                    
                                    <form action="{{ route('admin.permohonan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus permohonan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 text-[10px] font-bold rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100">
                                            HAPUS
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($permohonans->isEmpty())
                    <div class="text-center py-20">
                        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-400 font-medium italic">Data tidak ditemukan atau belum ada permohonan.</p>
                    </div>
                @endif
            </div>

            <div class="mt-6">
    {{ $permohonans->appends(request()->query())->links() }}
</div>
        </main>
    </div>
</body>
</html>