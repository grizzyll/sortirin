<?php

namespace App\Http/Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // 💡 Pastikan panggil Facade ini di atas!
use App\Models\SortingLog;      // Ganti dengan model datamu (misal SortingLog atau sejenisnya)

class ReportController extends Controller
{
    public function downloadPDF()
    {
        // 1. Tarik data riil dari database (sesuaikan dengan logic dashboard-mu)
        $totalBerat = 255.3; // Kamu bisa ganti pakai query riil: SortingLog::sum('weight') dll
        $totalEkonomi = 34000;
        $totalPekerja = 3;
        $tpsAktif = 12;

        $data = [
            'title' => 'LAPORAN REKAPITULASI PENGAWASAN SKALA KOTA - SORTIR.IN',
            'date' => date('d M Y - H:i'),
            'totalBerat' => $totalBerat,
            'totalEkonomi' => $totalEkonomi,
            'totalPekerja' => $totalPekerja,
            'tpsAktif' => $tpsAktif
        ];

        // 2. Load template blade yang nanti kita buat di Langkah 3
        $pdf = Pdf::loadView('reports.city_pdf', $data);

        // 3. Stream atau download langsung dengan nama file otomatis
        return $pdf->download('Laporan_Sortirin_' . date('Y-m-d') . '.pdf');
    }
}
