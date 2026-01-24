<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajukan Permohonan Informasi - PPID Bangkalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 antialiased">

    <div class="bg-blue-600 py-8 shadow-lg">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-black text-white uppercase tracking-tight">Formulir Permohonan Informasi</h2>
            <p class="text-blue-100 text-sm mt-1">Silakan isi data diri dan informasi yang Anda butuhkan di bawah ini.</p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-xl rounded-xl border border-gray-200">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc list-inside text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('permohonan.simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-700 mb-6 flex items-center">
                            <i class="fa-solid fa-user-check mr-2"></i> Identitas Pemohon
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap (Sesuai KTP)</label>
                                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">NIK (Nomor Induk Kependudukan)</label>
                                <input type="number" name="nik" value="{{ old('nik') }}" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required placeholder="16 Digit NIK">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                                <textarea name="alamat" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" rows="2" required placeholder="Alamat sesuai domisili">{{ old('alamat') }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">E-mail Aktif</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required placeholder="contoh@email.com">
                            </div>
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Nomor WhatsApp</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required placeholder="0812xxxx">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Unggah Foto KTP</label>
                                <div class="mt-1 flex items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    <input type="file" name="foto_ktp" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                </div>
                                <p class="text-[10px] text-red-500 mt-2 font-bold uppercase">* Format: JPG, PNG, PDF (Maksimal 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-8 border-gray-100">

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-700 mb-6 flex items-center">
                            <i class="fa-solid fa-file-lines mr-2"></i> Rincian Permohonan
                        </h3>
                        <div class="space-y-6">
                            {{-- Bagian Pemilihan OPD telah dihapus agar Admin yang menentukan tujuan --}}
                            
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Informasi yang Dibutuhkan</label>
                                <textarea name="rincian_informasi" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" rows="3" required placeholder="Sebutkan rincian data yang Anda minta secara spesifik">{{ old('rincian_informasi') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Tujuan Penggunaan Informasi</label>
                                <textarea name="tujuan_penggunaan" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" rows="2" required placeholder="Alasan mengapa Anda membutuhkan informasi tersebut">{{ old('tujuan_penggunaan') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Cara Memperoleh Informasi</label>
                                    <select name="cara_memperoleh" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm">
                                        <option value="Melihat/Membaca/Mendengarkan">Melihat/Membaca/Mendengarkan</option>
                                        <option value="Mendapatkan Salinan">Mendapatkan Salinan (Softcopy/Hardcopy)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Media Penyampaian Salinan</label>
                                    <select name="cara_mendapatkan" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm">
                                        <option value="Email">Melalui Email</option>
                                        <option value="WhatsApp">Melalui WhatsApp</option>
                                        <option value="Mengambil Langsung">Mengambil Langsung ke Kantor</option>
                                        <option value="Kurir/Pos">Kurir / Pos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center pt-8 border-t border-gray-100">
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200 mb-4 active:scale-95">
                            Kirim Permohonan Informasi
                        </button>
                        <a href="/" class="text-gray-400 text-sm font-bold hover:text-red-600 transition">Batal dan Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>