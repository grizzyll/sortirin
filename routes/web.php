<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TpaController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionalController;
use App\Models\Bin;

// 1. ROUTE UTAMA
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/monitoring/{slug}', [RegionalController::class, 'show'])->name('regional.show');

// 2. ROUTE SETELAH LOGIN
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/reset-bins', function () {
        \App\Models\Bin::query()->update(['capacity' => 0, 'current_weight' => 0]);
        \App\Models\SortingLog::query()->delete();
        return response()->json(['status' => 'success']);
    })->name('reset.bins');
});

// 3. KHUSUS OPERATOR TPS
Route::middleware(['auth', 'App\Http\Middleware\CheckRole:tps'])->group(function () {
    Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');
    Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');
    Route::delete('/workers/{id}', [WorkerController::class, 'destroy'])->name('workers.destroy');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/download-pdf', [ScheduleController::class, 'exportPdf'])->name('schedules.pdf');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::post('/update-harga/{id}', [DashboardController::class, 'updateHarga'])->name('update.harga');
});

// 4. KHUSUS OPERATOR TPA
Route::middleware(['auth', 'App\Http\Middleware\CheckRole:tpa'])->group(function () {
    Route::get('/tpa/dashboard', [TpaController::class, 'dashboard'])->name('tpa.dashboard');
    Route::get('/tpa/workers', [TpaController::class, 'workers'])->name('tpa.workers');
});

// 5. JEMBATAN API REALTIME DASHBOARD
Route::get('/api/live-dashboard', function () {
    try {
        $bandulan   = \App\Models\Location::where('name', 'Bandulan')->first();
        $locationId = $bandulan ? $bandulan->id : null;

        $binBasah  = \App\Models\Bin::where('type', 'Organik')->where('location_id', $locationId)->first();
        $binKering = \App\Models\Bin::where('type', 'Anorganik')->where('location_id', $locationId)->first();
        $binLogam  = \App\Models\Bin::where('type', 'Logam')->where('location_id', $locationId)->first();

        $totalEkonomi = 0;
        if ($binBasah)  $totalEkonomi += (($binBasah->capacity  / 100) * 200 / 1000) * 2000;
        if ($binKering) $totalEkonomi += (($binKering->capacity / 100) * 200 / 1000) * 5000;
        if ($binLogam)  $totalEkonomi += (($binLogam->capacity  / 100) * 200 / 1000) * 12000;

        return response()->json([
            'status'              => 'success',
            'total_ekonomi'       => number_format($totalEkonomi, 0, ',', '.'),
            'volume_basah'        => $binBasah  ? $binBasah->capacity  : 0,
            'volume_kering'       => $binKering ? $binKering->capacity : 0,
            'volume_logam'        => $binLogam  ? $binLogam->capacity  : 0,
            'berat_basah_format'  => number_format($binBasah  ? $binBasah->current_weight  : 0, 1, ',', '.') . ' g',
            'berat_kering_format' => number_format($binKering ? $binKering->current_weight : 0, 1, ',', '.') . ' g',
            'berat_logam_format'  => number_format($binLogam  ? $binLogam->current_weight  : 0, 1, ',', '.') . ' g',
        ]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

require __DIR__.'/auth.php';
