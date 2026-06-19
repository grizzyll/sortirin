<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SORTIR.IN — sistem pemilahan sampah otomatis berbasis IoT dengan monitoring real-time untuk operator TPS dan TPA. Proyek Vokasi Universitas Brawijaya.">
    <title>SORTIR.IN — Pemilahan Sampah Otomatis & Termonitor</title>

    <!-- TODO sebelum production sungguhan: migrasikan Tailwind dari CDN ke build Vite bawaan Laravel.
         CDN ini cocok untuk iterasi cepat, tapi tidak melakukan purge CSS dan lebih berat di koneksi lapangan. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sultan: { DEFAULT: '#0F2B26', deep: '#0A1F1B', line: 'rgba(255,255,255,0.08)' },
                        canvas: '#F3F6F1',
                        emerald: { glow: '#34D399' },
                        organik: { DEFAULT: '#92400E', soft: '#FEF3E2' },
                        anorganik: { DEFAULT: '#2563EB', soft: '#EAF1FE' },
                        logam: { DEFAULT: '#475569', soft: '#EEF1F4' },
                    },
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                        body: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"IBM Plex Mono"', 'monospace'],
                    },
                }
            }
        }
    </script>

    <style>
        body { scroll-behavior: smooth; }

        @keyframes fillRise {
            from { height: 0%; }
            to   { height: var(--fill); }
        }
        .bin-fill { animation: fillRise 1.4s cubic-bezier(.22,1,.36,1) both; animation-delay: var(--delay, 0s); }

        @media (prefers-reduced-motion: reduce) {
            .bin-fill { animation: none; height: var(--fill); }
            * { scroll-behavior: auto !important; }
        }

        a:focus-visible, button:focus-visible {
            outline: 2px solid #34D399;
            outline-offset: 3px;
            border-radius: 4px;
        }
    </style>
</head>
<body class="font-body bg-canvas text-slate-700 antialiased overflow-x-hidden">

    <!-- NAV -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center bg-white/90 backdrop-blur-lg border border-white/40 px-5 sm:px-7 py-3 rounded-3xl shadow-lg shadow-sultan/5">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-sultan rounded-xl text-white flex items-center justify-center">
                    <i class="fas fa-recycle text-sm" aria-hidden="true"></i>
                </div>
                <span class="font-display font-bold text-lg tracking-tight text-sultan">SORTIR.IN</span>
            </div>
            <div class="hidden md:flex gap-8 text-xs font-semibold text-slate-500">
                <a href="#cara-kerja" class="hover:text-sultan transition">Cara Kerja</a>
                <a href="#teknologi" class="hover:text-sultan transition">Teknologi</a>
            </div>
            <a href="{{ route('login') }}"
               class="bg-sultan hover:bg-emerald-700 text-white pl-5 pr-4 py-2.5 rounded-2xl text-xs font-semibold transition-all flex items-center gap-2">
                Masuk Sistem <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i>
            </a>
        </div>
    </nav>

    <main>
    <!-- HERO -->
    <section class="relative pt-36 sm:pt-44 pb-20 px-4 sm:px-6">
        <div class="absolute top-20 right-0 w-[420px] h-[420px] bg-emerald-200/30 rounded-full blur-[100px] -z-10"></div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-16 items-center">
            <!-- Copy -->
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-[11px] font-semibold mb-7 border border-emerald-100">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    Vokasi Universitas Brawijaya &middot; Proyek IoT 2026
                </div>

                <h1 class="font-display font-bold text-sultan tracking-tight leading-[1.08] mb-6 text-[clamp(2.25rem,5vw,3.5rem)]">
                    Sampah Terpilah Sendiri,<br>
                    <span class="text-emerald-600">Anda Tinggal Pantau.</span>
                </h1>

                <p class="text-slate-500 text-sm sm:text-base leading-relaxed mb-9 max-w-md">
                    SORTIR.IN memilah sampah organik, anorganik, dan logam secara otomatis lewat sensor IoT,
                    lalu mengirim datanya langsung ke dashboard operator TPS dan TPA secara real-time.
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('login') }}"
                       class="px-7 py-3.5 bg-sultan text-white rounded-2xl font-semibold text-sm shadow-lg shadow-sultan/20 hover:bg-emerald-700 transition-all">
                        Masuk Sistem
                    </a>
                    <a href="#cara-kerja"
                       class="px-7 py-3.5 bg-white text-sultan border border-sultan/15 rounded-2xl font-semibold text-sm hover:bg-sultan/5 transition-all">
                        Lihat Cara Kerja
                    </a>
                </div>
            </div>

            <!-- Signature: live bin preview -->
            <div class="bg-sultan rounded-[2.5rem] p-7 sm:p-9 shadow-2xl shadow-sultan/30">
                <div class="flex items-center justify-between mb-7">
                    <p class="text-[11px] font-mono text-emerald-300 tracking-wide">PRATINJAU DASHBOARD</p>
                    <span class="flex items-center gap-1.5 text-[10px] font-mono text-emerald-300/70">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> LIVE
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-3 sm:gap-4">
                    @php
                        $bins = [
                            ['label' => 'Organik', 'icon' => 'fa-leaf', 'fill' => '68%', 'color' => '#34D399', 'delay' => '0s'],
                            ['label' => 'Anorganik', 'icon' => 'fa-recycle', 'fill' => '45%', 'color' => '#60A5FA', 'delay' => '.15s'],
                            ['label' => 'Logam', 'icon' => 'fa-magnet', 'fill' => '23%', 'color' => '#CBD5E1', 'delay' => '.3s'],
                        ];
                    @endphp
                    @foreach($bins as $bin)
                    <div class="text-center">
                        <div class="relative h-32 sm:h-40 bg-white/5 rounded-2xl overflow-hidden border border-white/10 mb-3">
                            <div class="bin-fill absolute bottom-0 left-0 right-0 rounded-t-xl"
                                 style="--fill: {{ $bin['fill'] }}; --delay: {{ $bin['delay'] }}; background: {{ $bin['color'] }};"></div>
                            <i class="fas {{ $bin['icon'] }} absolute top-3 left-1/2 -translate-x-1/2 text-white/70 text-sm" aria-hidden="true"></i>
                        </div>
                        <p class="text-[10px] font-mono text-emerald-100/60 mb-0.5">{{ $bin['fill'] }}</p>
                        <p class="text-[11px] font-semibold text-white/80">{{ $bin['label'] }}</p>
                    </div>
                    @endforeach
                </div>
                <p class="text-[10px] text-emerald-100/40 mt-6 leading-relaxed">
                    Contoh tampilan. Data sesungguhnya diperbarui otomatis setelah Anda masuk ke sistem.
                </p>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section id="cara-kerja" class="py-24 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="mb-14">
                <p class="text-[11px] font-mono text-emerald-600 mb-2">ALUR SISTEM</p>
                <h2 class="font-display font-bold text-3xl text-sultan tracking-tight">Cara Kerja, dari Sensor ke Layar Anda</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-4 gap-y-10">
                @php
                    $steps = [
                        ['n' => '01', 'title' => 'Objek Masuk', 'desc' => 'Sampah diletakkan di wadah input.'],
                        ['n' => '02', 'title' => 'Identifikasi', 'desc' => 'Sensor mendeteksi jenis material.'],
                        ['n' => '03', 'title' => 'Pemilahan', 'desc' => 'Servo mengarahkan ke wadah yang tepat.'],
                        ['n' => '04', 'title' => 'Kirim Data', 'desc' => 'Data terkirim via MQTT ke server.'],
                        ['n' => '05', 'title' => 'Dashboard', 'desc' => 'Anda memantau hasilnya real-time.'],
                    ];
                @endphp
                @foreach($steps as $step)
                <div>
                    <p class="font-mono text-emerald-500/60 text-xs mb-3">{{ $step['n'] }}</p>
                    <h3 class="font-display font-bold text-sm text-sultan mb-1.5">{{ $step['title'] }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- TEKNOLOGI + MANFAAT (ringkas) -->
    <section id="teknologi" class="py-20 px-4 sm:px-6 bg-white border-y border-slate-100">
        <div class="max-w-6xl mx-auto">
            <p class="text-[11px] font-mono text-emerald-600 mb-5">DIBANGUN DENGAN</p>
            <div class="flex flex-wrap gap-x-8 gap-y-3 mb-16">
                @foreach (['ESP32 Microcontroller', 'Sensor Ultrasonik & Induktif', 'Load Cell HX711', 'MQTT Real-time', 'Laravel + Cloud Hosting'] as $tech)
                <span class="text-xs font-semibold text-slate-400">{{ $tech }}</span>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-hand-holding-medical text-emerald-600 mt-0.5" aria-hidden="true"></i>
                    <p class="text-sm font-semibold text-sultan leading-snug">Lebih higienis,<br><span class="font-normal text-slate-500 text-xs">kurangi pilah manual</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-coins text-emerald-600 mt-0.5" aria-hidden="true"></i>
                    <p class="text-sm font-semibold text-sultan leading-snug">Nilai jual terjaga,<br><span class="font-normal text-slate-500 text-xs">minim kontaminasi</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-bolt text-emerald-600 mt-0.5" aria-hidden="true"></i>
                    <p class="text-sm font-semibold text-sultan leading-snug">Data real-time,<br><span class="font-normal text-slate-500 text-xs">tanpa cek manual</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="py-24 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto bg-sultan rounded-[3rem] px-8 sm:px-16 py-16 text-center">
            <h2 class="font-display font-bold text-2xl sm:text-3xl text-white tracking-tight mb-4">
                Siap pantau sampah hari ini?
            </h2>
            <p class="text-emerald-100/60 text-sm mb-9 max-w-md mx-auto">
                Masuk dengan akun operator TPS atau TPA Anda untuk melihat data secara langsung.
            </p>
            <a href="{{ route('login') }}"
               class="inline-block px-9 py-4 bg-emerald-500 text-sultan rounded-2xl font-bold text-sm hover:bg-emerald-400 transition-all">
                Masuk Sistem
            </a>
        </div>
    </section>
    </main>

    <!-- FOOTER -->
    <footer class="pb-16 px-6 text-center">
        <div class="flex flex-col items-center gap-4">
            <p class="text-[11px] font-semibold text-slate-400">SORTIR.IN</p>
            <p class="text-[10px] text-slate-300">Universitas Brawijaya &middot; Departemen Teknologi Informasi</p>
            <div class="flex gap-6 text-slate-300 text-sm">
                <i class="fab fa-instagram hover:text-emerald-500 cursor-pointer transition" aria-hidden="true"></i>
                <i class="fab fa-github hover:text-emerald-500 cursor-pointer transition" aria-hidden="true"></i>
                <i class="fab fa-linkedin hover:text-emerald-500 cursor-pointer transition" aria-hidden="true"></i>
            </div>
        </div>
    </footer>

</body>
</html>