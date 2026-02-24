<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - DigitalZone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">

<div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold text-center text-[#AA1B25]">
        DigitalZone
    </h1>

    <h2 class="text-center text-[#F5AD1B] font-semibold mt-1 mb-6">
        Daftar
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label class="text-gray-600 text-sm">Nama Lengkap</label>
            <input type="text"
                   name="name"
                   required
                   class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#AA1B25]">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="text-gray-600 text-sm">Email</label>
            <input type="email"
                   name="email"
                   required
                   class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#AA1B25]">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="text-gray-600 text-sm">Password</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#AA1B25]">
        </div>

        <!-- Confirm -->
        <div class="mb-6">
            <label class="text-gray-600 text-sm">Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   required
                   class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#AA1B25]">
        </div>

        <button type="submit"
                class="w-full bg-[#AA1B25] text-white py-2 rounded-lg font-semibold hover:opacity-90 transition">
            Daftar
        </button>

    </form>

    <p class="text-center text-sm mt-4 text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}"
           class="text-[#F5AD1B] font-semibold hover:underline">
            Masuk
        </a>
    </p>

</div>

</body>
</html>