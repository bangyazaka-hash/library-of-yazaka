<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen" style="background-color: #FDFBF7;">

<!-- TOPBAR -->
<header class="sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b"
        style="border-color: #f0e8dc;">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold tracking-tight" style="color: #34495E;">
                Library
            </h1>
            <p class="text-sm" style="color: #7b8a97;">
                Dashboard Siswa
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="px-5 py-2 rounded-xl text-white font-semibold shadow-sm hover:scale-105 transition"
                style="background-color: #F4A261;">
                Logout
            </button>
        </form>
    </div>
</header>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-10">

    <!-- WELCOME -->
    <div class="mb-10">
        <h2 class="text-4xl font-bold tracking-tight" style="color: #34495E;">
            Halo, {{ auth()->user()->name }}
        </h2>
        <p class="mt-2 text-base" style="color: #7b8a97;">
            Pilih menu sesuai kebutuhan sistem perpustakaan.
        </p>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">

        <div class="rounded-3xl p-6 bg-white border shadow-sm hover:shadow-md transition text-center"
             style="border-color: #f0e8dc;">
            <p class="mb-2 text-sm" style="color: #7b8a97;">Total Buku</p>
            <h3 class="text-5xl font-bold" style="color: #34495E;">
                {{ $jumlahBuku }}
            </h3>
        </div>

        <div class="rounded-3xl p-6 bg-white border shadow-sm hover:shadow-md transition text-center"
             style="border-color: #f0e8dc;">
            <p class="mb-2 text-sm" style="color: #7b8a97;">Sedang Dipinjam</p>
            <h3 class="text-5xl font-bold" style="color: #34495E;">
                {{ $jumlahDipinjam }}
            </h3>
        </div>

        <div class="rounded-3xl p-6 bg-white border shadow-sm hover:shadow-md transition text-center"
             style="border-color: #f0e8dc;">
            <p class="mb-2 text-sm" style="color: #7b8a97;">Sudah Dikembalikan</p>
            <h3 class="text-5xl font-bold" style="color: #34495E;">
                {{ $jumlahDikembalikan }}
            </h3>
        </div>

    </div>

    <!-- MENU -->
    <div>
        <h3 class="text-2xl font-bold mb-6 tracking-tight" style="color: #34495E;">
            Menu Utama
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- CARD -->
            <a href="{{ route('siswa.buku.index') }}"
               class="group block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
               style="border-color: #f0e8dc;">
               
                <h4 class="text-xl font-bold mb-2 group-hover:opacity-90"
                    style="color: #34495E;">
                    Pinjam Buku Online
                </h4>

                <p class="text-sm mb-6" style="color: #5f6f7d;">
                    Lihat daftar buku dan lakukan peminjaman langsung.
                </p>

                <span class="font-semibold flex items-center gap-2 group-hover:gap-3 transition-all"
                      style="color: #F4A261;">
                    Masuk ke menu →
                </span>
            </a>

            <!-- CARD -->
            <a href="{{ route('siswa.peminjaman.index') }}"
               class="group block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
               style="border-color: #f0e8dc;">
               
                <h4 class="text-xl font-bold mb-2"
                    style="color: #34495E;">
                    Riwayat Peminjaman
                </h4>

                <p class="text-sm mb-6" style="color: #5f6f7d;">
                    Lihat buku yang sedang kamu pinjam.
                </p>

                <span class="font-semibold flex items-center gap-2 group-hover:gap-3 transition-all"
                      style="color: #F4A261;">
                    Masuk ke menu →
                </span>
            </a>

            <!-- CARD -->
            <a href="{{ route('siswa.pengembalian.index') }}"
               class="group block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
               style="border-color: #f0e8dc;">
               
                <h4 class="text-xl font-bold mb-2"
                    style="color: #34495E;">
                    Riwayat Pengembalian
                </h4>

                <p class="text-sm mb-6" style="color: #5f6f7d;">
                    Lihat buku yang sudah dikembalikan.
                </p>

                <span class="font-semibold flex items-center gap-2 group-hover:gap-3 transition-all"
                      style="color: #F4A261;">
                    Masuk ke menu →
                </span>
            </a>

        </div>
    </div>

</main>

</body>
</html>