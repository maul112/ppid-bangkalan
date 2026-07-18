<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PpidPelaksanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $excludedCategories = ['Bupati', 'Wakil Bupati', 'Sekda', 'Asisten', 'Staf Ahli'];
        $pejabats = \App\Models\Pejabat::whereNotIn('kategori_pejabat', $excludedCategories)->get();

        foreach ($pejabats as $pejabat) {
            $kategoriPejabat = $pejabat->kategori_pejabat;
            
            // Map kategori: remove "Kepala " if exists
            $kategoriPpid = str_replace('Kepala ', '', $kategoriPejabat);

            $ppidPelaksana = \App\Models\PpidPelaksana::create([
                'kategori' => $kategoriPpid,
                'pejabat_id' => $pejabat->id,
                'alamat' => 'Jl. Pemuda No. 1, Bangkalan',
                'telepon' => '031-123456',
                'email' => 'info@bangkalan.go.id',
                'website' => 'https://bangkalan.go.id',
                'sosmed_facebook' => 'pemkab.bangkalan',
                'sosmed_instagram' => '@pemkab.bangkalan',
            ]);

            // Create some random documents
            $kategoriDokumens = ['SOTK', 'RENSTRA', 'IKU', 'RKT', 'PK'];
            foreach ($kategoriDokumens as $katDoc) {
                \App\Models\PpidDokumenWajib::create([
                    'ppid_pelaksana_id' => $ppidPelaksana->id,
                    'kategori_dokumen' => $katDoc,
                    'tahun' => 2023,
                    'file_path' => 'dokumen_wajib/dummy.pdf',
                ]);
            }
        }
    }
}
