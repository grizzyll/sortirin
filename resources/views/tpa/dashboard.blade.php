@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Pengawasan Skala Kota</h1>
                <p class="text-sm text-gray-400 font-medium italic underline decoration-emerald-500">Analisis Makro
                    (GZB-012) - TPA Pusat</p>
            </div>
            <div class="px-4 py-2 bg-[#0F2B26] rounded-2xl shadow-lg text-[10px] font-black uppercase tracking-widest text-emerald-400 flex items-center">
                <i class="fas fa-city mr-2"></i> Peran: Admin Utama
            </div>
        </div>

        <!-- Top Row: Global Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Berat Sampah</p>
                <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_berat'] }} <span class="text-xs">Kg</span></h3>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Nilai Ekonomi</p>
                <h3 class="text-3xl font-black text-emerald-600">Rp {{ number_format($stats['ekonomi_total'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Pekerja</p>
                <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_pekerja'] }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-1">TPS Aktif</p>
                <h3 class="text-3xl font-black text-blue-500">{{ $stats['titik_tps'] }} <span class="text-xs">Titik</span></h3>
            </div>
        </div>

        <!-- Main Content: Charts & Info -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Distribution Chart -->
            <div class="lg:col-span-1 bg-white p-8 rounded-[3rem] shadow-sm border border-gray-50 flex flex-col items-center">
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-10">Distribusi Sampah</h3>
                
                <!-- Container Canvas (Diberi tinggi agar muncul) -->
                <div class="relative w-full h-[200px] flex justify-center">
                    <canvas id="tpaPieChart"></canvas>
                </div>

                <div class="mt-8 w-full space-y-2">
                    <div class="flex justify-between text-[10px] font-bold">
                        <span class="text-emerald-500">SAMPAH BASAH</span>
                        <span>{{ $chartData['organik'] }} Kg</span>
                    </div>
                    <div class="flex justify-between text-[10px] font-bold">
                        <span class="text-blue-500">SAMPAH KERING</span>
                        <span>{{ $chartData['anorganik'] }} Kg</span>
                    </div>
                    <div class="flex justify-between text-[10px] font-bold">
                        <span class="text-amber-500">LOGAM</span>
                        <span>{{ $chartData['logam'] }} Kg</span>
                    </div>
                </div>
            </div>

            <!-- Trend / Info Card -->
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-[#0F2B26] to-emerald-900 p-10 rounded-[3rem] text-white shadow-xl h-full flex flex-col justify-between relative overflow-hidden">
                    <div class="z-10">
                        <h3 class="text-2xl font-black mb-4 leading-tight">Ringkasan Dampak<br>Lingkungan</h3>
                        <p class="text-sm text-emerald-200 leading-relaxed max-w-xs">Sistem SORTIR.IN telah membantu memisahkan
                            {{ $stats['total_berat'] }} Kg sampah, meningkatkan efisiensi daur ulang sebesar 24% pada bulan ini.
                        </p>
                    </div>
                    <div class="mt-10 flex gap-4 z-10">
                        <button class="bg-emerald-500 hover:bg-emerald-400 px-6 py-3 rounded-2xl text-xs font-black transition">
                            Unduh Laporan (PDF)
                        </button>
                    </div>
                    <!-- Decoration Leaf -->
                    <i class="fas fa-leaf absolute -right-10 -bottom-10 text-[15rem] opacity-10"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('tpaPieChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Sampah Basah', 'Sampah Kering', 'Logam'],
                    datasets: [{
                        data: [
                            {{ $chartData['organik'] ?? 0 }}, 
                            {{ $chartData['anorganik'] ?? 0 }}, 
                            {{ $chartData['logam'] ?? 0 }}
                        ],
                        backgroundColor: ['#10B981', '#3B82F6', '#F59E0B'],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '75%'
                }
            });
        });
    </script>
@endsection