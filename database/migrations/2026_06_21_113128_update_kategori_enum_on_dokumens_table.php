<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE dokumens
            MODIFY kategori ENUM(
                'SOP',
                'Dasar Hukum',
                'Alur Pelayanan',
                'Laporan PPID'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE dokumens
            MODIFY kategori ENUM(
                'SOP',
                'Dasar Hukum'
            ) NOT NULL
        ");
    }
};