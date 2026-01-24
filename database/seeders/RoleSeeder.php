<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Data OPD (Jika belum ada)
        $dinkes = Opd::firstOrCreate(['nama_opd' => 'Dinas Kesehatan'], ['singkatan' => 'Dinkes']);
        $dispenduk = Opd::firstOrCreate(['nama_opd' => 'Dinas Kependudukan'], ['singkatan' => 'Dispenduk']);

        // 2. Buat Akun Admin PPID Utama (Bangkalan)
        User::updateOrCreate(
            ['email' => 'admin_ppid@bangkalankab.go.id'],
            [
                'name' => 'Admin PPID Bangkalan',
                'nik' => '1234567890123456', // Tambahkan NIK formalitas untuk admin
                'password' => Hash::make('password123'),
                'role' => 'admin_ppid',
            ]
        );

        // 3. Buat Akun Admin OPD (Contoh: Admin Dinkes)
        User::updateOrCreate(
            ['email' => 'dinkes@mail.com'],
            [
                'name' => 'Admin OPD Kesehatan',
                'nik' => '1111111111111111', // Tambahkan NIK formalitas
                'password' => Hash::make('password123'),
                'role' => 'admin_opd',
                'opd_id' => $dinkes->id,
            ]
        );
    }
}