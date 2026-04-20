<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    // Hapus data lama dulu agar tidak double
    \App\Models\Bin::truncate(); 

    \App\Models\Bin::create([
        'type' => 'Organik',
        'capacity' => 45,
        'sensor_status' => true,
        'price_per_kg' => 2000
    ]);

    \App\Models\Bin::create([
        'type' => 'Anorganik',
        'capacity' => 80,
        'sensor_status' => true,
        'price_per_kg' => 5000
    ]);

    \App\Models\Bin::create([
        'type' => 'Logam',
        'capacity' => 10,
        'sensor_status' => true,
        'price_per_kg' => 12000
    ]);
}
}