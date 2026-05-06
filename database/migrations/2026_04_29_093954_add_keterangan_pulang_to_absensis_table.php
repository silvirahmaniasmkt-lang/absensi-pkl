<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('absensis', 'keterangan_pulang')) {
            Schema::table('absensis', function (Blueprint $table) {
                $table->text('keterangan_pulang')->nullable()->after('jam_pulang');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('absensis', 'keterangan_pulang')) {
            Schema::table('absensis', function (Blueprint $table) {
                $table->dropColumn('keterangan_pulang');
            });
        }
    }
};