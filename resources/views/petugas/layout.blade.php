<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white flex flex-col shadow-xl">

        <!-- HEADER -->
        <div class="p-6 border-b border-blue-700">
            <h1 class="text-xl font-bold tracking-wide">Petugas Panel</h1>
            <p class="text-xs text-blue-200 mt-1">Management System</p>
        </div>

        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-2 text-sm">

            <a href="{{ route('petugas.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition hover:bg-blue-700
               {{ request()->routeIs('petugas.dashboard') ? 'bg-blue-700 font-semibold' : '' }}">
                
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                Dashboard
            </a>

            <a href="{{ route('petugas.produk.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition hover:bg-blue-700
               {{ request()->routeIs('petugas.produk.*') ? 'bg-blue-700 font-semibold' : '' }}">
                
                <i data-lucide="box" class="w-4 h-4"></i>
                Produk
            </a>

            <a href="{{ route('petugas.pesanan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition hover:bg-blue-700
               {{ request()->routeIs('petugas.pesanan.*') ? 'bg-blue-700 font-semibold' : '' }}">
                
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                Pesanan
            </a>

            <a href="{{ route('petugas.riwayat.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition hover:bg-blue-700
               {{ request()->routeIs('petugas.riwayat.*') ? 'bg-blue-700 font-semibold' : '' }}">
                
                <i data-lucide="history" class="w-4 h-4"></i>
                Riwayat
            </a>

        </nav>

        <!-- FOOTER / LOGOUT -->
        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full flex items-center gap-2 px-4 py-2.5 bg-red-600 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                    
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>