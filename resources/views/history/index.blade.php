@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Riwayat Pemilahan</h1>
            <p class="text-sm text-gray-400 font-medium italic underline decoration-emerald-500">Aktivitas Deteksi IoT (GZB-006)</p>
        </div>
        <div class="px-5 py-2 bg-emerald-50 text-emerald-600 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-emerald-100">
            Total Data: {{ $logs->total() }} Entry
        </div>
    </div>

    <!-- Premium Table Container -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-50 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-50">
                <tr>
                    <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center w-20">ID</th>
                    <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu Pemilahan</th>
                    <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Jenis Sampah</th>
                    <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Estimasi Berat</th>
                    <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Status Sistem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($logs as $log)
                <tr class="group hover:bg-emerald-50/30 transition-all duration-300">
                    <td class="px-8 py-6 text-center text-xs font-bold text-gray-300 italic">#{{ $log->id }}</td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-gray-700 tracking-tight">{{ $log->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] font-bold text-gray-400">{{ $log->created_at->format('H:i:s') }} WIB</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <!-- LOGIKA LABEL SINKRON (BASAH, KERING, LOGAM) -->
                        @php
                            $label = $log->waste_type;
                            $colorClass = '';
                            
                            if (strtolower($label) == 'organik') {
                                $label = 'BASAH';
                                $colorClass = 'bg-emerald-100 text-emerald-600 border-emerald-200';
                            } elseif (strtolower($label) == 'anorganik') {
                                $label = 'KERING';
                                $colorClass = 'bg-blue-100 text-blue-600 border-blue-200';
                            } else {
                                $label = 'LOGAM';
                                $colorClass = 'bg-amber-100 text-amber-600 border-amber-200';
                            }
                        @endphp
                        
                        <span class="inline-block px-4 py-1.5 rounded-full text-[9px] font-black tracking-widest border {{ $colorClass }}">
                            {{ $label }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="font-mono font-black text-gray-700 text-sm">{{ $log->weight }} <span class="text-gray-400 font-normal">Kg</span></span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2 text-emerald-500 font-black text-[10px] uppercase tracking-widest">
                            <i class="fas fa-check-circle"></i>
                            Success
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Elegant Pagination -->
        <div class="p-8 bg-gray-50/50 border-t border-gray-50">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection