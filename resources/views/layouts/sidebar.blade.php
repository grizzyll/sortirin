<!-- resources/views/layouts/sidebar.blade.php -->
<div class="flex flex-col w-72 h-screen px-6 py-8 overflow-y-auto bg-[#0F2B26] text-white">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-4 mb-12">
        <div class="p-2 bg-emerald-500 rounded-lg">
            <i class="fas fa-recycle text-white"></i>
        </div>
        <h2 class="text-xl font-bold tracking-tight">SORTIR.IN</h2>
    </div>

    <!-- Navigation -->
    <div class="flex flex-col justify-between flex-1">
        <nav class="space-y-2">
            <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Main Navigation</p>
            
            <!-- 1. MENU KHUSUS OPERATOR TPS -->
            @if(Auth::user()->role == 'tps')
                <!-- Menu Dashboard TPS disembunyikan dari TPA -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-th-large w-5 text-center"></i>
                    <span class="mx-4 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('history.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('history.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span class="mx-4 font-medium">Analytics</span>
                </a>

                <a href="{{ route('workers.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('workers.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-user-friends w-5 text-center"></i>
                    <span class="mx-4 font-medium">Team Structure</span>
                </a>
                
                <a href="{{ route('schedules.index') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('schedules.*') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="fas fa-file-alt w-5 text-center"></i>
                    <span class="mx-4 font-medium">Reports</span>
                </a>
            @endif

            <!-- 2. MENU KHUSUS OPERATOR TPA (Pusat) -->
            @if(Auth::user()->role == 'tpa')
                <!-- Admin TPA HANYA akan melihat menu ini -->
                <a href="{{ route('tpa.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('tpa.dashboard') ? 'bg-white/10 rounded-2xl border border-white/10 text-white font-bold' : 'text-gray-400 hover:bg-white/5 rounded-2xl' }}">
                    <i class="far fa-building w-5 text-center"></i>
                    <span class="mx-4 font-medium">Monitoring Kota</span>
                </a>
            @endif
        </nav>

        <!-- User Account & Logout -->
        <div class="mt-10 space-y-4">
            <div class="flex items-center px-4 py-4 bg-white/5 rounded-3xl border border-white/5">
                <img class="object-cover w-10 h-10 rounded-xl" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff" alt="avatar">
                <div class="mx-3 overflow-hidden">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-emerald-500 font-bold uppercase">
                        {{ Auth::user()->role == 'tps' ? 'Operator TPS' : 'Admin TPA' }}
                    </p>
                </div>
            </div>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 rounded-2xl transition group">
                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:translate-x-1 transition-transform"></i>
                    <span class="mx-4 font-bold">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</div>