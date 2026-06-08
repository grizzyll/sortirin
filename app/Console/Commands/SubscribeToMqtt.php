<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\SensorLog; // Memanggil Model SensorLog kamu

class SubscribeToMqtt extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Memantau data masuk dari alat sortir fisik via MQTT';

    public function handle()
    {
        // Mengambil setingan dari file .env yang sudah kamu isi tadi
        $server   = config('mqtt.connections.default.host', 'broker.emqx.io');
        $port     = (int) config('mqtt.connections.default.port', 1883);
        $clientId = 'laravel_sortirin_' . rand(1, 999);

        $this->info("Menghubungkan ke Broker MQTT ({$server}:{$port})...");

        try {
            $mqtt = new MqttClient($server, $port, MqttClient::MQTT_3_1_1);

            $settings = (new ConnectionSettings())
                ->setKeepAliveInterval(60)
                ->setConnectTimeout(10);

            $mqtt->connect($settings, true);
            $this->info("Berhasil Terhubung! Menunggu data sensor...");

            $mqtt->subscribe('sortirin/sensor', function ($topic, $message) {
                $this->info("Ada data masuk dari topic [{$topic}]: {$message}");
                
                try {
                    // JURUS BONGKAR JSON: Mengubah teks kurung kurawal jadi Array PHP
                    $dataSensor = json_decode($message, true);
                    
                    // Mengambil nilai status dan berat dari JSON secara otomatis
                    // Jika yang dikirim teks biasa, dia akan mengisinya dengan pesan mentah itu sendiri
                    $nilaiStatus    = is_array($dataSensor) ? ($dataSensor['status'] ?? $message) : $message;
                    $nilaiKapasitas = is_array($dataSensor) ? ($dataSensor['berat'] ?? '250 gram') : '250 gram';

                    // PAKSA SIMPAN KE DATABASE (Semua kolom wajib fillable sekarang terisi)
                    SensorLog::create([
                        'kategori'  => 'Alat Sortir Otomatis', // Mengisi kolom kategori
                        'kapasitas' => $nilaiKapasitas,          // Mengisi kolom kapasitas (dari JSON berat)
                        'status'    => $nilaiStatus,             // Mengisi kolom status (dari JSON status)
                    ]);

                    // JIKA BERHASIL, SEKARANG TULISAN HIJAU INI DIJAMIN KELUAR!
                    $this->info("Status: Berhasil disimpan ke database!");

                } catch (\Exception $e) {
                    // JIKA GAGAL, DIA AKAN TERIAK WARNA MERAH DI SINI!
                    $this->error("🚨 ERROR DATABASE: " . $e->getMessage());
                }
                
            }, 0);

            $mqtt->loop(true);

        } catch (\Exception $e) {
            $this->error("Gagal terhubung ke MQTT: " . $e->getMessage());
        }
    }
}