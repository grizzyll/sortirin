<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORTIR.IN - Smart Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">

    <!-- Sidebar & Main Content Wrapper -->
    <div class="flex min-h-screen">
        <!-- Sidebar Sederhana -->
        <div class="w-64 bg-green-800 text-white p-6 shadow-xl">
            <h1 class="text-2xl font-bold mb-10 flex items-center gap-2">
                <i class="fas fa-recycle"></i> SORTIR.IN
            </h1>
            <nav class="space-y-4">
                <a href="#" class="block py-2.5 px-4 rounded bg-green-700 transition">Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-green-700 transition">Data Pekerja</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-green-700 transition">Riwayat Sampah</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-green-700 transition">Laporan PDF</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Dashboard Monitoring</h2>
                    <p class="text-gray-500">Pantau pemilahan sampah secara real-time</p>
                </div>
                <div class="flex items-center gap-4">
                    <span
                        class="flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span> IoT Online
                    </span>
                    <i class="fas fa-user-circle text-3xl text-gray-400"></i>
                </div>
            </div>

            <!-- GZB-007: Notifikasi Error Sensor -->
            @foreach($bins as $bin)
                @if(!$bin->sensor_status)
                    <div
                        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg shadow-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span><strong>Sensor Error:</strong> Sensor pada bagian <strong>{{ $bin->type }}</strong> tidak
                            terdeteksi!</span>
                    </div>
                @endif
            @endforeach

            <!-- Stats Kapasitas (GZB-004 & GZB-005) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                @foreach($bins as $bin)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-gray-700">{{ $bin->type }}</h3>
                            <i class="fas fa-trash {{ $bin->capacity > 85 ? 'text-red-500' : 'text-green-500' }}"></i>
                        </div>

                        <div class="flex items-end gap-2 mb-2">
                            <span class="text-4xl font-black">{{ $bin->capacity }}%</span>
                            <span class="text-sm text-gray-400 mb-1">Kapasitas</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-100 h-4 rounded-full overflow-hidden">
                            <div class="h-full transition-all duration-500 {{ $bin->capacity > 85 ? 'bg-red-500' : 'bg-green-500' }}"
                                style="width: {{ $bin->capacity }}%"></div>
                        </div>

                        <!-- GZB-012: Edit Harga Sampah -->
                        <form action="{{ route('update.harga', $bin->id) }}" method="POST"
                            class="mt-6 pt-4 border-t border-gray-50">
                            @csrf
                            <label class="text-xs font-bold text-gray-400 uppercase">Harga/Kg (IDR)</label>
                            <div class="flex gap-2 mt-1">
                                <input type="number" name="price" value="{{ $bin->price_per_kg }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                                <button
                                    class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 transition">Set</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Estimasi Ekonomi (Activity Diagram 13) -->
            <div
                class="bg-gradient-to-r from-green-700 to-green-900 rounded-3xl p-8 text-white shadow-lg flex items-center justify-between">
                <div>
                    <h3 class="text-green-200 text-lg">Estimasi Nilai Ekonomi Terkumpul</h3>
                    <p class="text-5xl font-black mt-2 tracking-tight">Rp
                        {{ number_format($totalEkonomi, 0, ',', '.') }}</p>
                    <p class="mt-4 text-sm text-green-300 italic">*Nilai ini otomatis berubah berdasarkan volume sampah
                        di tong.</p>
                </div>
                <div class="hidden lg:block opacity-20">
                    <i class="fas fa-coins text-[120px]"></i>
                </div>
            </div>

        </div>
    </div>
</body>

</html>