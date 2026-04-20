<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORTIR.IN - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <!-- Panggil file sidebar yang kita buat di langkah 4 tadi -->
    @include('layouts.sidebar')

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <div class="text-sm text-gray-500 italic">Analisis Perancangan Sistem - Vokasi UB</div>
            <div class="flex items-center gap-3">
                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full font-bold">IoT: Connected</span>
                <span class="font-semibold text-gray-700">{{ Auth::user()->name ?? 'Admin TPS' }}</span>
            </div>
        </header>

        <!-- Tempat Isi Dashboard Muncul -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>