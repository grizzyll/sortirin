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
use App\Models\Sampah;

// 1. ROUTE UTAMA
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/monitoring/{slug}', [RegionalController::class, 'show'])->name('regional.show');
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
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    
    Route::post('/update-harga/{id}', [DashboardController::class, 'updateHarga'])->name('update.harga');
});

// 4. KHUSUS OPERATOR TPA
Route::middleware(['auth', 'App\Http\Middleware\CheckRole:tpa'])->group(function () {
    Route::get('/tpa/dashboard', [TpaController::class, 'dashboard'])->name('tpa.dashboard');
    Route::get('/tpa/workers', [TpaController::class, 'workers'])->name('tpa.workers');
});


// 5. JEMBATAN API UNTUK BIAR DASHBOARD BERGERAK REAL-TIME DARI LOADCELL
// Diletakkan di luar middleware auth agar JavaScript fetch() lancar tanpa terhadang token session login
Route::get('/api/live-dashboard', function () {
    try {
        // Ambil total nilai ekonomi dari gabungan semua log transaksi sampah
        $totalEkonomi = Sampah::sum('nilai_ekonomi') ?? 0;

        // Ambil data kapasitas persen langsung dari tabel bins (yang terus-menerus diupdate oleh MqttListener)
        $binBasah  = Bin::where('type', 'Organik')->first();
        $binKering = Bin::where('type', 'Anorganik')->first();
        $binLogam  = Bin::where('type', 'Logam')->first();

        // Ambil data berat fisik gram terakhir dari tabel log transaksi sampah untuk pemanis teks di bawah persen
        $logBasah  = Sampah::where('status', 'organik')->latest()->first();
        $logKering = Sampah::where('status', 'anorganik')->latest()->first();
        $logLogam  = Sampah::where('status', 'logam')->latest()->first();

        return response()->json([
            'status'        => 'success',
            'total_ekonomi' => number_format($totalEkonomi, 0, ',', '.'),
            
            // Mengirimkan persentase tinggi air wadah (0 sampai 100)
            'volume_basah'  => $binBasah ? $binBasah->capacity : 0,
            'volume_kering' => $binKering ? $binKering->capacity : 0,
            'volume_logam'  => $binLogam ? $binLogam->capacity : 0,
            
            // Mengirimkan string berat riil gram saat ini
            'berat_basah_format'  => ($logBasah ? number_format($logBasah->berat, 1, ',', '.') : '0.0') . ' g',
            'berat_kering_format' => ($logKering ? number_format($logKering->berat, 1, ',', '.') : '0.0') . ' g',
            'berat_logam_format'  => ($logLogam ? number_format($logLogam->berat, 1, ',', '.') : '0.0') . ' g',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

require __DIR__.'/auth.php';