<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Location;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    public function show($slug)
    {
        $location = Location::where('slug', $slug)->firstOrFail();
        $bins = Bin::where('location_id', $location->id)->get();

        // Hitung ekonomi khusus titik ini
        $totalEkonomi = 0;
        foreach ($bins as $bin) {
            $totalEkonomi += (($bin->capacity / 100) * 0.5 * $bin->price_per_kg);
        }

        return view('regional.show', compact('location', 'bins', 'totalEkonomi'));
    }
}
