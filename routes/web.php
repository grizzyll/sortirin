<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;


// Halaman utama langsung ke dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk update harga sampah (Fitur GZB-012)
Route::post('/update-harga/{id}', [DashboardController::class, 'updateHarga'])->name('update.harga');

Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::get('/schedules/download-pdf', [ScheduleController::class, 'exportPdf'])->name('schedules.pdf');
use App\Http\Controllers\WorkerController;

Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');
Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');
Route::delete('/workers/{id}', [WorkerController::class, 'destroy'])->name('workers.destroy');