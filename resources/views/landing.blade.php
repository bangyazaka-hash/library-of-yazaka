<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Landing</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white overflow-x-hidden">

<!-- HERO -->
<section class="relative min-h-screen w-full overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <img src="{{ asset('/library.jpg') }}"
         class="absolute w-full h-full object-cover">

    <!-- DARK OVERLAY -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- NAVBAR -->
    <nav class="relative z-10 px-5 md:px-10 py-5">

        <div class="max-w-6xl mx-auto flex items-center justify-between relative">

            <!-- LOGO -->
            <h1 class="text-2xl font-bold text-orange-400">
                Yazaka.
            </h1>

            <!-- MENU CENTER -->
            <div class="absolute left-1/2 -translate-x-1/2 top-1 hidden md:flex gap-8 text-sm text-gray-200">

                <a href="#" class="hover:text-orange-400 transition">
                    Beranda
                </a>

                <a href="/siswa/dashboard" class="hover:text-orange-400 transition">
                    Jelajahi
                </a>

            </div>

            <!-- MOBILE MENU -->
            <div class="absolute left-1/2 -translate-x-1/2 top-12 flex md:hidden gap-5 text-sm text-gray-200">

                <a href="#" class="hover:text-orange-400 transition">
                    Beranda
                </a>

                <a href="/siswa/dashboard" class="hover:text-orange-400 transition">
                    Jelajahi
                </a>

            </div>

            <!-- BUTTON -->
            <a href="{{ route('login') }}"
               class="bg-orange-400 text-white px-4 md:px-5 py-2 rounded-xl hover:bg-orange-500 transition text-sm md:text-base">
                Masuk →
            </a>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="relative z-10 max-w-6xl mx-auto px-5 md:px-10 pt-24 md:pt-24">

        <h2 class="text-3xl sm:text-4xl md:text-6xl font-bold leading-tight">
            Tempat Ilmu <br>

            <span class="text-orange-400">
                Bertumbuh, Masa Depan Terbentuk.
            </span>
        </h2>

        <p class="mt-6 text-gray-300 max-w-xl text-sm sm:text-base leading-relaxed">
            Baca buku nggak harus ribet. Di sini, semua ada dalam genggaman.
            Nikmati dan pinjamlah koleksi buku favoritmu secara simpel,
            dan efisien.
        </p>

    </div>

    <!-- FEATURES -->
    <div class="relative z-10 w-full px-5 md:px-10 mt-16 md:absolute md:bottom-10 md:left-1/2 md:-translate-x-1/2">

        <div class="max-w-6xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 bg-white/10 backdrop-blur-md p-5 md:p-6 rounded-3xl">

                <div>
                    <h3 class="text-orange-400 font-bold text-lg">
                        Koleksi Menarik
                    </h3>

                    <p class="text-gray-300 text-sm mt-2 leading-relaxed">
                        Banyak buku yang sangat menarik untuk dibaca atau dipelajari.
                    </p>
                </div>

                <div>
                    <h3 class="text-orange-400 font-bold text-lg">
                        Peminjaman Mudah
                    </h3>

                    <p class="text-gray-300 text-sm mt-2 leading-relaxed">
                        Pinjam buku kapan saja secara online dan ambil secara offline.
                    </p>
                </div>

                <div>
                    <h3 class="text-orange-400 font-bold text-lg">
                        Kelola Terstruktur
                    </h3>

                    <p class="text-gray-300 text-sm mt-2 leading-relaxed">
                        Data buku, anggota, dan peminjaman dikelola dengan rapi.
                    </p>
                </div>

            </div>

            <!-- QUOTE -->
            <p class="text-center text-gray-300 mt-6 italic text-sm md:text-base">
                "Membaca adalah jendela dunia. Perpustakaan adalah kuncinya."
            </p>

        </div>

    </div>

</section>

</body>
</html>