<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORTIR.IN - Sistem Pemilahan Sampah Pintar IoT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .bg-sultan { background-color: #0F2B26; }
        .text-emerald-sultan { color: #10B981; }
        .glow-effect { box-shadow: 0 0 40px -10px rgba(16, 185, 129, 0.4); }
    </style>
</head>
<body class="bg-[#F4F7F6] text-slate-800 overflow-x-hidden">

    <!-- 1. NAVIGATION -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-6 py-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center bg-white/80 backdrop-blur-xl border border-white/20 px-8 py-4 rounded-[2.5rem] shadow-2xl shadow-emerald-900/5">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-sultan rounded-xl text-white shadow-lg">
                    <i class="fas fa-recycle text-sm"></i>
                </div>
                <span class="font-black text-xl tracking-tighter italic uppercase text-sultan">SORTIR.IN</span>
            </div>
            <div class="hidden lg:flex gap-10 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                <a href="#solusi" class="hover:text-emerald-600 transition">Solusi</a>
                <a href="#cara-kerja" class="hover:text-emerald-600 transition">Cara Kerja</a>
                <a href="#komponen" class="hover:text-emerald-600 transition">Komponen</a>
                <a href="#pengujian" class="hover:text-emerald-600 transition">Pengujian</a>
            </div>
            <a href="{{ route('login') }}" class="bg-sultan hover:bg-emerald-700 text-white px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-xl flex items-center gap-2">
                Masuk Sistem <i class="fas fa-arrow-right text-[8px]"></i>
            </a>
        </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <section class="relative pt-60 pb-32 px-6">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-100 rounded-full blur-[120px] opacity-40 -z-10"></div>
        <div class="max-w-6xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest mb-10 border border-emerald-100/50">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></span>
                Vokasi Universitas Brawijaya • Proyek IoT 2026
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-sultan tracking-tighter leading-[1.1] mb-8">
                Sistem Monitoring & Optimasi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 font-black italic">Pemilahan Sampah Pintar</span>
            </h1>
            <p class="max-w-3xl mx-auto text-gray-500 text-sm md:text-lg font-medium leading-relaxed mb-12">
                Revolusi pengelolaan limbah modern yang mengintegrasikan sensor fisik presisi tinggi dengan dashboard analitik berbasis Cloud secara Real-Time.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#solusi" class="px-12 py-6 bg-sultan text-white rounded-[2rem] font-black text-[11px] uppercase tracking-widest shadow-2xl hover:bg-emerald-700 transition-all glow-effect">Pelajari Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- 3. PERMASALAHAN & SOLUSI (DARI X-BANNER) -->
    <section id="solusi" class="py-24 px-6 bg-white rounded-[5rem] shadow-2xl shadow-emerald-900/5 mx-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20">
            <!-- Permasalahan -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-xs font-black text-red-500 uppercase tracking-[0.4em] mb-4">Latar Belakang</h2>
                    <h3 class="text-4xl font-black text-sultan tracking-tight">Permasalahan Lapangan</h3>
                </div>
                <div class="space-y-6">
                    <div class="flex gap-6 p-6 bg-red-50/50 rounded-3xl border border-red-100/50">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center shrink-0"><i class="fas fa-trash-alt"></i></div>
                        <p class="text-sm font-bold text-slate-600 leading-relaxed">Tercampurnya sampah kering, basah, dan logam yang merusak kualitas daur ulang.</p>
                    </div>
                    <div class="flex gap-6 p-6 bg-red-50/50 rounded-3xl border border-red-100/50">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center shrink-0"><i class="fas fa-user-nurse"></i></div>
                        <p class="text-sm font-bold text-slate-600 leading-relaxed">Petugas kebersihan mengalami kesulitan dan risiko kesehatan saat memilah secara manual.</p>
                    </div>
                    <div class="flex gap-6 p-6 bg-red-50/50 rounded-3xl border border-red-100/50">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center shrink-0"><i class="fas fa-chart-line-down"></i></div>
                        <p class="text-sm font-bold text-slate-600 leading-relaxed">Berkurangnya nilai ekonomi pada sampah akibat kontaminasi limbah organik.</p>
                    </div>
                </div>
            </div>

            <!-- Solusi -->
            <div class="bg-sultan rounded-[4rem] p-12 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 p-12 opacity-10 text-9xl"><i class="fas fa-lightbulb"></i></div>
                <h2 class="text-xs font-black text-emerald-400 uppercase tracking-[0.4em] mb-6">Solusi Kami</h2>
                <h3 class="text-3xl font-black mb-8 leading-tight italic">Sortir.in hadir sebagai solusi pintar berbasis IoT.</h3>
                <p class="text-emerald-100/60 leading-loose text-sm font-medium mb-10">
                    Sistem kami secara otomatis mendeteksi dan memilah tiga jenis sampah menggunakan sensor mutakhir. Informasi kapasitas volume dan berat sampah dikirim secara real-time ke dashboard monitoring pintar untuk memudahkan pengelolaan dan menjaga nilai jual material.
                </p>
                <div class="flex items-center gap-4 border-t border-white/10 pt-8">
                    <div class="p-3 bg-emerald-500 rounded-xl text-xs"><i class="fas fa-check-double"></i></div>
                    <span class="text-[10px] font-black uppercase tracking-widest">Akurasi Deteksi Tinggi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. CARA KERJA SISTEM (HORIZONTAL STEPS) -->
    <section id="cara-kerja" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-sultan tracking-tight mb-4">Cara Kerja Sistem</h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.3em]">Alur Pemilahan Dari Input Hingga Cloud</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                @php
                    $steps = [
                        ['icon' => 'fa-box-open', 'title' => 'Objek Masuk', 'desc' => 'Sampah diletakkan pada wadah input.'],
                        ['icon' => 'fa-search', 'title' => 'Identifikasi', 'desc' => 'Sensor mendeteksi material objek.'],
                        ['icon' => 'fa-microchip', 'title' => 'Pemilahan', 'desc' => 'Motor servo mengarahkan sampah ke wadah.'],
                        ['icon' => 'fa-wifi', 'title' => 'Kirim Data', 'desc' => 'Data dikirim via MQTT ke server.'],
                        ['icon' => 'fa-desktop', 'title' => 'Dashboard', 'desc' => 'Monitoring hasil secara real-time.'],
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 bg-white border border-emerald-100 rounded-3xl flex items-center justify-center text-2xl text-emerald-500 mb-6 shadow-sm group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <i class="fas {{ $step['icon'] }}"></i>
                    </div>
                    <h4 class="font-black text-xs uppercase tracking-widest mb-2">{{ $step['title'] }}</h4>
                    <p class="text-[10px] text-gray-400 leading-relaxed px-4">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. KOMPONEN UTAMA (HARDWARE & SOFTWARE) -->
    <section id="komponen" class="py-32 px-6 bg-sultan rounded-[5rem] text-white mx-4 shadow-2xl">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-20 border-b border-white/5 pb-10">
                <div>
                    <h2 class="text-4xl font-black tracking-tight mb-2 italic text-emerald-400">Arsitektur Komponen</h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40">Teknologi yang menggerakkan Sortir.in</p>
                </div>
                <i class="fas fa-microchip text-6xl opacity-10"></i>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Hardware -->
                <div class="bg-white/5 p-10 rounded-[3rem] border border-white/5">
                    <h4 class="text-emerald-400 font-black text-sm uppercase tracking-widest mb-10 flex items-center gap-3">
                        <i class="fas fa-hardware"></i> Perangkat Keras
                    </h4>
                    <ul class="space-y-6 text-sm font-bold opacity-70">
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-emerald-500"></i> ESP32 Microcontroller</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-emerald-500"></i> Sensor Proximity Induktif & Kapasitif</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-emerald-500"></i> Sensor Ultrasonik HC-SR04</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-emerald-500"></i> Load Cell + HX711 (Sensor Berat)</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-emerald-500"></i> Motor Servo SG90 High Torque</li>
                    </ul>
                </div>

                <!-- Software -->
                <div class="bg-white/5 p-10 rounded-[3rem] border border-white/5">
                    <h4 class="text-blue-400 font-black text-sm uppercase tracking-widest mb-10 flex items-center gap-3">
                        <i class="fas fa-code"></i> Perangkat Lunak
                    </h4>
                    <ul class="space-y-6 text-sm font-bold opacity-70">
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-blue-500"></i> Laravel Framework (Backend)</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-blue-500"></i> Vue.js (Frontend Interaktif)</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-blue-500"></i> MQTT Broker (Data Transmission)</li>
                        <li class="flex items-center gap-4"><i class="fas fa-check-circle text-blue-500"></i> Cloud Hosting & Secure HTTPS</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. HASIL PENGUJIAN (TABEL) -->
    <section id="pengujian" class="py-32 px-6">
        <div class="max-w-4xl mx-auto bg-white p-12 rounded-[4rem] shadow-xl border border-gray-50 text-center">
            <h3 class="text-2xl font-black text-sultan mb-12 uppercase tracking-tight italic">Hasil Pengujian Sistem</h3>
            <div class="overflow-hidden rounded-3xl border border-gray-50">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                        <tr>
                            <th class="px-8 py-5">Item Pengujian</th>
                            <th class="px-8 py-5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @php
                            $tests = ['Deteksi Logam', 'Deteksi Sampah Basah', 'Deteksi Sampah Kering', 'Monitoring Dashboard', 'Pengiriman Data (MQTT)', 'Akurasi Berat (Load Cell)'];
                        @endphp
                        @foreach($tests as $test)
                        <tr class="hover:bg-emerald-50/30 transition-all">
                            <td class="px-8 py-5 font-bold text-slate-600">{{ $test }}</td>
                            <td class="px-8 py-5 text-right"><span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">Berhasil</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 7. MANFAAT PRODUK -->
    <section class="py-32 px-6 bg-emerald-50/30 rounded-[5rem] mx-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20 italic">
                <h2 class="text-3xl font-black text-sultan tracking-tight mb-4">Manfaat Utama Produk</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm text-center">
                    <i class="fas fa-hand-holding-heart text-emerald-500 text-4xl mb-6"></i>
                    <p class="text-xs font-black uppercase tracking-widest mb-4">Budaya Bersih</p>
                    <p class="text-[11px] text-gray-400 font-medium leading-relaxed uppercase">Meningkatkan kebiasaan memilah sampah sejak dari sumbernya.</p>
                </div>
                <div class="bg-white p-10 rounded-[3rem] shadow-sm text-center">
                    <i class="fas fa-donate text-emerald-500 text-4xl mb-6"></i>
                    <p class="text-xs font-black uppercase tracking-widest mb-4">Nilai Ekonomi</p>
                    <p class="text-[11px] text-gray-400 font-medium leading-relaxed uppercase">Menjaga nilai jual sampah daur ulang agar tidak terkontaminasi.</p>
                </div>
                <div class="bg-white p-10 rounded-[3rem] shadow-sm text-center">
                    <i class="fas fa-microchip text-emerald-500 text-4xl mb-6"></i>
                    <p class="text-xs font-black uppercase tracking-widest mb-4">Monitoring</p>
                    <p class="text-[11px] text-gray-400 font-medium leading-relaxed uppercase">Memudahkan pemantauan sampah secara real-time dan terpusat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. FOOTER & CTA -->
    <footer class="pt-32 pb-20 px-10 text-center">
        <div class="flex flex-col items-center gap-10">
            <div class="p-4 bg-sultan rounded-3xl text-white text-xl shadow-2xl">
                <i class="fas fa-recycle animate-spin-slow"></i>
            </div>
            <div class="space-y-2">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.8em] ml-2">SORTIR.IN ECOSYSTEM</p>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em]">Universitas Brawijaya • Departemen Teknologi Informasi</p>
            </div>
            <div class="flex gap-8 text-gray-400 text-xs">
                <i class="fab fa-instagram hover:text-emerald-500 cursor-pointer transition"></i>
                <i class="fab fa-github hover:text-emerald-500 cursor-pointer transition"></i>
                <i class="fab fa-linkedin hover:text-emerald-500 cursor-pointer transition"></i>
            </div>
        </div>
    </footer>

</body>
</html>