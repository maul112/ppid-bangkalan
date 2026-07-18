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
        Schema::create('ppid_dokumen_wajibs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppid_pelaksana_id')->constrained('ppid_pelaksanas')->cascadeOnDelete();
            $table->string('kategori_dokumen'); // SOTK, RENSTRA, IKU, RKT, PK, dll
            $table->year('tahun');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_dokumen_wajibs');
    }
};
