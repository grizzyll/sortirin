@extends('layouts.app')

@section('content')
<div class="space-y-6 p-2">

    <!-- 1. HEADER DAERAH (Identitas Lokasi) -->
    <div class="flex justify-between items-center mb-2">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="text-2xl font-black text-gray-800 tracking-tight">Titik Terminal: {{ $location->name }}</h1>
                @if($location->is_active)
                    <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black uppercase rounded-xl tracking-widest shadow-lg shadow-emerald-200">Terhubung API</span>
                @else
                    <span class="px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black uppercase rounded-xl tracking-widest">Mode Simulasi</span>
                @endif
            </div>
            <p class="text-[11px] text-gray-400 font-bold italic underline decoration-emerald-500 decoration-1 underline-offset-4">
                Data spesifik area penugasan wilayah {{ $location->name }}
            </p>
        </div>
        <div class="px-4 py-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
            <i class="fas fa-map-marker-alt text-emerald-500 text-xs"></i>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">ID Lokasi: #0{{ $location->id }}</span>
        </div>
    </div>

    <!-- 2. WIDGET STATISTIK WILAYAH -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
            <div>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em] mb-1">Ekonomi Wilayah Ini</p>
                <h3 class="text-3xl font-black text-gray-800 tracking-tight">
                    <span class="text-emerald-500 text-lg font-bold">Rp</span>{{ number_format($totalEkonomi, 0, ',', '.') }}
                </h3>
            </div>
            <div class="p-6 bg-emerald-50 text-emerald-600 rounded-[1.5rem] shadow-inner">
                <i class="fas fa-chart-area text-2xl"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
            <div>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em] mb-1">Status Konektivitas</p>
                <h3 class="text-3xl font-black {{ $location->is_active ? 'text-emerald-500' : 'text-gray-300' }} tracking-tight">
                    {{ $location->is_active ? 'Online' : 'Offline' }}
                </h3>
            </div>
            <div class="p-6 {{ $location->is_active ? 'bg-emerald-50 text-emerald-500' : 'bg-gray-50 text-gray-300' }} rounded-[1.5rem] shadow-inner">
                <i class="fas fa-signal text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- 3. VISUALISASI KAPASITAS (Hanya 1 Perulangan yang Benar) -->
    <div class="bg-white p-12 rounded-[4rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-16 px-2">
            <h3 class="text-base font-black text-gray-800 tracking-[0.2em] uppercase flex items-center gap-2">
                <div class="w-6 h-1 bg-emerald-500 rounded-full"></div>
                Status Kapasitas
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($bins as $bin)
            <div class="flex flex-col items-center">
                <!-- Visual Tong -->
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

                    <!-- Persentase -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl font-black {{ $bin->capacity > 50 ? 'text-white' : 'text-gray-300' }} tracking-tighter">
                            {{ $bin->capacity }}%
                        </span>
                    </div>
                </div>

                <!-- Label & Input Harga -->
                <div class="mt-8 text-center w-full max-w-[180px] flex flex-col items-center">
                    <h4 class="font-black text-gray-800 uppercase tracking-widest text-sm mb-1">
                        @if($bin->type == 'Organik') BASAH 
                        @elseif($bin->type == 'Anorganik') KERING 
                        @else {{ $bin->type }} @endif
                    </h4>
                    <p class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.3em] mb-5">Terminal ID: 0{{ $loop->iteration }}</p>
                    
                    <!-- Form Update Harga Minimalis -->
                    <form action="{{ route('update.harga', $bin->id) }}" method="POST" class="group w-full relative">
                        @csrf
                        <div class="flex items-center gap-2 border-b-2 border-gray-50 py-1 transition-all duration-300 group-focus-within:border-emerald-500 hover:border-gray-200">
                            <span class="text-[9px] font-black text-emerald-600 tracking-tighter">RP</span>
                            <input type="number" name="price" value="{{ number_format($bin->price_per_kg, 0, '', '') }}" 
                                class="w-full bg-transparent border-none p-0 text-sm font-black text-gray-700 focus:ring-0 placeholder-gray-200">
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
</div>
@endsection