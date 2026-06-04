@extends('layouts.app')

@section('content')
<div class="space-y-6 p-2">

    <!-- 1. NOTIFIKASI (Floating & Minimalis) -->
    @if(session('success'))
        <div class="fixed top-10 right-10 z-50 bg-[#0F2B26] text-white px-5 py-3 rounded-2xl shadow-2xl border border-emerald-500/20 flex items-center gap-4 animate-fade-in">
            <div class="bg-emerald-500 p-1.5 rounded-full text-[8px]">
                <i class="fas fa-check"></i>
            </div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ session('success') }}</span>
        </div>
    @endif

    <!-- 2. HEADER SECTION -->
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight">Operasional TPS</h1>
            <p class="text-[11px] text-gray-400 font-bold italic underline decoration-emerald-500 decoration-1 underline-offset-4">Sistem Monitoring Terpadu TPS Mulyorejo</p>
        </div>
        <div class="px-4 py-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Sistem Terhubung</span>
        </div>
    </div>

    <!-- 3. WIDGET STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Nilai Ekonomi -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
            <div>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em] mb-1">Total Estimasi Ekonomi</p>
                <h3 class="text-3xl font-black text-gray-800 tracking-tight">
                    <span class="text-emerald-500 text-lg font-bold">Rp</span>{{ number_format($totalEkonomi, 0, ',', '.') }}
                </h3>
                <p class="mt-2 text-[8px] text-emerald-500 font-black uppercase italic tracking-wider">
                    <i class="fas fa-sync-alt fa-spin mr-1"></i> Data diperbarui otomatis
                </p>
            </div>
            <div class="p-6 bg-emerald-50 text-emerald-600 rounded-[1.5rem] shadow-inner transition-transform group-hover:scale-105">
                <i class="fas fa-wallet text-2xl"></i>
            </div>
        </div>

        <!-- Card Kesehatan Sensor -->
        @php $anySensorError = $bins->where('sensor_status', false)->count() > 0; @endphp
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
            <div>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em] mb-1">Integritas Perangkat</p>
                <h3 class="text-3xl font-black {{ $anySensorError ? 'text-red-500' : 'text-gray-800' }} tracking-tight">
                    {{ $anySensorError ? 'Butuh Tindakan' : '100% Berfungsi' }}
                </h3>
                <p class="mt-2 text-[8px] {{ $anySensorError ? 'text-red-400' : 'text-blue-400' }} font-black uppercase tracking-widest">
                    <i class="fas {{ $anySensorError ? 'fa-tools' : 'fa-check-double' }} mr-1"></i>
                    {{ $anySensorError ? 'Cek gangguan pada titik terminal' : 'Seluruh sensor terpantau normal' }}
                </p>
            </div>
            <div class="p-6 {{ $anySensorError ? 'bg-red-50 text-red-500 animate-pulse' : 'bg-blue-50 text-blue-500' }} rounded-[1.5rem] shadow-inner transition-transform group-hover:scale-105">
                <i class="fas {{ $anySensorError ? 'fa-exclamation-triangle' : 'fa-microchip' }} text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- 4. VISUALISASI KAPASITAS (HANYA SATU BLOK) -->
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-10 px-2">
            <h3 class="text-base font-black text-gray-800 tracking-[0.2em] uppercase flex items-center gap-2">
                <div class="w-6 h-1 bg-emerald-500 rounded-full"></div>
                Volume Wadah Real-Time
            </h3>
            <div class="flex gap-1">
                <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                <div class="w-1 h-1 rounded-full bg-emerald-500"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($bins as $bin)
            <div class="flex flex-col items-center">
                <!-- Visual Tong (Liquid Effect) -->
                <div class="relative w-36 h-56 bg-slate-50 border-[5px] {{ !$bin->sensor_status ? 'border-red-100 animate-pulse' : 'border-white' }} rounded-b-[3.5rem] shadow-2xl overflow-hidden flex flex-col-reverse group transition-all">
                    
                    <!-- Filling Progress -->
                    <div class="transition-all duration-1000 ease-in-out w-full 
                        {{ $bin->capacity > 85 ? 'bg-gradient-to-t from-red-600 to-red-400' : 
                        ($bin->type == 'Organik' ? 'bg-gradient-to-t from-emerald-600 to-emerald-400' : 
                        ($bin->type == 'Anorganik' ? 'bg-gradient-to-t from-blue-600 to-blue-400' : 
                        'bg-gradient-to-t from-amber-500 to-amber-300')) }}" 
                         style="height: {{ $bin->capacity }}%">
                        <div class="absolute top-0 left-0 w-full h-8 bg-white/20 blur-xl"></div>
                    </div>

                    <!-- Persentase di Tengah -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-black {{ $bin->capacity > 50 ? 'text-white' : 'text-gray-300' }} tracking-tighter drop-shadow-sm">
                            {{ $bin->capacity }}%
                        </span>
                        @if(!$bin->sensor_status)
                            <span class="mt-2 text-[8px] font-black bg-red-600 text-white px-2 py-0.5 rounded-full uppercase">Mati</span>
                        @endif
                    </div>
                </div>

                <!-- DESAIN INPUT HARGA MINIMALIS (Activity 13) -->
                <div class="mt-8 text-center w-full px-4 flex flex-col items-center">
                    <h4 class="font-black text-gray-800 uppercase tracking-[0.2em] text-sm mb-1">
                        @if($bin->type == 'Organik') BASAH 
                        @elseif($bin->type == 'Anorganik') KERING 
                        @else {{ $bin->type }} @endif
                    </h4>
                    <p class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.3em] mb-6">Titik Terminal: 0{{ $loop->iteration }}</p>
                    
                    <!-- Form Harga Gaya Stripe -->
                    <form action="{{ route('update.harga', $bin->id) }}" method="POST" class="group w-full max-w-[140px] relative">
                        @csrf
                        <div class="flex items-center gap-2 border-b-2 border-gray-50 py-1 transition-all duration-300 group-focus-within:border-emerald-500 hover:border-gray-200">
                            <span class="text-[9px] font-black text-emerald-600 tracking-tighter">RP</span>
                            <input type="number" name="price" value="{{ number_format($bin->price_per_kg, 0, '', '') }}" 
                                class="w-full bg-transparent border-none p-0 text-sm font-black text-gray-700 focus:ring-0 placeholder-gray-200" placeholder="0">
                            <button type="submit" class="text-gray-300 hover:text-emerald-600 transition-colors transform active:scale-90">
                                <i class="fas fa-check-circle text-sm"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 5. LOG AKTIVITAS TERBARU -->
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-8 px-2">
            <h3 class="text-sm font-black text-gray-800 tracking-[0.2em] uppercase flex items-center gap-3">
                <div class="w-6 h-1 bg-emerald-500 rounded-full italic"></div>
                Log Pemilahan Terkini
            </h3>
            <a href="/history" class="text-[9px] font-black text-emerald-600 hover:text-[#0F2B26] uppercase tracking-widest border-b border-emerald-100 pb-0.5 transition-all">Pusat Analitik</a>
        </div>

        <div class="grid grid-cols-1 gap-3">
            @forelse($recentLogs as $log)
                <div class="flex justify-between items-center p-5 hover:bg-emerald-50/20 rounded-[2rem] transition-all duration-300 group border border-transparent">
                    <div class="flex items-center gap-5">
                        <div class="p-4 bg-gray-50 group-hover:bg-white rounded-2xl transition-all shadow-sm border border-gray-100 group-hover:border-emerald-100">
                            <i class="fas fa-recycle {{ $log->waste_type == 'Organik' ? 'text-emerald-500' : ($log->waste_type == 'Anorganik' ? 'text-blue-500' : 'text-amber-500') }} text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-800 uppercase tracking-tight">
                                Sampah @if($log->waste_type == 'Organik') Basah @elseif($log->waste_type == 'Anorganik') Kering @else Logam @endif Terdeteksi
                            </p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">
                                {{ $log->created_at->format('H:i:s') }} WIB <span class="mx-2 text-gray-200">|</span> {{ $log->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-black text-gray-800 tracking-tight">{{ $log->weight }} <span class="text-[9px] text-gray-300 font-bold">Kg</span></p>
                        <div class="mt-0.5 flex items-center justify-end gap-1.5 text-emerald-500 font-bold text-[8px] uppercase tracking-widest">
                            <span class="h-1 w-1 bg-emerald-500 rounded-full animate-pulse"></span> Berhasil
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 opacity-30 flex flex-col items-center">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p class="text-[9px] font-black uppercase tracking-widest">Belum ada data aktivitas hari ini</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection