<?php

namespace App\Http\Controllers;

use App\Models\SortingLog;
use App\Models\Worker;
use App\Models\Bin;
use Illuminate\Http\Request;    

class TpaController extends Controller
{
    public function dashboard()
    {
        // 1. Data Agregat untuk Grafik (Activity 14)
        $chartData = [
            'organik' => SortingLog::where('waste_type', 'Organik')->sum('weight'),
            'anorganik' => SortingLog::where('waste_type', 'Anorganik')->sum('weight'),
            'logam' => SortingLog::where('waste_type', 'Logam')->sum('weight'),
        ];

        // 2. Statistik Makro (GZB-012)
        $stats = [
            'total_berat' => SortingLog::sum('weight'),
            'total_pekerja' => Worker::count(),
            'titik_tps' => 12, // Contoh statis jumlah titik TPS di kota
            'ekonomi_total' => SortingLog::all()->sum(function($log) {
                // Ambil harga terbaru dari tabel bins berdasarkan tipenya
                $price = Bin::where('type', $log->waste_type)->first()->price_per_kg ?? 0;
                return $log->weight * $price;
            })
        ];

        return view('tpa.dashboard', compact('chartData', 'stats'));
    }
     public function workers() {
    $workers = Worker::all();
    return view('tpa.workers', compact('workers'));
}
}