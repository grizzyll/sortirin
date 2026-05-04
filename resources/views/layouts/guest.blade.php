<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SORTIR.IN - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Inter', system-ui, sans-serif !important; }
    </style>
</head>
<body class="antialiased bg-[#0F2B26]">
    <div class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
        {{-- background circles --}}
        <div class="absolute -top-32 -right-32 w-[400px] h-[400px] rounded-full bg-emerald-400 opacity-[0.08] pointer-events-none"></div>
<div class="absolute -bottom-20 -left-20 w-[280px] h-[280px] rounded-full bg-emerald-300 opacity-[0.06] pointer-events-none"></div>

        <div class="w-full max-w-[420px] bg-white rounded-[24px] border border-[#E8EDEB] px-9 py-10 relative z-10">
            {{ $slot }}
        </div>
    </div>
</body>
</html>