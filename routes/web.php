<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;

/* ================= AUTH ================= */
Route::get('/', [AuthController::class,'loginForm']);
Route::post('/login', [AuthController::class,'login']);

Route::get('/register', [AuthController::class,'registerForm']);
Route::post('/register', [AuthController::class,'register']);

Route::post('/logout', [AuthController::class,'logout']);

/* ================= PROTECTED ================= */
Route::middleware(['auth'])->group(function () {

    /* ================= SISWA / USER ================= */

    // Dashboard
    Route::get('/dashboard', [AbsensiController::class,'dashboard']);

    // Absen Masuk
    Route::get('/absen/masuk', [AbsensiController::class,'formMasuk']);
    Route::post('/absen/masuk', [AbsensiController::class,'masuk']);

    // Absen Pulang
    Route::get('/absen/pulang', [AbsensiController::class,'formPulang']);
    Route::post('/absen/pulang', [AbsensiController::class,'pulang']);

    // Riwayat & Rekap
    Route::get('/riwayat', [AbsensiController::class,'riwayat']);
    Route::get('/rekap', [AbsensiController::class,'rekap']);


    /* ================= ADMIN ================= */
    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class,'index']);

        // Data siswa
        Route::get('/siswa', [AdminController::class,'siswa']);

        // Data absensi
        Route::get('/absensi', [AdminController::class,'absensi']);

        // Rekap admin
        Route::get('/rekap', [AdminController::class,'rekap']);

        // HAPUS ABSENSI (FIXED)
        Route::delete('/absensi/{id}', [AdminController::class,'hapusAbsensi']);

        // HAPUS SISWA
        Route::delete('/siswa/{id}', [AdminController::class,'hapusSiswa']);
    });

});