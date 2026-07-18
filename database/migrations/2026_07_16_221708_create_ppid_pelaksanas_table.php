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
        Schema::create('ppid_pelaksanas', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->foreignId('pejabat_id')->nullable()->constrained('pejabats')->nullOnDelete();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('map_url')->nullable();
            $table->string('sosmed_facebook')->nullable();
            $table->string('sosmed_instagram')->nullable();
            $table->string('sosmed_youtube')->nullable();
            $table->string('sosmed_tiktok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_pelaksanas');
    }
};
