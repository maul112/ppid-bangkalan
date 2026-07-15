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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('waktu')->nullable();
            $table->string('judul');
            $table->text('uraian');
            $table->string('lokasi');
            $table->string('peserta')->nullable();
            $table->string('jumlah_peserta')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('dibuat_oleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
