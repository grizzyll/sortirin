<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SORTIR.IN - Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased text-gray-900">
        <!-- Background Sultan Emerald Gradient -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#0F2B26] via-[#133a33] to-[#0F2B26]">
            
            <!-- Branding Logo -->
            <div class="mb-8 flex flex-col items-center">
                <div class="p-4 bg-emerald-500 rounded-[2rem] shadow-2xl shadow-emerald-900/50 mb-4 animate-bounce">
                    <i class="fas fa-recycle text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl font-black text-white tracking-tighter italic">SORTIR.IN</h1>
                <p class="text-emerald-400/60 text-xs font-bold uppercase tracking-[0.3em]">Smart City Revolution</p>
            </div>

            <!-- Box Container -->
            <div class="w-full sm:max-w-md px-10 py-12 bg-white/95 backdrop-blur-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[3rem] border border-white/10">
                {{ $slot }}
            </div>

            <!-- Footer Small -->
            <div class="mt-8 text-emerald-500/40 text-[10px] font-bold uppercase tracking-widest">
                &copy; 2026 Sortir.in Ecosystem
            </div>
        </div>
    </body>
</html>