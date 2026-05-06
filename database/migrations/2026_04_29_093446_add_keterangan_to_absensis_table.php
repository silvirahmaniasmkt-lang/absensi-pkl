<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('absensis', 'keterangan')) {
            Schema::table('absensis', function (Blueprint $table) {
                $table->text('keterangan')->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('absensis', 'keterangan')) {
            Schema::table('absensis', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }
    }
};