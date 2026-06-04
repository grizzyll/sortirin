<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\SensorLog;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe ke MQTT broker untuk terima data sensor ESP32';

    public function handle()
    {
        $this->info('Menunggu data dari ESP32...');

        $mqtt = MQTT::connection();

        $mqtt->subscribe('sortirin/sensor', function ($topic, $message) {
            $this->info("Data masuk [$topic]: $message");

            $data = json_decode($message, true);

            if ($data) {
                SensorLog::create([
                    'kategori'  => $data['kategori'],
                    'kapasitas' => $data['kapasitas'],
                    'status'    => $data['status'],
                ]);

                $this->info("Data tersimpan ke database.");
            }
        });

        $mqtt->loop(true);
    }
}