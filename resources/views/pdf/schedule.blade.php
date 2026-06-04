@extends('layouts.app')

@section('content')
<div class="space-y-8 p-2">
    <!-- HEADER SECTION -->
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Jadwal Tugas</h1>
            <p class="text-sm text-gray-400 font-medium italic underline decoration-emerald-500">Manajemen Shift & Penugasan Pekerja TPS</p>
        </div>
        
        <!-- TOMBOL CETAK PREMIUM -->
        <a href="{{ route('schedules.pdf', ['filter' => request('filter')]) }}" 
           class="group bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-rose-200 flex items-center gap-3 active:scale-95">
            <i class="fas fa-file-pdf text-sm group-hover:rotate-12 transition-transform"></i>
            Cetak Laporan PDF
        </a>
    </div>

    <!-- ELEGAN FILTER BAR (Activity Diagram 8 & 9) -->
    <div class="bg-white p-3 rounded-[2rem] shadow-sm border border-gray-50 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2 p-1 bg-gray-50 rounded-2xl">
            @php $currentFilter = request('filter'); @endphp
            
            <!-- Link Filter sebagai Tab -->
            <a href="{{ route('schedules.index') }}" 
               class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ !$currentFilter ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-gray-600' }}">
                Semua
            </a>
            <a href="{{ route('schedules.index', ['filter' => 'today']) }}" 
               class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentFilter == 'today' ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-gray-600' }}">
                Hari Ini
            </a>
            <a href="{{ route('schedules.index', ['filter' => 'week']) }}" 
               class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentFilter == 'week' ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-gray-600' }}">
                Minggu Ini
            </a>
            <a href="{{ route('schedules.index', ['filter' => 'month']) }}" 
               class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentFilter == 'month' ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-gray-600' }}">
                Bulan Ini
            </a>
        </div>

        <div class="px-6 py-2 border-l border-gray-100 hidden md:block">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em]">
                <i class="fas fa-calendar-check mr-2"></i> Terjadwal: {{ $schedules->count() }} Tugas
            </p>
        </div>
    </div>

    <!-- DATA TABLE PREMIUM -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-50 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Pekerja</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tanggal Tugas</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Shift</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($schedules as $s)
                <tr class="group hover:bg-emerald-50/30 transition-all duration-300">
                    <td class="px-10 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs shadow-sm group-hover:scale-110 transition-transform">
                                {{ substr($s->worker->name, 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-700">{{ $s->worker->name }}</span>
                        </div>
                    </td>
                    <td class="px-10 py-6">
                        <span class="text-sm font-medium text-gray-500">{{ \Carbon\Carbon::parse($s->date)->format('d F Y') }}</span>
                    </td>
                    <td class="px-10 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-tighter
                            {{ $s->shift == 'Pagi' ? 'bg-blue-50 text-blue-500' : ($s->shift == 'Siang' ? 'bg-amber-50 text-amber-500' : 'bg-indigo-50 text-indigo-500') }}">
                            {{ $s->shift }}
                        </span>
                    </td>
                    <td class="px-10 py-6 text-right">
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest flex items-center justify-end gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Confirmed
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-10 py-20 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <i class="fas fa-calendar-times text-6xl mb-4 text-gray-400"></i>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-[0.2em]">Tidak Ada Jadwal Ditemukan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection