@extends('layouts.app')

@section('content')
<div class="space-y-6 p-2">

    @if(session('success'))
        <div class="fixed top-10 right-10 z-50 bg-[#0F2B26] text-white px-5 py-3 rounded-2xl shadow-2xl border border-emerald-500/20 flex items-center gap-4 animate-fade-in">
            <div class="bg-emerald-500 p-1.5 rounded-full text-[8px]">
                <i class="fas fa-check"></i>
            </div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight">Operasional TPS</h1>
            </p>
        </div>
        <div class="px-4 py-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Sistem Terhubung</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
            <div>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em] mb-1">Total Estimasi Ekonomi</p>
                <h3 class="text-3xl font-black text-gray-800 tracking-tight">
                    <span class="text-emerald-500 text-lg font-bold">Rp</span>
                    <span id="text-ekonomi">{{ number_format($totalEkonomi, 0, ',', '.') }}</span>
                </h3>
                <p class="mt-2 text-[8px] text-emerald-500 font-black uppercase italic tracking-wider">
                    <i class="fas fa-sync-alt fa-spin mr-1"></i> Data diperbarui otomatis
                </p>
            </div>
            <div class="p-6 bg-emerald-50 text-emerald-600 rounded-[1.5rem] shadow-inner transition-transform group-hover:scale-105">
                <i class="fas fa-wallet text-2xl"></i>
            </div>
        </div>

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

    {{-- SECTION KAPASITAS RATA-RATA --}}
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-10 px-2">
            <h3 class="text-base font-black text-gray-800 tracking-[0.2em] uppercase flex items-center gap-2">
                <div class="w-6 h-1 bg-emerald-500 rounded-full"></div>
                Kapasitas Rata-Rata Kota
            </h3>
            <div class="flex gap-1">
                <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                <div class="w-1 h-1 rounded-full bg-emerald-500"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- LOOP BERDASARKAN TIPE, BUKAN $bins --}}
            @foreach(['Organik', 'Anorganik', 'Logam'] as $tipe)
            @php
                $data      = $avgKapasitas[$tipe] ?? null;
                $kapasitas = $data ? round($data->avg_capacity) : 0;
                $slugType  = $tipe == 'Organik' ? 'basah' : ($tipe == 'Anorganik' ? 'kering' : 'logam');
                $warnaBar  = $tipe == 'Organik'
                    ? 'bg-gradient-to-t from-emerald-600 to-emerald-400'
                    : ($tipe == 'Anorganik'
                        ? 'bg-gradient-to-t from-blue-600 to-blue-400'
                        : 'bg-gradient-to-t from-amber-500 to-amber-300');
                $labelTipe = $tipe == 'Organik' ? 'BASAH' : ($tipe == 'Anorganik' ? 'KERING' : 'LOGAM');
            @endphp

            <div class="flex flex-col items-center">
                <div class="relative w-36 h-56 bg-slate-50 border-[5px] border-white rounded-b-[3.5rem] shadow-2xl overflow-hidden flex flex-col-reverse group transition-all">

                    <div id="bar-{{ $slugType }}"
                         class="transition-all duration-500 ease-in-out w-full {{ $warnaBar }}"
                         style="height: {{ $kapasitas }}%">
                        <div class="absolute top-0 left-0 w-full h-8 bg-white/20 blur-xl"></div>
                    </div>

                    <div class="absolute inset-0 flex flex-col items-center justify-center z-10">
                        <span id="persen-{{ $slugType }}"
                              class="text-2xl font-black text-gray-800 tracking-tighter drop-shadow-sm transition-colors duration-300">
                            {{ $kapasitas }}%
                        </span>
                        <span id="berat-{{ $slugType }}"
                              class="text-[10px] font-bold text-gray-400 tracking-tight mt-0.5">
                            0.0 g
                        </span>
                    </div>
                </div>

                <div class="mt-8 text-center w-full px-4 flex flex-col items-center">
                    <h4 class="font-black text-gray-800 uppercase tracking-[0.2em] text-sm mb-1">
                        {{ $labelTipe }}
                    </h4>
                    <p class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.3em] mb-6">
                        Rata-rata Seluruh Wilayah
                    </p>
                    {{-- 
                        CATATAN: form update harga dihapus dari sini karena ini tampilan RATA-RATA,
                        bukan per-bin. Update harga sebaiknya dilakukan di halaman per-lokasi/per-bin.
                        Kalau tetap mau di sini, kamu harus rethink flow-nya dulu.
                    --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- SECTION LOG PEMILAHAN --}}
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-50">
        <div class="flex justify-between items-center mb-8 px-2">
            <h3 class="text-sm font-black text-gray-800 tracking-[0.2em] uppercase flex items-center gap-3">
                <div class="w-6 h-1 bg-emerald-500 rounded-full"></div>
                Log Pemilahan Terkini
            </h3>
            <a href="/history" class="text-[9px] font-black text-emerald-600 hover:text-[#0F2B26] uppercase tracking-widest border-b border-emerald-100 pb-0.5 transition-all">
                Pusat Analitik
            </a>
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
                                Sampah
                                @if($log->waste_type == 'Organik') Basah
                                @elseif($log->waste_type == 'Anorganik') Kering
                                @else Logam @endif
                                Terdeteksi
                            </p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">
                                {{ $log->created_at->format('H:i:s') }} WIB
                                <span class="mx-2 text-gray-200">|</span>
                                {{ $log->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-black text-gray-800 tracking-tight">
                            {{ $log->weight }} <span class="text-[9px] text-gray-300 font-bold">g</span>
                        </p>
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

<script>
    function updateDashboardRealtime() {
        fetch('/api/live-dashboard')
            .then(response => response.json())
            .then(data => {
                const ekonomiElem = document.getElementById('text-ekonomi');
                if (ekonomiElem) ekonomiElem.innerText = data.total_ekonomi;

                const persenBasah = document.getElementById('persen-basah');
                const beratBasah  = document.getElementById('berat-basah');
                const barBasah    = document.getElementById('bar-basah');
                if (persenBasah) {
                    persenBasah.innerText = data.volume_basah + '%';
                    persenBasah.className = data.volume_basah > 50
                        ? 'text-2xl font-black text-white tracking-tighter'
                        : 'text-2xl font-black text-gray-800 tracking-tighter';
                }
                if (beratBasah) beratBasah.innerText = data.berat_basah_format;
                if (barBasah) barBasah.style.height = data.volume_basah + '%';

                const persenKering = document.getElementById('persen-kering');
                const beratKering  = document.getElementById('berat-kering');
                const barKering    = document.getElementById('bar-kering');
                if (persenKering) {
                    persenKering.innerText = data.volume_kering + '%';
                    persenKering.className = data.volume_kering > 50
                        ? 'text-2xl font-black text-white tracking-tighter'
                        : 'text-2xl font-black text-gray-800 tracking-tighter';
                }
                if (beratKering) beratKering.innerText = data.berat_kering_format;
                if (barKering) barKering.style.height = data.volume_kering + '%';

                const persenLogam = document.getElementById('persen-logam');
                const beratLogam  = document.getElementById('berat-logam');
                const barLogam    = document.getElementById('bar-logam');
                if (persenLogam) {
                    persenLogam.innerText = data.volume_logam + '%';
                    persenLogam.className = data.volume_logam > 50
                        ? 'text-2xl font-black text-white tracking-tighter'
                        : 'text-2xl font-black text-gray-800 tracking-tighter';
                }
                if (beratLogam) beratLogam.innerText = data.berat_logam_format;
                if (barLogam) barLogam.style.height = data.volume_logam + '%';
            })
            .catch(error => console.error('Gagal mengambil data live API:', error));
    }

    setInterval(updateDashboardRealtime, 2000);
</script>
@endsection