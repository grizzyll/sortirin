<div class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-white border-r">
    <h2 class="text-3xl font-semibold text-green-800 flex items-center gap-2">
        <i class="fas fa-recycle"></i> SORTIR.IN
    </h2>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav>
            <!-- MENU UMUM (Dashboard Monitoring - GZB-004) -->
            <a class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-lg" href="{{ route('dashboard') }}">
                <i class="fas fa-home w-5"></i>
                <span class="mx-4 font-medium">Dashboard Real-time</span>
            </a>

            <!-- KHUSUS OPERATOR TPS (PDF Hal 12 & 17) -->
            <div class="mt-8">
                <span class="px-4 text-xs text-gray-400 uppercase">Manajemen TPS</span>
                
                <!-- Mengelola Pekerja (Activity 10) -->
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-green-100 hover:text-green-800" href="/workers">
                    <i class="fas fa-users w-5"></i>
                    <span class="mx-4 font-medium">Data Pekerja</span>
                </a>

                <!-- Mengelola Jadwal & Cetak (Activity 8 & 9) -->
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-green-100 hover:text-green-800" href="{{ route('schedules.index') }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="mx-4 font-medium">Jadwal Tugas</span>
                </a>

                <!-- Riwayat Pemilahan (Activity 7) -->
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-green-100 hover:text-green-800" href="/history">
                    <i class="fas fa-history w-5"></i>
                    <span class="mx-4 font-medium">Riwayat Sampah</span>
                </a>
            </div>

            <!-- KHUSUS OPERATOR TPA (PDF Hal 12 & 17) -->
            <div class="mt-8">
                <span class="px-4 text-xs text-gray-400 uppercase">Monitoring TPA (Pusat)</span>
                
                <!-- Melihat Data Statistik Makro (GZB-012) -->
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-blue-100 hover:text-blue-800" href="/statistik-kota">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="mx-4 font-medium">Statistik Kota</span>
                </a>
                
                <!-- Melihat Data Pekerja Seluruh TPS (Activity 14) -->
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-blue-100 hover:text-blue-800" href="/tpa/pekerja">
                    <i class="fas fa-city w-5"></i>
                    <span class="mx-4 font-medium">Monitor Pekerja</span>
                </a>
            </div>
        </nav>

        <!-- Akun User -->
        <div class="flex items-center px-4 -mx-2 mt-10 border-t pt-4">
            <img class="object-cover mx-2 rounded-full h-9 w-9" src="https://ui-avatars.com/api/?name=Admin+Sortirin" alt="avatar">
            <span class="mx-2 font-medium text-gray-800">Admin TPS</span>
        </div>
    </div>
</div>