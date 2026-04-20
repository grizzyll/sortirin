@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- GZB-007: Notifikasi Jika Sensor Error (Activity 11) -->
    @foreach($bins as $bin)
        @if(!$bin->sensor_status)
        <div class="bg-red-600 text-white p-4 rounded-xl shadow-lg flex items-center justify-between animate-pulse">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-xl"></i>
                <div>
                    <p class="font-bold">SENSOR ERROR (GZB-007)</p>
                    <p class="text-sm">Sensor pada wadah <strong>{{ $bin->type }}</strong> bermasalah. Segera cek alat!</p>
                </div>
            </div>
            <button class="bg-white text-red-600 px-4 py-1 rounded-lg font-bold text-xs">LOG ERROR</button>
        </div>
        @endif
    @endforeach

   <!-- Bagian Monitoring Kapasitas (GZB-004) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    @foreach($bins as $bin)
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center">
        <!-- Judul Kategori -->
        <h3 class="text-lg font-bold text-gray-700 mb-6 uppercase tracking-widest">{{ $bin->type }}</h3>

        <!-- VISUALISASI TONG SAMPAH -->
        <div class="relative w-32 h-48 border-4 border-gray-300 rounded-b-2xl flex flex-col-reverse overflow-hidden bg-gray-50 shadow-inner">
            <!-- Tutup Tong (Lid) -->
            <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-36 h-3 bg-gray-400 rounded-full z-10 shadow-md"></div>
            
            <!-- Isi Sampah (Liquid Effect) -->
            <div class="transition-all duration-1000 ease-in-out w-full {{ $bin->capacity > 85 ? 'bg-red-500' : ($bin->type == 'Organik' ? 'bg-green-500' : ($bin->type == 'Anorganik' ? 'bg-blue-500' : 'bg-yellow-500')) }}" 
                 style="height: {{ $bin->capacity }}%">
                
                <!-- Efek Kilap/Buih (Opsional) -->
                <div class="absolute top-0 left-0 w-full h-2 bg-white/20"></div>
            </div>

            <!-- Teks Persentase di Tengah Tong -->
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-2xl font-black {{ $bin->capacity > 50 ? 'text-white' : 'text-gray-400' }} drop-shadow-md">
                    {{ $bin->capacity }}%
                </span>
            </div>
        </div>

        <!-- Indikator Status Bawah -->
        <div class="mt-6 text-center">
            @if($bin->capacity > 85)
                <span class="px-4 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold animate-bounce block">
                    ⚠️ PENUH!
                </span>
            @else
                <span class="px-4 py-1 bg-green-100 text-green-600 rounded-full text-xs font-bold block">
                    Tersedia
                </span>
            @endif

            <!-- Form Edit Harga (GZB-012) -->
            <form action="{{ route('update.harga', $bin->id) }}" method="POST" class="mt-4 flex items-center gap-2">
                @csrf
                <div class="relative">
                    <span class="absolute left-2 top-1 text-[10px] text-gray-400 font-bold">Rp</span>
                    <input type="number" name="price" value="{{ $bin->price_per_kg }}" 
                           class="w-24 pl-6 pr-2 py-1 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <button class="p-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-check text-[10px]"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

    <!-- Baris 2: Estimasi Ekonomi (GZB-012 & Activity 13) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-green-700 to-green-900 p-8 rounded-3xl text-white shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="text-green-200 font-medium">Estimasi Nilai Ekonomi (GZB-012)</h3>
                <p class="text-5xl font-black mt-2 tracking-tighter">Rp {{ number_format($totalEkonomi, 0, ',', '.') }}</p>
            </div>
            <div class="mt-8 flex items-center gap-4 text-sm text-green-100">
                <div class="bg-green-600/50 p-2 rounded-lg">
                    <i class="fas fa-chart-line"></i> +12% dari kemarin
                </div>
                <p class="opacity-60 italic">*Berdasarkan input harga pasar terbaru</p>
            </div>
        </div>

        <!-- Riwayat Singkat (GZB-006) -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-history text-green-600"></i> Riwayat Terakhir
            </h3>
            <div class="space-y-4">
                @foreach($recentLogs as $log)
                <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <span class="text-sm font-medium text-gray-700">{{ $log->waste_type }}</span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection