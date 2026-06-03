<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Opd;

class OpdUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Badan Kepegawaian dan Sumber Daya Manusia', 'email' => 'badankepegawaiandansumberdayamanusia@gmail.com', 'password' => 'bkd01bk'],
            ['nama' => 'Badan Kesatuan Bangsa dan Politik', 'email' => 'badankesatuanbangsadampolitik@gmail.com', 'password' => 'kesbang02'],
            ['nama' => 'Badan Penanggulangan Bencana Daerah', 'email' => 'badanpenanggulanganbencanadaerah@gmail.com', 'password' => 'bpbd03bk'],
            ['nama' => 'Badan Pendapatan Daerah', 'email' => 'badanpendapatandaerah@gmail.com', 'password' => 'bapenda04'],
            ['nama' => 'Badan Pengelola Aset dan Keuangan Daerah', 'email' => 'badanpengelolaasetdankeuangandaerah@gmail.com', 'password' => 'bpkad05bk'],
            ['nama' => 'Badan Perencanaan Pembangunan dan Riset Daerah', 'email' => 'badanperencanaanpembangunandanrisetdaerah@gmail.com', 'password' => 'bappeda06'],
            ['nama' => 'Dinas Kebudayaan dan Pariwisata', 'email' => 'dinaskebudayaandanpariwisata@gmail.com', 'password' => 'dispar07bk'],
            ['nama' => 'Dinas Keluarga Berencana Pemberdayaan Perempuan dan Perlindungan Anak', 'email' => 'dinaskeluargaberencanapemberdayaanperempuandanperlindungananak@gmail.com', 'password' => 'dpppa08bk'],
            ['nama' => 'Dinas Kependudukan dan Pencatatan Sipil', 'email' => 'dinaskependudukandanpencatatansipil@gmail.com', 'password' => 'dukcapil09'],
            ['nama' => 'Dinas Kesehatan', 'email' => 'dinaskesehatan@gmail.com', 'password' => 'dinkes10bk'],
            ['nama' => 'Dinas Komunikasi dan Informatika', 'email' => 'dinaskomunikasidaninformatika@gmail.com', 'password' => 'kominfo11'],
            ['nama' => 'Dinas Koperasi Usaha Mikro dan Perdagangan', 'email' => 'dinaskoperasiusahamikrodanperdagangan@gmail.com', 'password' => 'disdag12bk'],
            ['nama' => 'Dinas Lingkungan Hidup', 'email' => 'dinaslingkunganhidup@gmail.com', 'password' => 'dlh13bk'],
            ['nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang', 'email' => 'dinaspekerjaanumumdanpenataanruang@gmail.com', 'password' => 'pupr14bk'],
            ['nama' => 'Dinas Pemberdayaan Masyarakat Desa', 'email' => 'dinaspemberdayaanmasyarakatdesa@gmail.com', 'password' => 'dpmd15bk'],
            ['nama' => 'Dinas Pemuda dan Olahraga', 'email' => 'dinaspemudadanolahraga@gmail.com', 'password' => 'dispora16'],
            ['nama' => 'Dinas Penanaman Modal dan Perijinan Terpadu', 'email' => 'dinaspenanamanmodaldanperijinanterpadu@gmail.com', 'password' => 'dpmptsp17'],
            ['nama' => 'Dinas Pendidikan', 'email' => 'dinaspendidikan@gmail.com', 'password' => 'disdik18bk'],
            ['nama' => 'Dinas Perhubungan', 'email' => 'dinasperhubungan@gmail.com', 'password' => 'dishub19bk'],
            ['nama' => 'Dinas Perindustrian dan Ketenagakerjaan', 'email' => 'dinasperindustriandanketenagakerjaan@gmail.com', 'password' => 'disnaker20'],
            ['nama' => 'Dinas Perpustakaan dan Kearsipan', 'email' => 'dinasperpustakaandankearsipan@gmail.com', 'password' => 'perpus21bk'],
            ['nama' => 'Dinas Pertanian Perikanan dan Ketahanan Pangan', 'email' => 'dinaspertanianperikanandanketahananpangan@gmail.com', 'password' => 'distan22bk'],
            ['nama' => 'Dinas Perumahan Rakyat dan Kawasan Pemukiman', 'email' => 'dinasperumahanrakyatdankawasanpemukiman@gmail.com', 'password' => 'perkim23bk'],
            ['nama' => 'Dinas Peternakan dan Kesehatan Hewan', 'email' => 'dinaspeternakandankesehatanhewan@gmail.com', 'password' => 'disnak24bk'],
            ['nama' => 'Inspektorat', 'email' => 'inspektorat@gmail.com', 'password' => 'insp25bk'],
            ['nama' => 'Kecamatan Arosbaya', 'email' => 'kecamatanarosbaya@gmail.com', 'password' => 'arosbaya26'],
            ['nama' => 'Kecamatan Bangkalan', 'email' => 'kecamatanbangkalan@gmail.com', 'password' => 'bangkalan27'],
            ['nama' => 'Kecamatan Blega', 'email' => 'kecamatanblega@gmail.com', 'password' => 'blega28bk'],
            ['nama' => 'Kecamatan Burneh', 'email' => 'kecamatanburneh@gmail.com', 'password' => 'burneh29bk'],
            ['nama' => 'Kecamatan Galis', 'email' => 'kecamatangalis@gmail.com', 'password' => 'galis30bk'],
            ['nama' => 'Kecamatan Geger', 'email' => 'kecamatangeger@gmail.com', 'password' => 'geger31bk'],
            ['nama' => 'Kecamatan Kamal', 'email' => 'kecamatankamal@gmail.com', 'password' => 'kamal32bk'],
            ['nama' => 'Kecamatan Klampis', 'email' => 'kecamatanklampis@gmail.com', 'password' => 'klampis33bk'],
            ['nama' => 'Kecamatan Kokop', 'email' => 'kecamatankokop@gmail.com', 'password' => 'kokop34bk'],
            ['nama' => 'Kecamatan Konang', 'email' => 'kecamatankonang@gmail.com', 'password' => 'konang35bk'],
            ['nama' => 'Kecamatan Kwanyar', 'email' => 'kecamatankwanyar@gmail.com', 'password' => 'kwanyar36bk'],
            ['nama' => 'Kecamatan Labang', 'email' => 'kecamatanlabang@gmail.com', 'password' => 'labang37bk'],
            ['nama' => 'Kecamatan Modung', 'email' => 'kecamatanmodung@gmail.com', 'password' => 'modung38bk'],
            ['nama' => 'Kecamatan Sepulu', 'email' => 'kecamatansepulu@gmail.com', 'password' => 'sepulu39bk'],
            ['nama' => 'Kecamatan Socah', 'email' => 'kecamatansocah@gmail.com', 'password' => 'socah40bk'],
            ['nama' => 'Kecamatan Tanah Merah', 'email' => 'kecamatantanahmerah@gmail.com', 'password' => 'tanahmerah41'],
            ['nama' => 'Kecamatan Tanjung Bumi', 'email' => 'kecamatantanjungbumi@gmail.com', 'password' => 'tanjungbumi42'],
            ['nama' => 'Kecamatan Tragah', 'email' => 'kecamatantragah@gmail.com', 'password' => 'tragah43bk'],
            ['nama' => 'PD Bank Pasar', 'email' => 'pdbankpasar@gmail.com', 'password' => 'bankpasar44'],
            ['nama' => 'PD Sumber Daya', 'email' => 'pdsumberdaya@gmail.com', 'password' => 'sumberdaya45'],
            ['nama' => 'PDAM Sumber Sejahtera', 'email' => 'pdamsumbersejahtera@gmail.com', 'password' => 'pdam46bk'],
            ['nama' => 'Satuan Polisi Pamong Praja', 'email' => 'satuanpolisipamongpraja@gmail.com', 'password' => 'satpolpp47'],
            ['nama' => 'Sekretariat Daerah', 'email' => 'sekretariatdaerah@gmail.com', 'password' => 'setda48bk'],
            ['nama' => 'Sekretariat Dewan Perwakilan Daerah', 'email' => 'sekretariatdewanperwakilandaerah@gmail.com', 'password' => 'setwan49bk'],
            ['nama' => 'UOBK RSUD Syamrabu Bangkalan', 'email' => 'uobkrsudsyamrabubangkalan@gmail.com', 'password' => 'rsud50bk'],
        ];

        $index = 100; // Mulai index NIK dari 100 agar unik
        foreach ($data as $item) {
            $index++;
            
            // Nama OPD mungkin sedikit berbeda dengan data sebelumnya (misal uppercase vs titlecase), 
            // jadi kita gunakan singkatan dari prefix email
            $singkatan = explode('@', $item['email'])[0];

            // 1. Sinkronisasi OPD (Cocokkan dengan nama_opd agar tidak dobel jika sudah ada)
            $opd = Opd::whereRaw('LOWER(nama_opd) = ?', [strtolower($item['nama'])])->first();
            
            if (!$opd) {
                $opd = Opd::create([
                    'nama_opd' => $item['nama'],
                    'singkatan' => $singkatan,
                ]);
            } else {
                // Update singkatan jika sebelumnya belum sesuai
                $opd->update(['singkatan' => $singkatan]);
            }

            // 2. Buat User / Admin OPD
            $nik = str_pad($index, 16, '0', STR_PAD_LEFT);
            
            $user = User::where('email', $item['email'])->first();
            if (!$user) {
                User::create([
                    'name' => $item['nama'],
                    'email' => $item['email'],
                    'password' => Hash::make($item['password']),
                    'role' => 'admin_opd',
                    'opd_id' => $opd->id,
                    'nik' => $nik,
                ]);
            } else {
                $user->update([
                    'password' => Hash::make($item['password']),
                    'opd_id' => $opd->id,
                ]);
            }
        }
    }
}
