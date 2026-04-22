<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use App\Models\SortingLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan proteksi foreign key sementara agar bisa menghapus data
        Schema::disableForeignKeyConstraints();

        // Kosongkan semua tabel sebelum diisi (TRUNCATE)
        User::truncate();
        Worker::truncate();
        SortingLog::truncate();
        
        // Aktifkan kembali proteksi
        Schema::enableForeignKeyConstraints();

        // 1. Jalankan Seeder Bin
        $this->call([
            BinSeeder::class,
        ]);

        // 2. Buat Akun Operator (Sesuai PDF Hal 12)
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

        // 3. Buat Data Pekerja (Activity 10)
        Worker::create(['name' => 'Budi Santoso', 'nik' => 'TPS001', 'status' => 'Aktif']);
        Worker::create(['name' => 'Siti Aminah', 'nik' => 'TPS002', 'status' => 'Aktif']);

        // 4. Buat Dummy Riwayat (GZB-006)
        for ($i = 1; $i <= 10; $i++) {
            SortingLog::create([
                'waste_type' => collect(['Organik', 'Anorganik', 'Logam'])->random(),
                'weight' => rand(1, 10) / 10,
                'created_at' => now()->subMinutes(rand(1, 1000))
            ]);
        }
    }
}