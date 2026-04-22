<?php

namespace App\Http\Controllers;

use App\Models\SortingLog;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil riwayat terbaru, urutkan dari yang paling baru
        $logs = SortingLog::latest()->paginate(10); 
        return view('history.index', compact('logs'));
    }
}