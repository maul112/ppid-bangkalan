<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('permohonans', function (Blueprint $table) {
        // Menambahkan kolom identitas jika belum ada
        if (!Schema::hasColumn('permohonans', 'nama_pemohon')) {
            $table->string('nama_pemohon')->after('nomor_tiket');
            $table->string('nik')->after('nama_pemohon');
            $table->text('alamat')->after('nik');
            $table->string('email')->after('alamat');
            $table->string('no_hp')->after('email');
            $table->string('foto_ktp')->after('no_hp');
        }
        
        // Membuat user_id boleh kosong (nullable) karena akses publik
        $table->foreignId('user_id')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
