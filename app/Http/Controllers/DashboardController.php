<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data tong sampah (Organik, Anorganik, Logam)
        $bins = Bin::all();

        // Hitung total ekonomi (Asumsi sederhana: Kapasitas 1% = 0.1kg)
        $totalEkonomi = 0;
        foreach ($bins as $bin) {
            $beratEstimasi = $bin->capacity * 0.1; 
            $totalEkonomi += ($beratEstimasi * $bin->price_per_kg);
        }

        return view('dashboard', compact('bins', 'totalEkonomi'));
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