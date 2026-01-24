<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Permohonan - Admin PPID</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col sticky top-0 h-screen">
            <div class="p-6 border-b border-gray-100 text-center">
                <img src="https://ppid.bangkalankab.go.id/assets/img/logo-ppid.png" alt="Logo" class="h-10 mx-auto">
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all font-medium">Dashboard</a>
                <a href="{{ route('admin.permohonan.index') }}" class="flex items-center px-4 py-3 bg-red-600 text-white rounded-xl shadow-md font-bold">Permohonan</a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <header class="mb-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.permohonan.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">Tiket: {{ $permohonan->nomor_tiket }}</h2>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-widest">Verifikasi Berkas Masuk</p>
                    </div>
                </div>
                <div class="px-6 py-2 bg-gray-900 text-white rounded-full text-[10px] font-black tracking-widest uppercase">Admin Verificator</div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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
                                <label class="text-[10px] text-gray-400 font-bold uppercase">Email</label>
                                <p class="font-bold text-gray-700">{{ $permohonan->email }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase">Tujuan Instansi (OPD)</label>
                                <p class="font-bold text-red-600">{{ $permohonan->opd_tujuan ?? 'PPID UTAMA' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase">Tanggal Pengajuan</label>
                                <p class="font-bold text-gray-700">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>

                            <hr class="border-gray-100">
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase block mb-2">Lampiran KTP</label>
                                @if($permohonan->foto_ktp)
                                    <a href="{{ asset('uploads/ktp/' . $permohonan->foto_ktp) }}" target="_blank" class="block group">
                                        <img src="{{ asset('uploads/ktp/' . $permohonan->foto_ktp) }}" 
                                             class="w-full rounded-2xl border-2 border-gray-100 hover:border-red-200 transition-all shadow-sm" 
                                             alt="KTP Pemohon">
                                        <p class="text-[10px] text-blue-500 mt-2 font-bold italic text-center group-hover:underline">KLIK UNTUK MEMPERBESAR</p>
                                    </a>
                                @else
                                    <p class="text-xs text-red-500 italic font-bold">File KTP tidak ditemukan</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <div class="mb-8">
                            <label class="text-[10px] text-gray-400 font-bold uppercase mb-2 block tracking-widest">Informasi Yang Diminta</label>
                            <div class="p-6 bg-red-50 rounded-2xl border border-red-100 italic text-gray-800 text-lg leading-relaxed">
                                "{{ $permohonan->rincian_informasi }}"
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Tujuan Penggunaan</label>
                                <p class="text-gray-700 font-bold italic">{{ $permohonan->tujuan_penggunaan }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Cara Memperoleh</label>
                                <p class="text-gray-700 font-bold italic">{{ $permohonan->cara_memperoleh }}</p>
                            </div>
                        </div>

                        <hr class="my-10 border-gray-100">

                        <form action="{{ route('admin.permohonan.update', $permohonan->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Pilih Status Verifikasi</label>
                                <select name="status" class="w-full rounded-2xl border-gray-200 focus:border-red-600 focus:ring-0 p-4 text-sm font-bold bg-gray-50">
                                    <option value="pending" {{ $permohonan->status == 'pending' ? 'selected' : '' }}>PENDING (MENUNGGU)</option>
                                    <option value="diverifikasi" {{ $permohonan->status == 'diverifikasi' ? 'selected' : '' }}>DIVERIFIKASI (PROSES)</option>
                                    <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>SELESAI / KIRIM JAWABAN</option>
                                    <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>DITOLAK</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Tanggapan / Jawaban Resmi Admin</label>
                                <textarea name="tanggapan" rows="6" class="w-full rounded-3xl border-gray-200 focus:border-red-600 focus:ring-0 p-5 text-sm font-medium bg-gray-50" placeholder="Tuliskan jawaban permohonan atau alasan penolakan secara mendetail di sini...">{{ $permohonan->tanggapan }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-red-700 shadow-xl shadow-red-200 transition-all active:scale-95">
                                    Simpan Perubahan & Kirim
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