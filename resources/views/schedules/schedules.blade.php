<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .header { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>JADWAL TUGAS PEKERJA TPS - SORTIR.IN</h2>
        <p>Laporan Resmi Pemilahan Sampah Otomatis</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama Pekerja</th>
                <th>Tanggal</th>
                <th>Shift</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $s)
            <tr>
                <td>{{ $s->worker->name }}</td>
                <td>{{ $s->date }}</td>
                <td>{{ $s->shift }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>