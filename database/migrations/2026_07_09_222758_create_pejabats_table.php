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
        Schema::create('pejabats', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_pejabat', [
                'Sekda', 'Asisten', 'Staf Ahli', 'Sekretaris DPRD', 
                'Inspektur', 'Kepala Dinas', 'Kepala Badan', 'Direktur RSUD', 
                'Camat', 'Kepala Pelaksana BPBD', 'Kepala Bagian'
            ]);
            $table->string('nama');
            $table->string('jabatan_keterangan');
            $table->string('instansi')->nullable();
            $table->string('nip')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabats');
    }
};
