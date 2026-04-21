<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8" style="background-color: #FDFBF7;">

    <div class="w-full max-w-6xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            <!-- LEFT SIDE -->
            <div class="hidden lg:block">
                <div class="max-w-xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] mb-4" style="color: #F4A261;">
                        Library System
                    </p>

                    <h1 class="text-5xl xl:text-6xl font-bold leading-tight mb-6" style="color: #34495E;">
                        Welcome To
                        <span class="block" style="color: #F4A261;">Yazaka Library</span>
                    </h1>

                    <p class="text-lg leading-relaxed mb-10" style="color: #5f6f7d;">
                        Kelola data buku, anggota, peminjaman, dan pengembalian
                        dalam satu sistem yang sederhana, nyaman, dan terstruktur.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="rounded-3xl p-6 border shadow-sm"
                             style="background-color: #ffffff; border-color: #f0e8dc;">
                            <h3 class="text-lg font-semibold mb-2" style="color: #34495E;">
                                Manajemen Buku
                            </h3>
                            <p class="text-sm leading-relaxed" style="color: #5f6f7d;">
                                Simpan dan kelola koleksi buku perpustakaan dengan rapi.
                            </p>
                        </div>

                        <div class="rounded-3xl p-6 border shadow-sm"
                             style="background-color: #ffffff; border-color: #f0e8dc;">
                            <h3 class="text-lg font-semibold mb-2" style="color: #34495E;">
                                Sistem Transaksi
                            </h3>
                            <p class="text-sm leading-relaxed" style="color: #5f6f7d;">
                                Proses pinjam dan kembali buku dengan lebih teratur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="flex justify-center">
                <div class="w-full max-w-md rounded-[32px] border shadow-xl px-7 py-8 md:px-9 md:py-10"
                     style="background-color: #ffffff; border-color: #f1ece4; box-shadow: 0 20px 60px rgba(52, 73, 94, 0.08);">

                    <!-- HEADER -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold" style="color: #34495E;">Library</h2>
                        <p class="text-sm mt-2" style="color: #7b8a97;">
                            Masuk untuk melanjutkan ke sistem
                        </p>
                    </div>

                    <!-- ALERT -->
                    @if(session('error'))
                        <div class="mb-4 rounded-2xl px-4 py-3 text-sm border"
                             style="background-color: #fff1f2; color: #b91c1c; border-color: #fecdd3;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 rounded-2xl px-4 py-3 text-sm border"
                             style="background-color: #ecfdf3; color: #047857; border-color: #bbf7d0;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 rounded-2xl px-4 py-3 text-sm border"
                             style="background-color: #fff1f2; color: #b91c1c; border-color: #fecdd3;">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FORM -->
                    <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="w-full rounded-2xl px-4 py-3.5 outline-none border transition focus:ring-2"
                                style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
                                placeholder="Masukkan username">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                                Password
                            </label>

                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full rounded-2xl px-4 py-3.5 pr-20 outline-none border transition focus:ring-2"
                                    style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
                                    placeholder="Masukkan password">

                                <button type="button"
                                    onclick="togglePassword(this)"
                                    class="absolute inset-y-0 right-0 px-4 text-sm font-medium"
                                    style="color: #7b8a97;">
                                    Lihat
                                </button>
                            </div>
                        </div>

                        <!-- 🔥 DIUBAH DI SINI -->
                        <div class="flex items-center justify-between text-sm">
                            <a href="{{ route('landing') }}"
                               class="font-semibold hover:underline"
                               style="color: #5f6f7d;">
                                Landing Page
                            </a>

                            <span class="font-semibold" style="color: #F4A261;">
                                Library
                            </span>
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 rounded-2xl font-semibold text-white shadow-md hover:scale-[1.01] transition duration-300"
                            style="background-color: #F4A261;">
                            Masuk
                        </button>

                        <a href="{{ route('register') }}"
                           class="block w-full text-center py-3 rounded-2xl font-semibold border transition hover:scale-[1.01]"
                           style="border-color:#F4A261; color:#F4A261;">
                            Daftar akun baru
                        </a>

                        <div class="text-center text-sm mt-2" style="color: #7b8a97;">
                            Sudah punya akun admin? gunakan login biasa
                        </div>

                    </form>

                    <div class="mt-8 text-center text-sm" style="color: #9aa6b2;">
                        © {{ date('Y') }} Library System
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(button) {
            const password = document.getElementById('password');

            if (password.type === 'password') {
                password.type = 'text';
                button.innerText = 'Sembunyi';
            } else {
                password.type = 'password';
                button.innerText = 'Lihat';
            }
        }
    </script>

</body>
</html>