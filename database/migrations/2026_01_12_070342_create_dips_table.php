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
    Schema::create('dips', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('kategori'); // Berkala, Serta Merta, Setiap Saat
        $table->string('file_pdf')->nullable(); // Untuk upload dokumen
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dips');
    }
};
