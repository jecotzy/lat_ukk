<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\IndustriController;
use App\Http\Controllers\Api\PklController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route login untuk pengguna (mengembalikan token jika sukses)
Route::post('/login', [AuthController::class, 'login']);

// Route register untuk membuat akun pengguna baru
Route::post('/register', [AuthController::class, 'register']);

// Mendapatkan data user yang sedang login
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); // Hanya bisa diakses jika sudah login

// Semua route di dalam grup ini membutuhkan autentikasi menggunakan Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // CRUD untuk resource siswa
    Route::apiResource('siswa', SiswaController::class);

    // CRUD untuk resource guru
    Route::apiResource('guru', GuruController::class);

    // CRUD untuk resource industri
    Route::apiResource('industri', IndustriController::class);

    // CRUD untuk resource PKL (Praktik Kerja Lapangan)
    Route::apiResource('pkl', PklController::class);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});
