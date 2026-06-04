@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- 1. TOP HEADER (Bersih & Searah) -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Jadwal Tugas</h1>
            <p class="text-sm text-gray-400 font-medium italic underline decoration-emerald-500">Shift Management System</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Button Tambah (Sultan Style) -->
            <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')" 
                    class="bg-[#0F2B26] hover:bg-emerald-800 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg active:scale-95 flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </button>

            <!-- Button Cetak (Aksen Rose Soft) -->
            <a href="{{ route('schedules.pdf', ['filter' => request('filter')]) }}" 
               class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg shadow-rose-100 flex items-center gap-2 active:scale-95">
                <i class="fas fa-file-pdf"></i> Cetak PDF
            </a>
        </div>
    </div>

    <!-- 2. SMART FILTER BAR (Tab-Style, bukan Dropdown kaku) -->
    <div class="bg-white p-2 rounded-3xl shadow-sm border border-gray-50 flex items-center gap-2 w-max">
        @php $currentFilter = request('filter'); @endphp
        <a href="{{ route('schedules.index') }}" 
           class="px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ !$currentFilter ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-emerald-600' }}">
            Semua
        </a>
        <a href="{{ route('schedules.index', ['filter' => 'today']) }}" 
           class="px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentFilter == 'today' ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-emerald-600' }}">
            Hari Ini
        </a>
        <a href="{{ route('schedules.index', ['filter' => 'week']) }}" 
           class="px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentFilter == 'week' ? 'bg-[#0F2B26] text-white shadow-md' : 'text-gray-400 hover:text-emerald-600' }}">
            Minggu Ini
        </a>
    </div>

    <!-- 3. TABLE AREA (Rounded, Sultan Emerald accents) -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-50 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-50">
                <tr>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pekerja</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu Penugasan</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Shift</th>
                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($schedules as $s)
                <tr class="group hover:bg-emerald-50/40 transition-all">
                    <td class="px-10 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-xs">
                                {{ substr($s->worker->name, 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-700">{{ $s->worker->name }}</span>
                        </div>
                    </td>
                    <td class="px-10 py-6 text-sm text-gray-500 font-medium">
                        {{ \Carbon\Carbon::parse($s->date)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-10 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-tighter shadow-sm
                            {{ $s->shift == 'Pagi' ? 'bg-blue-50 text-blue-600' : ($s->shift == 'Siang' ? 'bg-amber-50 text-amber-600' : 'bg-indigo-50 text-indigo-600') }}">
                            {{ $s->shift }}
                        </span>
                    </td>
                    <td class="px-10 py-6 text-right">
                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Confirmed
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <i class="fas fa-calendar-alt text-7xl mb-4"></i>
                            <p class="font-black text-xs uppercase tracking-[0.3em]">Jadwal Belum Terisi</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- 4. MODAL TAMBAH (Minimalist & Dark) -->
<div id="modalJadwal" class="fixed inset-0 bg-[#0F2B26]/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-[3rem] p-10 w-full max-w-md shadow-2xl border border-white/20 animate-in fade-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter">Buat Jadwal Baru</h3>
            <button onclick="document.getElementById('modalJadwal').classList.add('hidden')" class="text-gray-400 hover:text-gray-800 text-2xl">&times;</button>
        </div>

        <form action="{{ route('schedules.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Pilih Anggota</label>
                <select name="worker_id" class="w-full bg-gray-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 shadow-inner appearance-none" required>
                    <option value="" disabled selected>-- Cari Nama --</option>
                    @foreach(\App\Models\Worker::all() as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Tanggal</label>
                <input type="date" name="date" class="w-full bg-gray-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 shadow-inner" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Shift</label>
                <select name="shift" class="w-full bg-gray-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 shadow-inner appearance-none" required>
                    <option value="Pagi">Pagi (Shift A)</option>
                    <option value="Siang">Siang (Shift B)</option>
                    <option value="Malam">Malam (Shift C)</option>
                </select>
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-[#0F2B26] hover:bg-emerald-600 text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-emerald-900/20 transition-all active:scale-95">
                    Save Schedule
                </button>
            </div>
        </form>
    </div>
</div>
@endsection