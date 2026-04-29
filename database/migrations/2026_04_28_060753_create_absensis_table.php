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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // RELASI KE USER
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // TANGGAL ABSEN
            $table->date('tanggal');

            // JAM
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();

            // STATUS
            $table->enum('status', ['hadir','izin','sakit'])->default('hadir');

            // KETERANGAN
            $table->text('keterangan')->nullable();
            $table->text('keterangan_pulang')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};