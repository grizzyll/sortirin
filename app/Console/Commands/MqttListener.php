<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\Bin;
use App\Models\Sampah;

class MqttListener extends Command
{
    /**
     * Nama perintah yang dijalankan di terminal hitam VPS.
     * Dapat dipanggil dengan: php artisan mqtt:listen
     */
    protected $signature = 'mqtt:listen';

    /**
     * Deskripsi perintah di sistem artisan.
     */
    protected $description = 'Memantau data masuk dari alat sortir fisik via MQTT secara Live';

    /**
     * Eksekusi perintah console.
     */
    public function handle()
    {
        // 1. Pengaturan Koneksi Broker MQTT (Menggunakan EMQX Broker)
        $server   = 'broker.emqx.io';
        $port     = 1883;
        $clientId = 'laravel_sortirin_listener_' . rand(1, 999);

        $mqtt = new MqttClient($server, $port, $clientId);

        $connectionSettings = (new ConnectionSettings())
            ->setKeepAliveInterval(60)
            ->setConnectTimeout(10)
            ->setCleanSession(true);

        $this->info("⏳ Memulai MQTT Listener SORTIR.IN... Menunggu data dari ESP32.");

        // Hubungkan Laravel ke Broker MQTT
        $mqtt->connect($connectionSettings, true);

        /**
         * 2. Subscribe ke Topik Alat
         * PASTIKAN nama topik ini ("iot/sortirin/data") sama persis dengan yang kamu ketik di kodingan Arduino/ESP32 kamu.
         */
        $mqtt->subscribe('iot/sortirin/data', function ($topic, $message) {
            // Tampilkan data mentah di terminal VPS agar bisa dipantau manual
            $this->info("📥 Data Masuk dari Alat: " . $message);

            // 3. Decode data JSON yang dikirim oleh ESP32
            $data = json_decode($message, true);

            // Validasi apakah format JSON dari ESP32 valid dan memiliki isi data status & berat
            if (isset($data['status']) && isset($data['berat'])) {
                $status = strtolower($data['status']); // 'organik', 'anorganik', atau 'logam'
                $berat  = (float)$data['berat'];

                // 4. Petakan tipe dari ESP32 agar cocok dengan kolom 'type' di tabel `bins` database-mu
                $dbType = '';
                $hargaPerKg = 0;

                if ($status === 'organik') {
                    $dbType = 'Organik';
                    $hargaPerKg = 2000; // Harga default per Kg sesuai database kamu
                } elseif ($status === 'anorganik') {
                    $dbType = 'Anorganik';
                    $hargaPerKg = 5000;
                } elseif ($status === 'logam') {
                    $dbType = 'Logam';
                    $hargaPerKg = 12000;
                }

                if ($dbType !== '') {
                    // 5. Hitung Persentase Kapasitas Wadah Fisik
                    // Sesuaikan angka 500 ini dengan kapasitas beban maksimal (dalam gram) wadah aslimu nanti
                    $maxKapasitas = 500; 
                    $persentaseBaru = min(round(($berat / $maxKapasitas) * 100), 100);

                    // Batasi agar persentase tidak minus jika timbangan loadcell sedikit tidak stabil
                    if ($persentaseBaru < 0) {
                        $persentaseBaru = 0;
                    }

                    // 6. UPDATE TABEL `bins` (Untuk mengubah visual tabung di dashboard secara live)
                    Bin::where('type', $dbType)->update([
                        'capacity' => $persentaseBaru
                    ]);
                    $this->comment("   ↳ Kategori {$dbType} diperbarui menjadi {$persentaseBaru}% di tabel bins.");

                    // 7. INSERT TABEL `sampahs` (Untuk mencatat log riwayat transaksi & grafik)
                    // Hitung nilai ekonomi sampah yang masuk saat itu juga
                    $nilaiEkonomi = ($berat / 1000) * $hargaPerKg; // rumus: (berat gram / 1000) * harga per kg

                    Sampah::create([
                        'status'        => $status, // menyimpan 'organik', 'anorganik', atau 'logam'
                        'berat'         => $berat,  // menyimpan data gram
                        'nilai_ekonomi' => $nilaiEkonomi,
                        'created_at'    => now(),
                        'updated_at'    => now()
                    ]);
                    $this->question("   ↳ Transaksi baru sukses dicatat ke log tabel sampahs! (Nilai: Rp " . number_format($nilaiEkonomi, 0, ',', '.') . ")");
                }
            } else {
                $this->error("⚠️ Format JSON dari ESP32 tidak valid atau kolom tidak lengkap!");
            }
        }, 0);

        // Menjaga agar perintah terminal terus berjalan (looping) mendengarkan data tanpa henti
        $mqtt->loop(true);
    }
}