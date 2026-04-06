<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - DigitalZone</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md">

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-[#AA1B25] to-[#7A121A] py-10 px-6 text-center text-white">

            <!-- ICON -->
            <div class="flex justify-center mb-3">
                <i data-lucide="user-plus" class="w-10 h-10"></i>
            </div>

            <!-- BRAND -->
            <h1 class="text-2xl font-bold tracking-wide">
                DigitalZone
            </h1>

            <!-- TITLE -->
            <p class="text-sm opacity-90 mt-1">
                Daftar Akun Customer
            </p>

            <div class="w-16 h-1 bg-white/40 mx-auto mt-4 rounded-full"></div>

        </div>

        <!-- FORM -->
        <div class="p-8">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" name="name" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-[#AA1B25] focus:outline-none">
                        <i data-lucide="user" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Email</label>
                    <div class="relative">
                        <input type="email" name="email" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-[#AA1B25] focus:outline-none">
                        <i data-lucide="mail" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-[#AA1B25] focus:outline-none">
                        <i data-lucide="lock" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Confirm -->
                <div class="mb-6">
                    <label class="text-sm text-gray-600">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" required
                            class="w-full mt-1 px-4 py-2 pl-10 rounded-lg border focus:ring-2 focus:ring-[#AA1B25] focus:outline-none">
                        <i data-lucide="shield-check" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-[#AA1B25] text-white py-2.5 rounded-lg font-semibold hover:opacity-90 transition">
                    Daftar
                </button>

            </form>

            <!-- LOGIN LINK -->
            <p class="text-center text-sm mt-5 text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-[#AA1B25] font-semibold hover:underline">
                    Masuk
                </a>
            </p>

        </div>

    </div>

    <!-- FOOTER -->
    <p class="text-center text-xs text-gray-500 mt-4">
        © {{ date('Y') }} DigitalZone
    </p>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>