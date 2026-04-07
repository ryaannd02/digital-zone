<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - DigitalZone</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center min-h-screen">

@php
    $role = $role ?? 'customer';

    if ($role === 'admin') {
        $title = 'Login Admin';
        $color = 'bg-slate-900'; // background utama
        $accent = 'text-slate-800'; // teks / highlight
        $buttonColor = 'bg-slate-900 hover:bg-slate-800'; // tombol
        $icon = 'shield';
    } elseif ($role === 'petugas') {
        $title = 'Login Petugas';
        $color = 'bg-gradient-to-r from-blue-600 to-blue-800';
        $accent = 'text-blue-600';
        $buttonColor = 'bg-blue-600 hover:bg-blue-700';
        $icon = 'briefcase';
    } else {
        $title = 'Login Customer';
        $color = 'bg-gradient-to-r from-[#AA1B25] to-[#7A121A]';
        $accent = 'text-[#AA1B25]';
        $buttonColor = 'bg-[#AA1B25] hover:opacity-90';
        $icon = 'shopping-cart';
    }
@endphp

<div class="w-full max-w-md">

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="{{ $color }} py-10 px-6 text-center text-white">

            <!-- ICON -->
            <div class="flex justify-center mb-3">
                <i data-lucide="{{ $icon }}" class="w-10 h-10"></i>
            </div>

            <!-- BRAND -->
            <h1 class="text-2xl font-bold tracking-wide">
                DigitalZone
            </h1>

            <!-- ROLE -->
            <p class="text-sm opacity-90 mt-1">
                {{ $title }}
            </p>

            <div class="w-16 h-1 bg-white/40 mx-auto mt-4 rounded-full"></div>

        </div>

        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM -->
        <div class="p-8">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="role" value="{{ $role }}">

                <!-- Email -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Email</label>
                    <div class="relative">
                        <input type="email" name="email" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-gray-300 focus:outline-none">
                        <i data-lucide="mail"class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="text-sm text-gray-600">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-gray-300 focus:outline-none">
                        <i data-lucide="lock"class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full text-white py-2.5 rounded-lg font-semibold transition {{ $buttonColor }}">
                    Masuk
                </button>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </form>

            <!-- Register -->
            @if($role === 'customer')
            <p class="text-center text-sm mt-5 text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="{{ $accent }} font-semibold hover:underline">
                    Daftar
                </a>
            </p>
            @endif

        </div>

    </div>

    <p class="text-center text-xs text-gray-500 mt-4">
        © {{ date('Y') }} DigitalZone
    </p>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>