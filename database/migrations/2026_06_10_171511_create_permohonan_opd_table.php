<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonan_opd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonans')->onDelete('cascade');
            $table->foreignId('opd_id')->constrained('opds')->onDelete('cascade');
            $table->text('tanggapan')->nullable();
            $table->enum('status', ['menunggu', 'ditanggapi'])->default('menunggu');
            $table->timestamp('disposisi_at')->nullable();
            $table->timestamp('tanggapi_at')->nullable();
            $table->string('file_tanggapan')->nullable();
            $table->string('link_tanggapan')->nullable();
            $table->timestamps();

            $table->unique(['permohonan_id', 'opd_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_opd');
    }
};
