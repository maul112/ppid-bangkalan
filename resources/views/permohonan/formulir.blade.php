@extends('layouts.publik')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Formulir Permohonan Informasi</h1>
            <div class="mt-4 mx-auto h-1 w-20 bg-blue-600 rounded-full"></div>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Silakan isi data diri dan informasi yang Anda butuhkan di bawah ini.</p>
        </div>

        <div class="max-w-4xl mx-auto">
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
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Pekerjaan</label>
                                <select name="pekerjaan" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required>
                                    <option value="">Pilih Pekerjaan...</option>
                                    <option value="Pelajar / Mahasiswa" {{ old('pekerjaan') == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                                    <option value="Aparatur Sipil Negara (ASN)" {{ old('pekerjaan') == 'Aparatur Sipil Negara (ASN)' ? 'selected' : '' }}>Aparatur Sipil Negara (ASN)</option>
                                    <option value="TNI / POLRI" {{ old('pekerjaan') == 'TNI / POLRI' ? 'selected' : '' }}>TNI / POLRI</option>
                                    <option value="Karyawan Swasta" {{ old('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                    <option value="Wiraswasta / Pengusaha" {{ old('pekerjaan') == 'Wiraswasta / Pengusaha' ? 'selected' : '' }}>Wiraswasta / Pengusaha</option>
                                    <option value="Petani" {{ old('pekerjaan') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                    <option value="Nelayan" {{ old('pekerjaan') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                    <option value="Buruh / Pekerja Lepas" {{ old('pekerjaan') == 'Buruh / Pekerja Lepas' ? 'selected' : '' }}>Buruh / Pekerja Lepas</option>
                                    <option value="Guru / Dosen" {{ old('pekerjaan') == 'Guru / Dosen' ? 'selected' : '' }}>Guru / Dosen</option>
                                    <option value="Dokter / Tenaga Medis" {{ old('pekerjaan') == 'Dokter / Tenaga Medis' ? 'selected' : '' }}>Dokter / Tenaga Medis</option>
                                    <option value="Pengacara / Konsultan Hukum" {{ old('pekerjaan') == 'Pengacara / Konsultan Hukum' ? 'selected' : '' }}>Pengacara / Konsultan Hukum</option>
                                    <option value="Ibu Rumah Tangga" {{ old('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                    <option value="Pensiunan" {{ old('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                    <option value="Tidak Bekerja" {{ old('pekerjaan') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="Lainnya" {{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
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
                                    <input type="file" name="foto_ktp" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required>
                                </div>
                                <p class="text-[10px] text-red-500 mt-2 font-bold uppercase">* Format: JPG, PNG (Maksimal 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-8 border-gray-100">

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-700 mb-6 flex items-center">
                            <i class="fa-solid fa-file-lines mr-2"></i> Rincian Permohonan
                        </h3>
                        <div class="space-y-6">
                            
                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Informasi yang Dibutuhkan/Bisa berupa link </label>
                                <textarea name="rincian_informasi" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" rows="3" required placeholder="Sebutkan rincian data yang Anda minta secara spesifik">{{ old('rincian_informasi') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Tujuan Penggunaan Informasi</label>
                                <textarea name="tujuan_penggunaan" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" rows="2" required placeholder="Alasan mengapa Anda membutuhkan informasi tersebut">{{ old('tujuan_penggunaan') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">File Pendukung (Opsional)</label>
                                <div class="mt-1 flex items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    <input type="file" name="file_pendukung" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase">* Jika ada dokumen/foto tambahan (Maksimal 10MB)</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Cara Memperoleh Informasi</label>
                                    <select name="cara_memperoleh" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required>
                                        <option value="Melihat/Membaca/Mendengarkan">Melihat/Membaca/Mendengarkan</option>
                                        <option value="Mendapatkan Salinan">Mendapatkan Salinan (Softcopy/Hardcopy)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold text-xs text-gray-500 uppercase tracking-wider mb-1">Media Penyampaian Salinan</label>
                                    <select name="cara_mendapatkan" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full text-sm" required>
                                        <option value="Email">Melalui Email</option>
                                        <option value="WhatsApp">Melalui WhatsApp</option>
                                        <option value="Mengambil Langsung">Mengambil Langsung ke Kantor</option>
                                        <option value="Kurir/Pos">Kurir / Pos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="terms" value="1" class="mt-1 border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <span class="text-sm text-gray-700 font-medium">
                                Dengan ini saya menyatakan bahwa data yang diisikan adalah benar dan dapat dipergunakan sebagaimana mestinya serta dapat pula dipertanggungjawabkan.
                            </span>
                        </label>
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
@endsection