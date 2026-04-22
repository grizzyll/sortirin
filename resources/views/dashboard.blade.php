@extends('layouts.app')
@section('content')
<div class="space-y-6">
    
    <!-- Notifikasi Sukses Update Harga (GZB-012) -->
    @if(session('success'))
    <div class="bg-emerald-500 text-white p-4 rounded-2xl shadow-lg shadow-emerald-200 flex items-center gap-3 animate-fade-in-down">
        <i class="fas fa-check-circle text-xl"></i>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Overview Monitoring</h1>
            <p class="text-sm text-gray-400 font-medium">Sistem Pemilahan Sampah Otomatis - TPS Mulyorejo</p>
        </div>
        <div class="px-4 py-2 bg-white rounded-2xl shadow-sm text-[10px] font-black uppercase tracking-widest text-gray-250 border border-gray-100 flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full inline-block mr-2 animate-ping"></span> 
            System Status: Connected
        </div>
    </div>

    <!-- Top Row: Economy & Health -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Estimasi Ekonomi (Activity 13) -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all">
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Economic Value (GZB-012)</p>
                <h3 class="text-4xl font-black text-gray-800 tracking-tighter">Rp {{ number_format($totalEkonomi, 0, ',', '.') }}</h3>
                <p class="text-[10px] text-emerald-500 mt-2 font-bold italic"><i class="fas fa-chart-line mr-1"></i> Based on current bin capacity</p>
            </div>
            <div class="p-5 bg-emerald-50 text-emerald-600 rounded-[2rem] group-hover:scale-110 transition-transform">
                <i class="fas fa-wallet text-3xl"></i>
            </div>
        </div>

        <!-- Dynamic Sensor Status (GZB-007) -->
        @php
            $anySensorError = $bins->where('sensor_status', false)->count() > 0;
        @endphp
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all">
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Sensor Health Status</p>
                <h3 class="text-4xl font-black {{ $anySensorError ? 'text-red-500' : 'text-gray-800' }}">
                    {{ $anySensorError ? 'Error Detected' : '100% Healthy' }}
                </h3>
                <p class="text-[10px] {{ $anySensorError ? 'text-red-400' : 'text-blue-500' }} mt-2 font-bold italic">
                    <i class="fas {{ $anySensorError ? 'fa-exclamation-triangle' : 'fa-shield-alt' }} mr-1"></i> 
                    {{ $anySensorError ? 'Check red marked bins below' : 'All systems functioning normally' }}
                </p>
            </div>
            <div class="p-5 {{ $anySensorError ? 'bg-red-50 text-red-500 animate-pulse' : 'bg-blue-50 text-blue-500' }} rounded-[2rem] text-3xl transition-transform group-hover:rotate-12">
                <i class="fas {{ $anySensorError ? 'fa-tools' : 'fa-microchip' }}"></i>
            </div>
        </div>
    </div>

    <!-- MAIN SECTION: TONG SAMPAH (Visualisasi GZB-004) -->
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-12">
            <h3 class="text-xl font-black text-gray-800 tracking-tight"><i class="fas fa-dumpster mr-2 text-emerald-500"></i> Real-time Bin Capacity</h3>
            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.2em]">Auto-refresh: Active</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach($bins as $bin)
            <div class="flex flex-col items-center">
                <!-- Visual Tong Sampah Modern -->
                <div class="relative w-40 h-60 bg-slate-50 border-4 {{ !$bin->sensor_status ? 'border-red-200 animate-pulse' : 'border-slate-100' }} rounded-b-[3rem] shadow-inner overflow-hidden flex flex-col-reverse group shadow-lg">
                    
                    <!-- Liquid Filling -->
                    <div class="transition-all duration-1000 ease-in-out w-full 
                        {{ $bin->capacity > 85 ? 'bg-gradient-to-t from-red-600 to-red-400' : 
                        ($bin->type == 'Organik' ? 'bg-gradient-to-t from-emerald-600 to-emerald-400' : 
                        ($bin->type == 'Anorganik' ? 'bg-gradient-to-t from-blue-600 to-blue-400' : 
                        'bg-gradient-to-t from-amber-500 to-amber-300')) }}" 
                         style="height: {{ $bin->capacity }}%">
                        
                        <!-- Shine/Glass Effect -->
                        <div class="absolute top-0 left-0 w-full h-8 bg-white/10 blur-xl"></div>
                    </div>

                    <!-- Percentage Label -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-black {{ $bin->capacity > 50 ? 'text-white' : 'text-gray-300' }} drop-shadow-sm">
                            {{ $bin->capacity }}%
                        </span>
                        @if(!$bin->sensor_status)
                            <span class="text-[8px] font-bold text-white bg-red-600 px-2 py-0.5 rounded-full mt-2 uppercase">Sensor Off</span>
                        @endif
                    </div>

                    <!-- Bin Lid -->
                    <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-44 h-3 {{ !$bin->sensor_status ? 'bg-red-400' : 'bg-slate-200' }} rounded-full z-10 shadow-sm"></div>
                </div>

                <!-- Info & Edit Harga (Activity 13) -->
                <div class="mt-8 text-center w-full px-4">
                    <h4 class="font-black text-gray-800 uppercase tracking-tighter text-xl mb-1">{{ $bin->type }}</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Wadah Terpilah</p>
                    
                    <form action="{{ route('update.harga', $bin->id) }}" method="POST" class="flex justify-center items-center gap-2">
                        @csrf
                        <div class="relative group">
                            <input type="number" name="price" value="{{ $bin->price_per_kg }}" class="w-28 pl-8 pr-2 py-2.5 bg-gray-50 border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-emerald-500 transition-all shadow-inner" placeholder="0">
                            <span class="absolute left-3 top-3 text-[10px] text-gray-400 font-black">Rp</span>
                        </div>
                        <button type="submit" title="Update Harga" class="p-3 bg-[#0F2B26] text-white rounded-2xl hover:bg-emerald-600 transition-all shadow-md active:scale-90">
                            <i class="fas fa-save text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom Row: Recent History (GZB-006) -->
    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-8 px-2">
            <h3 class="font-black text-gray-800 tracking-tight italic">Activity Logs (GZB-006)</h3>
            <a href="/history" class="text-[10px] font-black text-emerald-600 hover:text-emerald-700 uppercase tracking-widest border-b-2 border-emerald-100 pb-1 transition-all">View Analytics</a>
        </div>
        
        <div class="grid grid-cols-1 gap-3">
            @forelse($recentLogs as $log)
            <div class="flex justify-between items-center p-5 hover:bg-emerald-50/30 rounded-3xl transition-all group border border-transparent hover:border-emerald-50">
                <div class="flex items-center gap-5">
                    <div class="p-4 bg-gray-100 group-hover:bg-white rounded-2xl transition-all shadow-sm">
                        <i class="fas fa-recycle {{ $log->waste_type == 'Organik' ? 'text-emerald-500' : ($log->waste_type == 'Anorganik' ? 'text-blue-500' : 'text-amber-500') }} text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-800">{{ $log->waste_type }} Waste Detected</p>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tight">{{ $log->created_at->format('H:i:s') }} — {{ $log->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-black text-gray-800 tracking-tighter">{{ $log->weight }} kg</p>
                    <p class="text-[10px] text-emerald-500 font-black uppercase tracking-widest">Success</p>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <p class="text-gray-400 text-xs italic">Belum ada aktivitas pemilahan hari ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection