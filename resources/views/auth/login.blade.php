<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-800">Welcome Back</h2>
        <p class="text-sm text-gray-400 font-medium">Please enter your credentials to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 mb-1">Email System</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 transition-all shadow-inner" 
                    placeholder="name@sortir.in">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 mb-1">Security Key</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 transition-all shadow-inner" 
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-200 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">{{ __('Remember device') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline underline-offset-4" href="{{ route('password.request') }}">
                    {{ __('Recovery Key?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full py-4 bg-[#0F2B26] hover:bg-emerald-600 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-emerald-900/20 transition-all active:scale-95 flex items-center justify-center gap-2">
                <span>Sign In System</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </button>
        </div>
    </form>
</x-guest-layout>