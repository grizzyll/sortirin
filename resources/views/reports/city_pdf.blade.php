<!DOCTYPE html>
<html>
<head>
    <title>Laporan SORTIR.IN</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #15803d; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #15803d; }
        .meta { font-size: 12px; text-align: right; margin-bottom: 20px; color: #666; }
        .stats-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .stats-table th, .stats-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .stats-table th { background-color: #15803d; color: white; }
        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #aaa; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SORTIR.IN - MONITORING MAKRO</h2>
        <p style="margin: 5px 0 0 0;">Sistem Manajemen Pengolahan Sampah Digital Berbasis IoT</p>
    </div>

    <div class="meta">
        Tanggal Cetak: {{ $date }}
    </div>

    <h3>{{ $title }}</h3>
    <p>Berikut adalah ringkasan dampak lingkungan dan data operasional berskala kota yang terekam pada sistem:</p>

    <table class="stats-table">
        <thead>
            <tr>
                <th>Indikator Monitoring</th>
                <th>Total Capaian Terdata</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Berat Sampah</strong></td>
                <td>{{ $totalBerat }} Kg</td>
            </tr>
            <tr>
                <td><strong>Total Nilai Ekonomi</strong></td>
                <td>Rp {{ number_format($totalEkonomi, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Anggota Pekerja</strong></td>
                <td>{{ $totalPekerja }} Orang aktif</td>
            </tr>
            <tr>
                <td><strong>TPS Aktif Terintegrasi</strong></td>
                <td>{{ $tpsAktif }} Titik Lokasi</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Laporan ini digenerate secara otomatis oleh Sistem SORTIR.IN Skala Kota.
    </div>
</body>
</html>
