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
    \App\Models\Bin::insert([
        ['type' => 'Organik', 'capacity' => 45, 'sensor_status' => true, 'price_per_kg' => 2000],
        ['type' => 'Anorganik', 'capacity' => 80, 'sensor_status' => true, 'price_per_kg' => 5000],
        ['type' => 'Logam', 'capacity' => 10, 'sensor_status' => false, 'price_per_kg' => 12000],
    ]);
}
}
