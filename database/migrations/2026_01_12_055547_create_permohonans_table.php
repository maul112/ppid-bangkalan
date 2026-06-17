<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (nullable karena bisa guest)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
            
            // Kolom identitas pemohon
            $table->string('nama_pemohon');
            $table->string('nik');
            $table->enum('pekerjaan', [
                'Pelajar / Mahasiswa',
                'Aparatur Sipil Negara (ASN)',
                'TNI / POLRI',
                'Karyawan Swasta',
                'Wiraswasta / Pengusaha',
                'Petani',
                'Nelayan',
                'Buruh / Pekerja Lepas',
                'Guru / Dosen',
                'Dokter / Tenaga Medis',
                'Pengacara / Konsultan Hukum',
                'Ibu Rumah Tangga',
                'Pensiunan',
                'Tidak Bekerja',
                'Lainnya'
            ]);
            $table->text('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('foto_ktp');

            // Nama kolom harus 'nomor_tiket' agar sesuai dengan Controller
            $table->string('nomor_tiket')->unique(); 
            
            $table->text('rincian_informasi');
            $table->text('tujuan_penggunaan');
            
            // Sesuai dengan pilihan di formulir.blade.php
            $table->string('cara_memperoleh'); 
            $table->string('cara_mendapatkan'); 
            
            // Status permohonan sesuai alur Use Case
            $table->enum('status', ['pending', 'diverifikasi', 'disposisi', 'selesai', 'ditolak'])->default('pending');
            $table->text('tanggapan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};