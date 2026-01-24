<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('regulasis', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('nomor'); // Contoh: Perki No 1 Tahun 2021
        $table->string('file_pdf');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulasis');
    }
};
