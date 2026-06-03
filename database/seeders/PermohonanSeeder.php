<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder laporan (permohonan) yang masih di tahap PPID (belum didisposisi ke OPD)
        Permohonan::create([
            'nomor_tiket' => 'TKT-' . strtoupper(uniqid()),
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '3529012345678901',
            'alamat' => 'Jl. Mawar No. 10, Bangkalan',
            'email' => 'budi@example.com',
            'no_hp' => '081234567890',
            'foto_ktp' => 'dummy_ktp.jpg',
            'rincian_informasi' => 'Mohon informasi mengenai anggaran perbaikan jalan kabupaten tahun berjalan.',
            'tujuan_penggunaan' => 'Penelitian akademik mahasiswa',
            'cara_memperoleh' => 'Melihat/Membaca/Mendengarkan/Mencatat',
            'cara_mendapatkan' => 'Mengambil Langsung',
            'status' => 'pending',
            'opd_id' => null, // Belum didisposisi
            'opd_tujuan' => 'Dinas Pekerjaan Umum',
        ]);
        
        Permohonan::create([
            'nomor_tiket' => 'TKT-' . strtoupper(uniqid()),
            'nama_pemohon' => 'Siti Aminah',
            'nik' => '3529012345678902',
            'alamat' => 'Jl. Melati No. 5, Bangkalan',
            'email' => 'siti@example.com',
            'no_hp' => '081234567891',
            'foto_ktp' => 'dummy_ktp.jpg',
            'rincian_informasi' => 'Mohon data jumlah balita stunting di Kecamatan Kamal selama 2 tahun terakhir.',
            'tujuan_penggunaan' => 'Penyusunan laporan lembaga sosial masyarakat',
            'cara_memperoleh' => 'Mendapatkan Salinan Hardcopy',
            'cara_mendapatkan' => 'Dikirim via Email',
            'status' => 'pending',
            'opd_id' => null, // Belum didisposisi
            'opd_tujuan' => 'Dinas Kesehatan',
        ]);

        Permohonan::create([
            'nomor_tiket' => 'TKT-' . strtoupper(uniqid()),
            'nama_pemohon' => 'Andi Darmawan',
            'nik' => '3529012345678903',
            'alamat' => 'Jl. Kenanga No. 2, Bangkalan',
            'email' => 'andi@example.com',
            'no_hp' => '081234567892',
            'foto_ktp' => 'dummy_ktp.jpg',
            'rincian_informasi' => 'Permohonan informasi terkait regulasi baru tentang pendaftaran UMKM secara online di Bangkalan.',
            'tujuan_penggunaan' => 'Sosialisasi ke komunitas pengusaha lokal',
            'cara_memperoleh' => 'Mendapatkan Salinan Softcopy',
            'cara_mendapatkan' => 'Dikirim via Email',
            'status' => 'pending',
            'opd_id' => null, // Belum didisposisi
            'opd_tujuan' => 'Dinas Koperasi dan UMKM',
        ]);
    }
}
