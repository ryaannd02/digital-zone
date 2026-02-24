<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DigitalZone.com</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-[#AA1B25] text-white relative">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold">
            DigitalZone.com
        </a>

        <!-- Kategori -->
        <div class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="#" class="hover:text-[#F5AD1B] transition">Handphone</a>
            <a href="#" class="hover:text-[#F5AD1B] transition">Laptop</a>
            <a href="#" class="hover:text-[#F5AD1B] transition">Smart Watch</a>
            <a href="#" class="hover:text-[#F5AD1B] transition">Aksesoris</a>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-6 relative">

            @auth
                <a href="{{ route('keranjang.index') }}" class="hover:text-[#F5AD1B]">
                    🛒
                </a>

                <div class="relative">
                    <button onclick="toggleProfile()" class="hover:text-[#F5AD1B]">
                        👤
                    </button>

                    <div id="profileDropdown"
                         class="hidden absolute right-0 mt-3 w-56 bg-white text-black rounded-xl shadow-lg p-4 z-50">

                        <div class="flex items-center gap-3 border-b pb-3">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                👤
                            </div>
                            <div class="text-sm">
                                <p class="font-semibold">
                                    Hai, {{ auth()->user()->name }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-3 text-sm space-y-2">
                            <a href="{{ route('alamat.index') }}"
                            class="block hover:text-[#AA1B25]">
                                Alamat Saya
                            </a>
                            <a href="{{ route('pesanan.index') }}"
                            class="block hover:text-[#AA1B25]">
                                Pesanan Saya
                            </a>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="mt-4">
                            @csrf
                            <button class="w-full bg-[#AA1B25] text-white py-2 rounded-lg">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>

            @else
                <a href="{{ route('login') }}" class="hover:text-[#F5AD1B]">Login</a>
                <a href="{{ route('register') }}"
                   class="bg-[#F5AD1B] text-black px-3 py-1 rounded">
                    Daftar
                </a>
            @endauth

        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-8">
    @yield('content')
</div>

<!-- FOOTER -->
<footer class="bg-[#AA1B25] text-white text-center py-4 mt-12">
    Kebijakan Privasi | © {{ date('Y') }} DigitalZone.com — All Rights Reserved.
</footer>

<script>
    function toggleProfile() {
        document.getElementById("profileDropdown").classList.toggle("hidden");
    }
</script>

</body>
</html>