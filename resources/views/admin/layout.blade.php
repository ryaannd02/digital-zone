<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - DigitalZone</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Dashboard
            </a>

            <a href="{{ route('admin.produk.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Produk
            </a>

            <a href="{{ route('admin.pesanan.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Pesanan
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Users
            </a>

            <a href="{{ route('admin.petugas.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Petugas
            </a>

        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 bg-red-600 rounded hover:bg-red-700">
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

</body>
</html>