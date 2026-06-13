<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use App\Models\SortingLog;
use App\Models\Location; // Tambahkan ini
use App\Models\Bin;      // Tambahkan ini
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan proteksi foreign key
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan semua tabel (Urutan penting!)
        User::truncate();
        Worker::truncate();
        SortingLog::truncate();
        Bin::truncate();
        Location::truncate();

        Schema::enableForeignKeyConstraints();

        // 3. Buat Akun Operator (Sesuai PDF)
        User::create([
            'name' => 'Admin TPS Mulyorejo',
            'email' => 'tps@sortir.in',
            'password' => bcrypt('password123'),
            'role' => 'tps'
        ]);

        User::create([
            'name' => 'Admin TPA Pusat',
            'email' => 'tpa@sortir.in',
            'password' => bcrypt('password123'),
            'role' => 'tpa'
        ]);

        // 4. Buat Data Pekerja (Activity 10)
        Worker::create(['name' => 'Budi Santoso', 'nik' => 'TPS001', 'status' => 'Aktif']);
        Worker::create(['name' => 'Siti Aminah', 'nik' => 'TPS002', 'status' => 'Aktif']);

        // 5. Buat Titik Lokasi & Tong Sampahnya (Relasi GZB-004)
        $locs = [
            ['name' => 'Bandulan', 'slug' => 'bandulan', 'is_active' => true],
            ['name' => 'Tidar', 'slug' => 'tidar', 'is_active' => false],
            ['name' => 'Dieng', 'slug' => 'dieng', 'is_active' => false],
        ];

        foreach ($locs as $l) {
            $location = Location::create($l);

            // Tiap lokasi dibuatkan 3 jenis tong secara otomatis
            Bin::create([
                'location_id' => $location->id,
                'type' => 'Organik', // Di tampilan nanti muncul "Basah"
                'capacity' => rand(10, 80),
                'price_per_kg' => 2000,
                'sensor_status' => true
            ]);

            Bin::create([
                'location_id' => $location->id,
                'type' => 'Anorganik', // Di tampilan nanti muncul "Kering"
                'capacity' => rand(10, 80),
                'price_per_kg' => 5000,
                'sensor_status' => true
            ]);

            Bin::create([
                'location_id' => $location->id,
                'type' => 'Logam',
                'capacity' => rand(10, 80),
                'price_per_kg' => 12000,
                'sensor_status' => true
            ]);
        }

        // 6. Buat Dummy Riwayat Pemilahan (GZB-006)
        // Kita ambil salah satu lokasi saja untuk dummy log
        for ($i = 1; $i <= 15; $i++) {
            SortingLog::create([
                'waste_type' => collect(['Organik', 'Anorganik', 'Logam'])->random(),
                'weight' => rand(1, 10) / 10,
                'created_at' => now()->subMinutes(rand(1, 1000))
            ]);
        }
    }
}