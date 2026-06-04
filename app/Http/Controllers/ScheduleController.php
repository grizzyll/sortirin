<?php

namespace App\Http\Controllers;


use App\Models\Schedule;
use App\Models\Worker;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan huruf P besar
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $query = Schedule::with('worker');

        // Logika Filter (Sesuai Permintaan)
        if ($filter == 'today') {
            $query->whereDate('date', Carbon::today());
        } elseif ($filter == 'week') {
            $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'month') {
            $query->whereMonth('date', Carbon::now()->month)
                  ->whereYear('date', Carbon::now()->year);
        }

        $schedules = $query->orderBy('date', 'asc')->get();
        return view('schedules.index', compact('schedules'));
    }

    // app/Http/Controllers/ScheduleController.php

public function store(Request $request)
{
    $request->validate([
        'worker_id' => 'required|exists:workers,id',
        'date' => 'required|date',
        'shift' => 'required|in:Pagi,Siang,Malam',
    ]);

    \App\Models\Schedule::create([
        'worker_id' => $request->worker_id,
        'date' => $request->date,
        'shift' => $request->shift,
    ]);

    return back()->with('success', 'Jadwal berhasil ditambahkan!');
}
    public function exportPdf(Request $request)
    {
        $filter = $request->get('filter');
        $query = Schedule::with('worker');

        // Samakan logika filter dengan index agar yang diprint sesuai yang dilihat
        if ($filter == 'today') {
            $query->whereDate('date', Carbon::today());
        } elseif ($filter == 'week') {
            $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'month') {
            $query->whereMonth('date', Carbon::now()->month);
        }

        $schedules = $query->get();

        // Cek jika data kosong
        if($schedules->isEmpty()){
            return back()->with('error', 'Tidak ada data jadwal untuk periode ini.');
        }

        // Memanggil view PDF
        $pdf = Pdf::loadView('pdf.schedule', [
            'schedules' => $schedules,
            'filter' => $filter,
            'date' => Carbon::now()->format('d F Y')
        ]);
        
        return $pdf->download('jadwal-pekerja-' . ($filter ?: 'semua') . '.pdf');
    }
}