<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan sudah install dompdf via composer

class ScheduleController extends Controller
{
    // Menampilkan halaman jadwal (Activity Diagram 8)
    public function index()
    {
        $schedules = Schedule::with('worker')->get();
        return view('schedules.index', compact('schedules'));
    }

    // Fitur Cetak PDF (Activity Diagram 9)
    public function exportPdf()
    {
        $schedules = Schedule::with('worker')->get();
        
        // Memanggil file view khusus untuk layout PDF
        $pdf = Pdf::loadView('pdf.schedule', compact('schedules'));
        
        // Download file PDF
        return $pdf->download('jadwal-pekerja-sortirin.pdf');
    }
}