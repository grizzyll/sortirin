<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Badge status --}}
    <div class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 rounded-full px-3 py-1.5 mb-7">
        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
        <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-[0.1em]">Smart City Revolution</span>
    </div>

    {{-- Brand --}}
    <div class="flex items-center gap-2.5 mb-1.5">
        <div class="w-[38px] h-[38px] bg-[#0F2B26] rounded-[10px] flex items-center justify-center flex-shrink-0">
            <i class="fas fa-recycle text-emerald-400 text-sm"></i>
        </div>
        <span class="text-[20px] font-black text-[#0F2B26] tracking-tight">SORTIR.IN</span>
    </div>
    <p class="text-[11px] font-semibold text-emerald-500 uppercase tracking-[0.2em] mb-8 pl-[48px]">
        Sistem Pemilahan Sampah Otomatis
    </p>

    <div class="h-px bg-[#F0F4F2] mb-6"></div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-1.5">
                Email System
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-300 pointer-events-none">
                    <i class="fas fa-envelope text-xs"></i>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border-[1.5px] border-slate-200 rounded-xl text-[13.5px] font-medium text-slate-900 placeholder-slate-300 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/8 transition-all"
                    placeholder="name@sortir.in">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-1.5">
                Security Key
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-300 pointer-events-none">
                    <i class="fas fa-lock text-xs"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border-[1.5px] border-slate-200 rounded-xl text-[13.5px] font-medium text-slate-900 placeholder-slate-300 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/8 transition-all"
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        {{-- Remember & Recovery --}}
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="w-3.5 h-3.5 rounded accent-emerald-500">
                <span class="text-xs font-medium text-gray-500">{{ __('Remember device') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                    {{ __('Recovery Key?') }}
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full py-[15px] bg-[#0F2B26] hover:bg-emerald-900 text-white rounded-xl text-xs font-black uppercase tracking-[0.12em] flex items-center justify-center gap-2 active:scale-[0.98] transition-all">
                Sign In System
                <i class="fas fa-arrow-right text-xs"></i>
            </button>
        </div>
    </form>

    <p class="text-center text-[11px] text-slate-300 font-medium tracking-wider mt-6">
        © 2026 SORTIR.IN ECOSYSTEM
    </p>
</x-guest-layout>