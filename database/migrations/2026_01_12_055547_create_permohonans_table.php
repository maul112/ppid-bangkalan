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
            // Menghubungkan ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Nama kolom harus 'nomor_tiket' agar sesuai dengan Controller
            $table->string('nomor_tiket')->unique(); 
            
            $table->text('rincian_informasi');
            $table->text('tujuan_penggunaan');
            
            // Sesuai dengan pilihan di formulir.blade.php
            $table->string('cara_memperoleh'); 
            $table->string('cara_mendapatkan'); 
            
            // Status permohonan sesuai alur Use Case
            $table->enum('status', ['pending', 'diverifikasi', 'disposisi', 'selesai'])->default('pending');
            
            $table->text('tanggapan_admin')->nullable();
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