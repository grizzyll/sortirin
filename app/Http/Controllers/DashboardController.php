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
        // 1. Mengambil data tong sampah (GZB-004)
        $bins = Bin::all();

        // 2. Mengambil log pemilahan terakhir (GZB-006)
        // Karena sudah di-import di atas, cukup tulis SortingLog::
        $recentLogs = SortingLog::latest()->take(5)->get();

        // 3. Logika Estimasi Nilai Ekonomi (Activity 13)
        // Rumus: Kapasitas(%) * 0.5kg (asumsi) * Harga/Kg
        $totalEkonomi = 0;
        foreach($bins as $bin) {
            // Kita bagi 100 jika capacity adalah 0-100 agar menjadi persentase decimal
            $totalEkonomi += (($bin->capacity / 100) * 0.5 * $bin->price_per_kg);
        }

        return view('dashboard', compact('bins', 'recentLogs', 'totalEkonomi'));
    }

    public function updateHarga(Request $request, $id)
    {
        // Validasi: Harga harus angka dan minimal 0
        $request->validate([
            'price' => 'required|numeric|min:0'
        ]);

        $bin = Bin::findOrFail($id);
        $bin->update([
            'price_per_kg' => $request->price
        ]);

        // Kirim notifikasi sukses ke view
        return back()->with('success', 'Harga ' . $bin->type . ' berhasil diperbarui!');
    }
}