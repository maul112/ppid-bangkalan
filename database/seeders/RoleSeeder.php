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
        $disdik = Opd::firstOrCreate(['nama_opd' => 'Dinas Pendidikan'], ['singkatan' => 'Disdik']);
        $pu = Opd::firstOrCreate(['nama_opd' => 'Dinas Pekerjaan Umum'], ['singkatan' => 'PU']);
        $bksdm = Opd::firstOrCreate(['nama_opd' => 'badankepegawaiandansumberdayamanusia'], ['singkatan' => 'bksdm']);
        $bkbp = Opd::firstOrCreate(['nama_opd' => 'Badan Kesatuan Bangsa dan Politik'], ['singkatan' => 'BKBP']);
        $bpbd = Opd::firstOrCreate(['nama_opd' => 'Badan Penanggulangan Bencana Daerah'], ['singkatan' => 'BPBD']);

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

        User::updateOrCreate(
            ['email' => 'disdik@mail.com'],
            [
                'name' => 'Admin OPD Pendidikan',
                'nik' => '2222222222222222',
                'password' => Hash::make('password123'),
                'role' => 'admin_opd',
                'opd_id' => $disdik->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'pu@mail.com'],
            [
                'name' => 'Admin OPD PU',
                'nik' => '3333333333333333',
                'password' => Hash::make('password123'),
                'role' => 'admin_opd',
                'opd_id' => $pu->id,
            ]
        );
    }
}