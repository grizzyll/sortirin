@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pekerja TPS</h2>
        <button onclick="document.getElementById('modalWorker').classList.remove('hidden')" class="bg-green-600 text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-green-700 transition">
            + Tambah Pekerja
        </button>
    </div>

    <!-- Tabel Pekerja -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Pekerja</th>
                    <th class="px-6 py-4">NIK</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($workers as $worker)
                <tr class="border-t border-gray-50 hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $worker->name }}</td>
                    <td class="px-6 py-4">{{ $worker->nik }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">
                            {{ $worker->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" onsubmit="return confirm('Hapus pekerja ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Pekerja (Simple) -->
<div id="modalWorker" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
        <h3 class="text-xl font-bold mb-6">Tambah Anggota Baru</h3>
        <form action="{{ route('workers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 mt-1 focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase">NIK (Nomor Induk Karyawan)</label>
                <input type="text" name="nik" class="w-full border border-gray-200 rounded-xl px-4 py-3 mt-1 focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="document.getElementById('modalWorker').classList.add('hidden')" class="flex-1 py-3 text-gray-400 font-bold">Batal</button>
                <button type="submit" class="flex-1 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection