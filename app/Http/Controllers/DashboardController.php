<?php
namespace App\Http\Controllers;
use App\Models\Bin;
use App\Models\Worker;
use App\Models\SortingLog;
use App\Models\Location;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
public function index()
{
    $locations = \App\Models\Location::with('bins')->get();
    $bins = \App\Models\Bin::all();
    $recentLogs = \App\Models\SortingLog::latest()->take(5)->get();
    $totalEkonomi = 0;
    foreach($bins as $bin) {
        $beratDalamKg = $bin->capacity / 10;
        $totalEkonomi += ($beratDalamKg * $bin->price_per_kg);
    }
    $avgKapasitas = \App\Models\Bin::selectRaw('type, AVG(capacity) as avg_capacity, AVG(current_weight) as avg_weight, AVG(price_per_kg) as avg_price')
        ->groupBy('type')
        ->get()
        ->keyBy('type');
    return view('dashboard', compact('locations', 'bins', 'recentLogs', 'totalEkonomi', 'avgKapasitas'));
}
}
