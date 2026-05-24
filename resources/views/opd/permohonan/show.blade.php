<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Permohonan - OPD Bangkalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col h-screen sticky top-0">
            <div class="p-6 border-b border-gray-100">
                <img src="{{ asset('img/logo-ppid.png') }}" alt="Logo" class="h-10 mx-auto">
                <p class="text-center text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Panel Kontrol</p>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.opd.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all">
                    Dashboard
                </a>
                <a href="{{ route('admin.opd.permohonan.index') }}" class="flex items-center px-4 py-3 bg-red-600 text-white rounded-xl shadow-md transition-all font-bold">
                    Permohonan Masuk
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <header class="mb-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.opd.permohonan.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">Tiket: {{ $permohonan->nomor_tiket }}</h2>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-widest">Detail Permohonan</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="px-6 py-2 bg-gray-900 text-white rounded-full text-[10px] font-black tracking-widest uppercase">Admin OPD</div>
                    <div class="px-6 py-2 {{ $permohonan->sisa_waktu <= 3 ? 'bg-red-600' : 'bg-green-600' }} text-white rounded-full text-[10px] font-black tracking-widest uppercase">
                        Sisa Waktu: {{ $permohonan->sisa_waktu }} Hari Kerja
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Info Pemohon -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center border-b pb-3 uppercase text-xs tracking-wider">Data Pemohon</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase">Nama Lengkap</label>
                                <p class="font-bold text-gray-700">{{ $permohonan->nama_pemohon }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase">NIK</label>
                                <p class="font-bold text-gray-700">{{ $permohonan->nik ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase">Tanggal Pengajuan</label>
                                <p class="font-bold text-gray-700">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Permohonan & Form Tanggapan -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <div class="mb-8">
                            <label class="text-[10px] text-gray-400 font-bold uppercase mb-2 block tracking-widest">Informasi Yang Diminta</label>
                            <div class="p-6 bg-red-50 rounded-2xl border border-red-100 italic text-gray-800 text-lg leading-relaxed">
                                "{{ $permohonan->rincian_informasi }}"
                            </div>
                        </div>

                        <hr class="my-10 border-gray-100">

                        <!-- Form Tanggapan -->
                        <form action="{{ route('admin.opd.permohonan.tanggapi', $permohonan->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Tanggapan / Jawaban OPD</label>
                                <textarea name="tanggapan" rows="6" required class="w-full rounded-3xl border-gray-200 focus:border-red-600 focus:ring-0 p-5 text-sm font-medium bg-gray-50" placeholder="Tuliskan jawaban permohonan secara mendetail di sini...">{{ $permohonan->tanggapan }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-red-700 shadow-xl shadow-red-200 transition-all active:scale-95" {{ $permohonan->status == 'selesai' ? 'disabled' : '' }}>
                                    Kirim Jawaban & Selesaikan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
