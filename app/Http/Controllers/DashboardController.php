<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Worker;
use App\Models\SortingLog;
use App\Models\Location; // Pastikan Model Location di-import
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    // 1. Lokasi + bins per wilayah
    $locations = \App\Models\Location::with('bins')->get();

    // 2. Semua bins flat (untuk cek sensor)
    $bins = \App\Models\Bin::all();

    // 3. Log terbaru
    $recentLogs = \App\Models\SortingLog::latest()->take(5)->get();

    // 4. Total ekonomi — INI YANG KAMU HAPUS
    $totalEkonomi = 0;
    foreach($bins as $bin) {
        $beratDalamKg = $bin->capacity / 10;
        $totalEkonomi += ($beratDalamKg * $bin->price_per_kg);
    }

    // 5. Rata-rata kapasitas per tipe (fix yang aku kasih)
    $avgKapasitas = \App\Models\Bin::selectRaw('type, AVG(capacity) as avg_capacity, AVG(price_per_kg) as avg_price')
        ->groupBy('type')
        ->get()
        ->keyBy('type');

    return view('dashboard', compact('locations', 'bins', 'recentLogs', 'totalEkonomi', 'avgKapasitas'));
}
}