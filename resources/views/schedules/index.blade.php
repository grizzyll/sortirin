@extends('layouts.app') <!-- Pastikan layout app kamu sudah memanggil sidebar di atas -->

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jadwal Tugas Pekerja TPS</h1>
        
        <!-- TOMBOL CETAK (Sesuai Activity Diagram 9) -->
        <a href="{{ route('schedules.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Cetak Jadwal (PDF)
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 border-b">Nama Pekerja</th>
                    <th class="p-4 border-b">Tanggal</th>
                    <th class="p-4 border-b">Shift</th>
                    <th class="p-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $s)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">{{ $s->worker->name }}</td>
                    <td class="p-4 border-b">{{ $s->date }}</td>
                    <td class="p-4 border-b">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">{{ $s->shift }}</span>
                    </td>
                    <td class="p-4 border-b text-green-600 font-bold">Aktif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection