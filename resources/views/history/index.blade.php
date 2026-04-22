@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Pemilahan Sampah</h2>
            <p class="text-sm text-gray-500 italic">Data aktivitas otomatis dari alat IoT (GZB-006)</p>
        </div>
        <button onclick="window.print()" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold text-sm hover:bg-gray-200 transition">
            <i class="fas fa-print mr-2"></i> Cetak Laporan
        </button>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4 text-center w-16">ID</th>
                    <th class="px-6 py-4">Waktu Pemilahan</th>
                    <th class="px-6 py-4 text-center">Jenis Sampah</th>
                    <th class="px-6 py-4 text-center">Estimasi Berat</th>
                    <th class="px-6 py-4 text-center">Status Sistem</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($logs as $log)
                <tr class="border-t border-gray-50 hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-center text-gray-400">#{{ $log->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $log->created_at->format('d M Y') }} 
                        <span class="text-gray-400 ml-2 text-xs">{{ $log->created_at->format('H:i:s') }} WIB</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase
                            {{ $log->waste_type == 'Organik' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $log->waste_type == 'Anorganik' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $log->waste_type == 'Logam' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                            {{ $log->waste_type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-mono font-bold text-gray-700">{{ $log->weight }} Kg</span>
                    </td>
                    <td class="px-6 py-4 text-center text-green-500 font-bold">
                        <i class="fas fa-check-circle mr-1"></i> Success
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Link Pagination (Jika data banyak) -->
        <div class="p-4 bg-gray-50">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection