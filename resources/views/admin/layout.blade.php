<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - DigitalZone</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-200 flex flex-col shadow-xl">

        <!-- Header -->
        <div class="p-6 text-xl font-semibold border-b border-slate-800 flex items-center gap-2 tracking-wide">
            <i data-lucide="shield"></i>
            <span>ADMIN PANEL</span>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-1 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.produk.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="box" class="w-4 h-4"></i>
                Produk
            </a>

            <a href="{{ route('admin.pesanan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                Pesanan
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="users" class="w-4 h-4"></i>
                Users
            </a>

            <a href="{{ route('admin.petugas.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="user-cog" class="w-4 h-4"></i>
                Petugas
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                Laporan
            </a>

        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 rounded-lg hover:bg-red-600 transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>