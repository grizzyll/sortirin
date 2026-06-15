<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\Bin;
use App\Models\SortingLog;
use App\Models\Location;

class MqttListener extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Memantau data masuk dari alat sortir fisik via MQTT secara Live';

    public function handle()
    {
        $server   = 'broker.emqx.io';
        $port     = 1883;
        $clientId = 'laravel_sortirin_listener_' . rand(1, 999);
        $mqtt = new MqttClient($server, $port, $clientId);
        $connectionSettings = (new ConnectionSettings())
            ->setKeepAliveInterval(60)
            ->setConnectTimeout(10);

        $this->info("⏳ Memulai MQTT Listener SORTIR.IN... Menunggu data dari ESP32.");
        $mqtt->connect($connectionSettings, true);

        $bandulan = Location::where('name', 'Bandulan')->first();
        if (!$bandulan) {
            $this->error("❌ Location Bandulan tidak ditemukan di database!");
            return;
        }

        // TOPIC 1: sortirin/loadcell - update kapasitas bin realtime dari loadcell
        $mqtt->subscribe('sortirin/loadcell', function ($topic, $message) use ($bandulan) {
            $data = json_decode($message, true);
            if (!isset($data['lc1']) && !isset($data['lc2']) && !isset($data['lc3'])) return;

            $maxKapasitas = 200;

            $mapping = [
                'lc1' => 'Logam',
                'lc2' => 'Anorganik',
                'lc3' => 'Organik',
            ];

            foreach ($mapping as $lc => $dbType) {
                if (!isset($data[$lc])) continue;
                $berat = (float)$data[$lc];

                $bin = Bin::where('type', $dbType)
                          ->where('location_id', $bandulan->id)
                          ->first();

                if ($bin) {
                    $kapasitasBaru = min(round(($berat / $maxKapasitas) * 100), 100);
                    $bin->update(['capacity' => $kapasitasBaru]);
                }
            }

            $this->info("🔄 Kapasitas bin diperbarui dari loadcell.");
        }, 0);

        // TOPIC 2: sortirin/sensor - catat log sortir per event
        $mqtt->subscribe('sortirin/sensor', function ($topic, $message) use ($bandulan) {
            $this->info("📥 Data Masuk dari Alat: " . $message);
            $data = json_decode($message, true);

            if (isset($data['status']) && isset($data['berat'])) {
                $status = strtolower($data['status']);
                $berat  = (float)$data['berat'];

                $dbType     = '';
                $hargaPerKg = 0;

                if ($status === 'logam') {
                    $dbType = 'Logam'; $hargaPerKg = 12000;
                } elseif ($status === 'organik') {
                    $dbType = 'Organik'; $hargaPerKg = 2000;
                } elseif ($status === 'anorganik') {
                    $dbType = 'Anorganik'; $hargaPerKg = 5000;
                }

                if ($dbType !== '') {
                    SortingLog::create([
                        'waste_type' => $dbType,
                        'weight'     => $berat,
                    ]);

                    $nilaiEkonomi = ($berat / 1000) * $hargaPerKg;
                    $this->question("   ↳ Log dicatat! Nilai ekonomi: Rp " . number_format($nilaiEkonomi, 0, ',', '.'));
                }
            }
        }, 0);

        $mqtt->loop(true);
    }
}
