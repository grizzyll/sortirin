<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORTIR.IN - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#F4F7F6] flex font-sans antialiased text-slate-900">
    @include('layouts.sidebar')
    
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="flex items-center justify-between px-10 py-6">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <button class="bg-[#121212] text-white px-5 py-2 rounded-xl text-xs font-bold shadow-lg">
                Add Custom Widget
            </button>
        </header>

        <main class="px-10 pb-10">
            @yield('content')
        </main>
    </div>
</body>
</html>