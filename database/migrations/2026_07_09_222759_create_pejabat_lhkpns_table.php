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
        Schema::create('pejabat_lhkpns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pejabat_id')->constrained('pejabats')->onDelete('cascade');
            $table->string('tahun');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat_lhkpns');
    }
};
