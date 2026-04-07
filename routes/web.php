<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Halaman utama langsung ke dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk update harga sampah (Fitur GZB-012)
Route::post('/update-harga/{id}', [DashboardController::class, 'updateHarga'])->name('update.harga');