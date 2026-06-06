<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class SubscribeToMqtt extends Command
{
    // Ini perintah yang dijalankan di terminal
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

            // Mendengarkan papan pengumuman/topic 'sortirin/sensor'
            $mqtt->subscribe('sortirin/sensor', function ($topic, $message) {
                $this->info("Ada data masuk dari topic [{$topic}]: {$message}");
                
                // DI SINI KAMU BISA MASUKKAN LOGIKA SIMPAN DATA KAMU NANTI
                
            }, 0);

            // Loop terus-menerus agar VPS stand-by mendengarkan
            $mqtt->loop(true);

        } catch (\Exception $e) {
            $this->error("Gagal terhubung ke MQTT: " . $e->getMessage());
        }
    }
}