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
        Schema::table('permohonans', function (Blueprint $table) {
            $table->foreignId('opd_id')->nullable()->after('foto_ktp')->constrained('opds')->nullOnDelete();
            $table->timestamp('disposisi_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropForeign(['permohonans_opd_id_foreign']);
            $table->dropColumn(['opd_id', 'disposisi_at']);
        });
    }
};
