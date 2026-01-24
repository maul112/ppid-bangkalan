<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Permohonan - PPID Bangkalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 antialiased">

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center">
                <i class="fa-solid fa-circle-check mr-3 text-xl"></i>
                <div>
                    <p class="font-bold">Berhasil Terdaftar!</p>
                    <p class="text-sm">Silakan simpan atau cetak bukti permohonan dengan nomor tiket di bawah ini.</p>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                
                <div class="bg-blue-900 p-8 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <p class="text-blue-300 text-xs font-bold uppercase tracking-widest mb-1">Nomor Tiket Permohonan</p>
                            <h2 class="text-3xl font-black uppercase">{{ $permohonan->nomor_tiket }}</h2>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-lg border border-white/20 text-right">
                                <p class="text-blue-300 text-[10px] font-bold uppercase">Status Saat Ini</p>
                                <span class="inline-block mt-1 px-3 py-1 rounded-full text-[10px] font-black uppercase
                                    @if($permohonan->status == 'pending') bg-yellow-400 text-yellow-900 
                                    @elseif($permohonan->status == 'diverifikasi') bg-blue-400 text-blue-900 
                                    @elseif($permohonan->status == 'selesai') bg-green-400 text-green-900 
                                    @else bg-red-400 text-red-900 @endif">
                                    {{ $permohonan->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Header Info - Disederhanakan --}}
                <div class="bg-blue-50 px-8 py-4 border-b border-blue-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-calendar-check text-blue-600"></i>
                        <div>
                            <p class="text-[10px] text-blue-400 font-bold uppercase tracking-tighter">Tanggal Pengajuan</p>
                            <p class="text-sm font-bold text-blue-800">{{ $permohonan->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-blue-400 font-bold uppercase tracking-tighter">Unit Pengelola</p>
                        <p class="text-sm font-bold text-blue-800 uppercase">PPID KABUPATEN BANGKALAN</p>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4 border-b pb-2 flex items-center gap-2">
                                <i class="fa-solid fa-user text-[10px]"></i> Profil Pemohon
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase">Nama Lengkap</p>
                                    <p class="font-bold text-gray-800">{{ $permohonan->nama_pemohon }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase">NIK (Disamarkan)</p>
                                    <p class="font-bold text-gray-800">{{ Str::mask($permohonan->nik, '*', 8) }}</p> 
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase">Lampiran Identitas (KTP)</p>
                                    <div class="mt-2">
                                        @if($permohonan->foto_ktp)
                                            <a href="{{ asset('uploads/ktp/' . $permohonan->foto_ktp) }}" target="_blank" class="group relative inline-block">
                                                <img src="{{ asset('uploads/ktp/' . $permohonan->foto_ktp) }}" 
                                                     class="h-24 w-40 object-cover rounded-lg border-2 border-gray-200 shadow-sm group-hover:opacity-75 transition" 
                                                     alt="KTP {{ $permohonan->nama_pemohon }}">
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                                    <i class="fa-solid fa-magnifying-glass-plus text-white text-xl"></i>
                                                </div>
                                            </a>
                                        @else
                                            <p class="text-xs text-red-500 italic">Foto KTP tidak tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4 border-b pb-2 flex items-center gap-2">
                                <i class="fa-solid fa-circle-info text-[10px]"></i> Detail Informasi
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase">Informasi Yang Diminta</p>
                                    <div class="mt-1 p-3 bg-gray-50 rounded-lg border border-gray-100">
                                        <p class="text-sm text-gray-700 leading-relaxed font-medium">"{{ $permohonan->rincian_informasi }}"</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase">Tujuan Penggunaan</p>
                                    <p class="text-sm text-gray-700 leading-relaxed italic">-- {{ $permohonan->tujuan_penggunaan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-reply-all"></i> Tanggapan / Jawaban PPID
                        </h3>
                        
                        @if($permohonan->tanggapan) 
                            <div class="p-6 bg-blue-50 border-2 border-blue-100 rounded-2xl relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-2">
                                    <i class="fa-solid fa-quote-right text-blue-100 text-4xl"></i>
                                </div>
                                <p class="text-gray-800 whitespace-pre-wrap leading-relaxed relative z-10 font-medium">
                                    {{ $permohonan->tanggapan }}
                                </p>
                                
                                @if($permohonan->file_jawaban) 
                                    <div class="mt-6 pt-4 border-t border-blue-200">
                                        <a href="{{ asset('storage/' . $permohonan->file_jawaban) }}" target="_blank" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">
                                            <i class="fa-solid fa-file-arrow-down mr-2"></i> Unduh Lampiran Informasi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="p-10 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl text-center">
                                <i class="fa-solid fa-hourglass-half text-3xl text-gray-300 mb-4 block animate-pulse"></i>
                                <p class="text-gray-500 font-bold">Permohonan Sedang Diproses</p>
                                <p class="text-gray-400 text-xs mt-1">Tim PPID akan melakukan verifikasi berkas. Silakan cek berkala halaman ini.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4 no-print">
                        <button onclick="window.print()" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition flex items-center justify-center border border-gray-200">
                            <i class="fa-solid fa-print mr-2"></i> Cetak Bukti
                        </button>
                        <a href="/" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center shadow-lg shadow-blue-200">
                            <i class="fa-solid fa-house mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
            
            <p class="text-center text-gray-400 text-[10px] mt-6 font-bold uppercase tracking-widest">
                &copy; {{ date('Y') }} PPID Kabupaten Bangkalan
            </p>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .shadow-xl { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</body>
</html>