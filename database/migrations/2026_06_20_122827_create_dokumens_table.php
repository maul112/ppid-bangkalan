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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['SOP', 'Dasar Hukum']);
            $table->string('judul');
            $table->string('slug')->unique();
            $table->integer('tahun');
            $table->text('keterangan')->nullable();
            $table->foreignId('opd_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->integer('file_size')->default(0);
            $table->integer('dilihat')->default(0);
            $table->integer('didownload')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
