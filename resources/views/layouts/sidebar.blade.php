<!-- resources/views/layouts/sidebar.blade.php -->
<div class="flex flex-col w-72 h-screen px-6 py-8 overflow-y-auto bg-[#0F2B26] text-white">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-4 mb-12">
        <div class="p-2 bg-emerald-500 rounded-lg shadow-lg shadow-emerald-900/20">
            <i class="fas fa-recycle text-white"></i>
        </div>
        <h2 class="text-xl font-black tracking-tighter italic uppercase">SORTIR.IN</h2>
    </div>

    <!-- Navigation -->
    <div class="flex flex-col justify-between flex-1">
        <nav class="space-y-2">
            <p class="px-4 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Navigasi Utama</p>
            
            <!-- 1. MENU KHUSUS OPERATOR TPS -->
            @if(Auth::user()->role == 'tps')
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-th-large w-5 text-center"></i>
                    <span class="mx-4">Dasboard</span>
                </a>

                <a href="{{ route('history.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('history.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span class="mx-4">Analisis</span>
                </a>

                <a href="{{ route('workers.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('workers.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-user-friends w-5 text-center"></i>
                    <span class="mx-4">Tim Pekerja</span>
                </a>
                
                <a href="{{ route('schedules.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('schedules.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-file-alt w-5 text-center"></i>
                    <span class="mx-4">Laporan</span>
                </a>

                <!-- BAGIAN BARU: MONITORING TITIK DAERAH (Sesuai Permintaan) -->
                <div class="pt-6 mt-6 border-t border-white/5">
                    <p class="px-4 text-[10px] font-black text-emerald-500/50 uppercase tracking-[0.3em] mb-4">Monitoring Wilayah</p>
                    
                    @foreach(\App\Models\Location::all() as $loc)
                    <a href="{{ route('regional.show', $loc->slug) }}" 
                       class="flex items-center px-4 py-3 text-xs transition-all duration-200 {{ request()->is('regional/'.$loc->slug) ? 'bg-emerald-500/10 rounded-2xl border border-emerald-500/20 text-emerald-400 font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl' }}">
                        <i class="fas fa-map-marker-alt w-5 text-center {{ $loc->is_active ? 'text-emerald-500' : 'text-gray-600' }}"></i>
                        <span class="mx-3">{{ $loc->name }}</span>
                        
                        <!-- Indikator API Aktif (Hanya muncul jika is_active true) -->
                        @if($loc->is_active)
                            <span class="relative flex h-2 w-2 ml-auto">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                        @endif
                    </a>
                    @endforeach
                </div>
            @endif

            <!-- 2. MENU KHUSUS OPERATOR TPA (Pusat) -->
            @if(Auth::user()->role == 'tpa')
                <a href="{{ route('tpa.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('tpa.dashboard') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="far fa-building w-5 text-center"></i>
                    <span class="mx-4 font-medium">Monitoring Kota</span>
                </a>
            @endif
        </nav>

        <!-- User Account & Logout -->
        <div class="mt-10 space-y-4">
            <div class="flex items-center px-4 py-4 bg-white/5 rounded-3xl border border-white/5 shadow-inner">
                <img class="object-cover w-10 h-10 rounded-xl border border-emerald-500/20" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff" alt="avatar">
                <div class="mx-3 overflow-hidden text-ellipsis">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] text-emerald-500 font-bold uppercase tracking-widest">
                        {{ Auth::user()->role == 'tps' ? 'Operator TPS' : 'Admin TPA' }}
                    </p>
                </div>
            </div>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 rounded-2xl transition group">
                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:translate-x-1 transition-transform"></i>
                    <span class="mx-4 font-bold uppercase tracking-widest text-[10px]">Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>