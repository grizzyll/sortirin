<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TpaController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;

// 1. ROUTE UTAMA
Route::get('/', function () {
    return redirect('/login');
});

// 2. ROUTE SETELAH LOGIN (Bisa diakses semua role)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    // Tambahkan Rute Profile ini agar tidak error (Kebutuhan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. KHUSUS OPERATOR TPS
Route::middleware(['auth', 'App\Http\Middleware\CheckRole:tps'])->group(function () {
    Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');
    Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');
    Route::delete('/workers/{id}', [WorkerController::class, 'destroy'])->name('workers.destroy');
    
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/download-pdf', [ScheduleController::class, 'exportPdf'])->name('schedules.pdf');
    
    
    Route::post('/update-harga/{id}', [DashboardController::class, 'updateHarga'])->name('update.harga');
});

// 4. KHUSUS OPERATOR TPA
Route::middleware(['auth', 'App\Http\Middleware\CheckRole:tpa'])->group(function () {
    Route::get('/tpa/dashboard', [TpaController::class, 'dashboard'])->name('tpa.dashboard');
    Route::get('/tpa/workers', [TpaController::class, 'workers'])->name('tpa.workers');
});

require __DIR__.'/auth.php';