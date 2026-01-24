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
        // Tambahkan kolom identitas
        $table->string('nama_pemohon')->after('id');
        $table->string('nik')->after('nama_pemohon');
        $table->text('alamat')->after('nik');
        $table->string('email')->after('alamat');
        $table->string('no_hp')->after('email');
        $table->string('foto_ktp')->after('no_hp');
        
        // Ubah user_id menjadi nullable karena pemohon tidak perlu login
        $table->foreignId('user_id')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            //
        });
    }
};
