@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">City-Wide Monitoring</h1>
            <p class="text-sm text-gray-400 font-medium italic underline decoration-emerald-500">Macro Analysis (GZB-012) - Central TPA</p>
        </div>
        <div class="px-4 py-2 bg-[#0F2B26] rounded-2xl shadow-lg text-[10px] font-black uppercase tracking-widest text-emerald-400 flex items-center">
            <i class="fas fa-city mr-2"></i> Role: Central Admin
        </div>
    </div>

    <!-- Top Row: Global Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Total Weight -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
            <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Waste</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_berat'] }} <span class="text-xs">Kg</span></h3>
        </div>
        <!-- Total Economic -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
            <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total Economy</p>
            <h3 class="text-3xl font-black text-emerald-600">Rp {{ number_format($stats['ekonomi_total'], 0, ',', '.') }}</h3>
        </div>
        <!-- Total Workers -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
            <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Global Workers</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_pekerja'] }}</h3>
        </div>
        <!-- Active TPS -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-gray-50 flex flex-col justify-center">
            <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Active TPS</p>
            <h3 class="text-3xl font-black text-blue-500">{{ $stats['titik_tps'] }} <span class="text-xs">Points</span></h3>
        </div>
    </div>

    <!-- Main Content: Charts (Activity 14) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Distribution Chart -->
        <div class="lg:col-span-1 bg-white p-8 rounded-[3rem] shadow-sm border border-gray-50 flex flex-col items-center">
            <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-10">Waste Distribution</h3>
            <div class="w-full max-w-[200px]">
                <canvas id="tpaPieChart"></canvas>
            </div>
            <div class="mt-8 w-full space-y-2">
                <div class="flex justify-between text-[10px] font-bold">
                    <span class="text-emerald-500">ORGANIK</span>
                    <span>{{ $chartData['organik'] }} Kg</span>
                </div>
                <div class="flex justify-between text-[10px] font-bold">
                    <span class="text-blue-500">ANORGANIK</span>
                    <span>{{ $chartData['anorganik'] }} Kg</span>
                </div>
                <div class="flex justify-between text-[10px] font-bold">
                    <span class="text-amber-500">LOGAM</span>
                    <span>{{ $chartData['logam'] }} Kg</span>
                </div>
            </div>
        </div>

        <!-- Trend / Info Card -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-gradient-to-br from-[#0F2B26] to-emerald-900 p-10 rounded-[3rem] text-white shadow-xl h-full flex flex-col justify-between relative overflow-hidden">
                <div class="z-10">
                    <h3 class="text-2xl font-black mb-4 leading-tight">Environmental Impact<br>Summary</h3>
                    <p class="text-sm text-emerald-200 leading-relaxed max-w-xs">Sistem SORTIR.IN telah membantu memisahkan {{ $stats['total_berat'] }} Kg sampah, meningkatkan efisiensi daur ulang sebesar 24% bulan ini.</p>
                </div>
                <div class="mt-10 flex gap-4 z-10">
                    <button class="bg-emerald-500 hover:bg-emerald-400 px-6 py-3 rounded-2xl text-xs font-black transition">Download Report (PDF)</button>
                </div>
                <!-- Decoration -->
                <i class="fas fa-leaf absolute -right-10 -bottom-10 text-[15rem] opacity-10"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('tpaPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Organik', 'Anorganik', 'Logam'],
            datasets: [{
                data: [{{ $chartData['organik'] }}, {{ $chartData['anorganik'] }}, {{ $chartData['logam'] }}],
                backgroundColor: ['#10B981', '#3B82F6', '#F59E0B'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            cutout: '70%'
        }
    });
</script>
@endsection