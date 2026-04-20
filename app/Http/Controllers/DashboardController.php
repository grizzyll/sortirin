<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Worker;
use App\Models\SortingLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function index()
{
    // Mengambil data tong sampah (GZB-004)
    $bins = Bin::all();

    // Mengambil log pemilahan terakhir (GZB-006)
    $recentLogs = \App\Models\SortingLog::latest()->take(5)->get();

    // Logika Estimasi Nilai Ekonomi (Activity 13)
    // Rumus: Kapasitas(%) * 0.5kg (asumsi) * Harga/Kg
    $totalEkonomi = 0;
    foreach($bins as $bin) {
        $totalEkonomi += ($bin->capacity * 0.5 * $bin->price_per_kg);
    }

    return view('dashboard', compact('bins', 'recentLogs', 'totalEkonomi'));
}
    public function updateHarga(Request $request, $id)
    {
        $bin = Bin::findOrFail($id);
        $bin->update([
            'price_per_kg' => $request->price
        ]);

        return back()->with('success', 'Harga berhasil diperbarui!');
    }
}