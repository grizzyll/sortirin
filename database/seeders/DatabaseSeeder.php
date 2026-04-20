<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
        BinSeeder::class,
        // WorkerSeeder::class, (jika sudah buat)
        ]);
          \App\Models\Worker::create(['name' => 'Budi Santoso', 'nik' => 'TPS001', 'status' => 'Aktif']);
    \App\Models\Worker::create(['name' => 'Siti Aminah', 'nik' => 'TPS002', 'status' => 'Aktif']);
    }
}
