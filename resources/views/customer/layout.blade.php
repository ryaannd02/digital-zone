@php
    $notifCount = \App\Models\Notification::where('user_id', auth()->id())
        ->where('is_read', false)
        ->count();

    $notifications = \App\Models\Notification::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    $cartCount = \App\Models\Keranjang::where('user_id', auth()->id())->count();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DigitalZone</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100 text-slate-700 min-h-screen flex flex-col">

<!-- ================= NAVBAR ================= -->
<nav class="bg-gradient-to-r from-red-600 to-red-700 text-white shadow-md sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center gap-6">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="text-xl font-bold flex items-center gap-2">
            DigitalZone
        </a>

        <!-- SEARCH -->
        <div class="flex-1 max-w-2xl">
            <form action="{{ route('search') }}" method="GET" class="relative">

                <input id="searchInput"
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari produk, brand..."
                    class="w-full pl-11 pr-4 py-2.5 rounded-xl text-black bg-white/95 backdrop-blur focus:outline-none focus:ring-2 focus:ring-white">

                <!-- ICON -->
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.3-4.3M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                </div>

                <!-- SUGGEST -->
                <div id="suggestBox"
                    class="absolute w-full bg-white mt-2 rounded-xl shadow-lg border border-slate-200 hidden z-50 overflow-hidden">
                </div>

            </form>
        </div>

        <!-- KATEGORI -->
        @php $kategori = request()->segment(2); @endphp
        <div class="hidden lg:flex items-center gap-2 text-sm">

            @foreach(['handphone','laptop','smartwatch','aksesoris'] as $kat)
            <a href="{{ route('produk.kategori', $kat) }}"
               class="px-3 py-1.5 rounded-lg capitalize transition
               {{ $kategori == $kat 
    ? 'bg-red-800 text-white font-semibold shadow-inner' 
    : 'hover:bg-red-500/70 text-white' }}">
                {{ $kat }}
            </a>
            @endforeach

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-5 ml-auto">

            @auth

            <!-- NOTIF -->
            <a href="{{ route('notifications.index') }}"
            class="relative flex items-center justify-center"
            @click="localStorage.setItem('notif_cleared', 'true')">

                <svg class="w-6 h-6 text-white hover:text-yellow-300 transition"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                            a6.002 6.002 0 00-4-5.659V5
                            a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159
                            c0 .538-.214 1.055-.595 1.436L4 17h5
                            m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>

                @if($notifCount > 0)
                <span id="notifBadge"
                    class="absolute -top-1 -right-1 bg-yellow-400 text-black text-[10px] px-1.5 py-0.5 rounded-full font-semibold">
                    {{ $notifCount }}
                </span>
                @endif

            </a>

            <!-- CART -->
            <a href="{{ route('keranjang.index') }}" class="relative flex items-center justify-center">

                <svg class="w-6 h-6 text-white hover:text-yellow-300 transition"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 100-2
                             1 1 0 000 2zm7 0a1 1 0 100-2
                             1 1 0 000 2z"/>
                </svg>

                @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 bg-yellow-400 text-black text-[10px] px-1.5 py-0.5 rounded-full font-semibold">
                    {{ $cartCount }}
                </span>
                @endif

            </a>

            <!-- PROFILE -->
            <div x-data="{ open:false }" class="relative">

                <button @click="open = !open"
                    class="w-9 h-9 rounded-full bg-white text-red-600 font-semibold flex items-center justify-center shadow">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </button>

                <!-- DROPDOWN -->
                <div x-show="open"
                    @click.outside="open=false"
                    x-transition
                    class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl overflow-hidden z-50 border border-slate-200">

                    <!-- HEADER -->
                    <div class="p-4 flex items-center gap-3 border-b bg-slate-50">

                        <!-- AVATAR (FIX KONTRAS) -->
                        <div class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="leading-tight">
                            <p class="font-semibold text-sm text-slate-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-slate-500">
                                Customer
                            </p>
                        </div>

                    </div>

                    <!-- MENU -->
                    <div class="p-2 text-sm text-slate-700">

                        <a href="{{ route('alamat.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition font-medium">
                            Alamat Saya
                        </a>

                        <a href="{{ route('pesanan.index') }}"
                        class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition font-medium">
                            Pesanan Saya
                        </a>

                    </div>

                    <!-- FOOTER -->
                    <div class="p-3 border-t bg-white">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            @else

            <a href="{{ route('login') }}" class="hover:text-yellow-300 text-sm">Login</a>

            <a href="{{ route('register') }}"
            class="bg-[#AA1B25] text-white px-4 py-2 rounded-lg text-sm font-semibold 
                    hover:bg-[#8E161F] transition shadow-sm hover:shadow-md">
                Daftar
            </a>

            @endauth

        </div>

    </div>

</nav>


<!-- CONTENT -->
<main class="flex-1">
    <div class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </div>
</main>


<!-- FOOTER -->
<footer class="bg-gradient-to-r from-red-600 to-red-700 text-white mt-16">

    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-4 gap-10 text-sm">

        <!-- BRAND -->
        <div>
            <h4 class="font-semibold text-lg mb-3 flex items-center gap-2">

                <!-- ICON STORE -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M3 9l9-6 9 6v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>

                DigitalZone
            </h4>

            <p class="text-red-100 leading-relaxed">
                Platform belanja modern dengan berbagai produk teknologi berkualitas dan terpercaya.
            </p>
        </div>


        <!-- MENU -->
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2">

                <!-- ICON MENU -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                Menu
            </h4>

            <ul class="space-y-3 text-red-100">

                <li>
                    <a href="#" class="flex items-center gap-2 hover:text-yellow-300 transition">
                        <span>Beranda</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex items-center gap-2 hover:text-yellow-300 transition">
                        <span>Produk</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex items-center gap-2 hover:text-yellow-300 transition">
                        <span>Kategori</span>
                    </a>
                </li>

            </ul>
        </div>


        <!-- BANTUAN -->
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2">

                <!-- ICON HELP -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M8 10h.01M12 14h.01M16 10h.01M9 16h6M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>

                Bantuan
            </h4>

            <ul class="space-y-3 text-red-100">

                <li>
                    <a href="#" class="hover:text-yellow-300 transition">FAQ</a>
                </li>

                <li>
                    <a href="#" class="hover:text-yellow-300 transition">Kontak</a>
                </li>

                <li>
                    <a href="#" class="hover:text-yellow-300 transition">Pengiriman</a>
                </li>

            </ul>
        </div>


        <!-- KONTAK -->
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2">

                <!-- ICON CONTACT -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M3 5a2 2 0 012-2h3l2 5-2 2a11 11 0 005 5l2-2 5 2v3a2 2 0 01-2 2A16 16 0 013 5z"/>
                </svg>

                Kontak
            </h4>

            <div class="space-y-3 text-red-100">

                <p class="flex items-center gap-2">
                    <!-- EMAIL -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M16 12H8m0 0l-4-4m4 4l-4 4m8-4h8"/>
                    </svg>
                    digitalzone@gmail.com
                </p>

                <p class="flex items-center gap-2">
                    <!-- PHONE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M3 5a2 2 0 012-2h2l2 5-2 2a11 11 0 005 5l2-2 5 2v2a2 2 0 01-2 2A16 16 0 013 5z"/>
                    </svg>
                    021-4870-3578
                </p>

            </div>
        </div>

    </div>

    <!-- BOTTOM -->
    <div class="border-t border-red-500 py-4 text-center text-sm text-red-100">
        © {{ date('Y') }} DigitalZone. All rights reserved.
    </div>

</footer>


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){

    // ================= SEARCH =================
    const input = document.getElementById('searchInput');
    const box = document.getElementById('suggestBox');

    let debounceTimer;

    if(input){
        input.addEventListener('keyup', function() {

            let q = this.value;
            clearTimeout(debounceTimer);

            // 🔥 loading state
            if(q.length >= 2){
                box.innerHTML = `<div class="px-4 py-3 text-sm text-slate-500">Mencari...</div>`;
                box.classList.remove('hidden');
            }

            debounceTimer = setTimeout(() => {

                if(q.length < 2){
                    box.classList.add('hidden');
                    return;
                }

                fetch(`/search/suggest?q=${q}`)
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    // 🔥 EMPTY STATE
                    if(data.length === 0){
                        html = `
                            <div class="px-4 py-3 text-sm text-slate-500">
                                Tidak ditemukan
                            </div>
                        `;
                    }

                    // 🔥 LIST ITEM
                    data.forEach((item, index) => {
                        html += `
                            <a href="/produk/${item.id}" 
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100 transition border-b last:border-none">
                                
                                ${item.nama_produk}

                            </a>
                        `;
                    });

                    box.innerHTML = html;
                    box.classList.remove('hidden');

                });

            }, 300);

        });
    }

    document.addEventListener('click', function(e){
        if(input && box && !input.contains(e.target) && !box.contains(e.target)){
            box.classList.add('hidden');
        }
    });


    // ================= NOTIF BADGE UX =================
    const notifBadge = document.getElementById('notifBadge');
    const notifBtn = document.getElementById('notifButton');

    if(localStorage.getItem('notif_cleared') === 'true'){
        if(notifBadge){
            notifBadge.style.display = 'none';
        }
        localStorage.removeItem('notif_cleared');
    }

    if(notifBtn){
        notifBtn.addEventListener('click', function(){
            localStorage.setItem('notif_cleared', 'true');
        });
    }

});
</script>
@endpush

@stack('scripts')
</body>
</html>