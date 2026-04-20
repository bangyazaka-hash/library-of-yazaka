@extends('layouts.admin')

@section('title', 'Dashboard Admin - Library')
@section('page-title', 'Dashboard Admin')

@section('content')
    <!-- Welcome Banner -->
    <div class="mb-8">
        <div class="rounded-3xl p-6 md:p-8 shadow-sm border"
             style="background: linear-gradient(135deg, #fff7ef, #FDFBF7); border-color: #f5d2b1;">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold mb-2 tracking-wide uppercase" style="color: #F4A261;">
                        Library Management
                    </p>
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: #34495E;">
                        Selamat datang, {{ auth()->user()->name }}
                    </h3>
                    <p class="text-sm md:text-base leading-relaxed" style="color: #5f6f7d;">
                        Kelola seluruh aktivitas perpustakaan dari satu dashboard, mulai dari buku,
                        anggota, peminjaman, hingga pengembalian buku.
                    </p>
                </div>

                <div class="rounded-3xl px-6 py-5 shadow-sm border bg-white min-w-[240px]"
                     style="border-color: #f0e8dc;">
                    <p class="text-sm mb-2 text-center" style="color: #7b8a97;">Status Sistem</p>
                    <h4 class="text-xl font-bold mb-1 text-center" style="color: #34495E;">Administrator Aktif</h4>
                    <p class="text-sm text-center" style="color: #F4A261;">Sistem siap digunakan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
        <div class="rounded-3xl p-6 shadow-sm border bg-white text-center" style="border-color: #f0e8dc;">
            <p class="text-lg mb-4 font-medium" style="color: #7b8a97;">Total Buku</p>
            <h3 class="text-5xl font-bold mb-2" style="color: #34495E;">{{ $jumlahBuku }}</h3>
            <p class="text-sm" style="color: #5f6f7d;">Seluruh koleksi buku</p>
        </div>

        <div class="rounded-3xl p-6 shadow-sm border bg-white text-center" style="border-color: #f0e8dc;">
            <p class="text-lg mb-4 font-medium" style="color: #7b8a97;">Total Anggota</p>
            <h3 class="text-5xl font-bold mb-2" style="color: #34495E;">{{ $jumlahAnggota }}</h3>
            <p class="text-sm" style="color: #5f6f7d;">Pengguna perpustakaan</p>
        </div>

        <div class="rounded-3xl p-6 shadow-sm border bg-white text-center" style="border-color: #f0e8dc;">
            <p class="text-lg mb-4 font-medium" style="color: #7b8a97;">Sedang Dipinjam</p>
            <h3 class="text-5xl font-bold mb-2" style="color: #34495E;">{{ $jumlahDipinjam }}</h3>
            <p class="text-sm" style="color: #5f6f7d;">Buku belum dikembalikan</p>
        </div>

        <div class="rounded-3xl p-6 shadow-sm border bg-white text-center" style="border-color: #f0e8dc;">
            <p class="text-lg mb-4 font-medium" style="color: #7b8a97;">Dikembalikan</p>
            <h3 class="text-5xl font-bold mb-2" style="color: #34495E;">{{ $jumlahDikembalikan }}</h3>
            <p class="text-sm" style="color: #5f6f7d;">Transaksi selesai</p>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-2xl font-bold" style="color: #34495E;">Menu Utama</h3>
                <p class="text-sm mt-1" style="color: #7b8a97;">
                    Pilih menu utama sesuai alur sistem perpustakaan.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Buku -->
            <a href="{{ route('admin.buku.index') }}"
               class="group rounded-3xl p-8 shadow-sm border bg-white hover:-translate-y-1 transition duration-300"
               style="border-color: #f0e8dc;">
                <h4 class="text-2xl font-bold mb-4" style="color: #34495E;">Kelola Data Buku</h4>
                <p class="text-base leading-relaxed" style="color: #5f6f7d;">
                    Tambah, edit, hapus, dan lihat seluruh data buku perpustakaan.
                </p>

                <div class="mt-8 text-base font-semibold" style="color: #F4A261;">
                    Masuk ke menu
                </div>
            </a>

            <!-- Transaksi -->
            <a href="{{ route('admin.peminjaman.index') }}"
               class="group rounded-3xl p-8 shadow-sm border bg-white hover:-translate-y-1 transition duration-300"
               style="border-color: #f0e8dc;">
                <h4 class="text-2xl font-bold mb-4" style="color: #34495E;">Transaksi</h4>
                <p class="text-base leading-relaxed" style="color: #5f6f7d;">
                    Kelola proses peminjaman dan pengembalian buku secara teratur.
                </p>

                <div class="mt-8 text-base font-semibold" style="color: #F4A261;">
                    Masuk ke menu
                </div>
            </a>

            <!-- Anggota -->
            <a href="{{ route('admin.anggota.index') }}"
               class="group rounded-3xl p-8 shadow-sm border bg-white hover:-translate-y-1 transition duration-300"
               style="border-color: #f0e8dc;">
                <h4 class="text-2xl font-bold mb-4" style="color: #34495E;">Kelola Anggota</h4>
                <p class="text-base leading-relaxed" style="color: #5f6f7d;">
                    Kelola data anggota perpustakaan dan informasi pengguna siswa.
                </p>

                <div class="mt-8 text-base font-semibold" style="color: #F4A261;">
                    Masuk ke menu
                </div>
            </a>
        </div>
    </div>

    <!-- Bawah Dashboard -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <!-- Ringkasan -->
        <div class="rounded-3xl p-6 shadow-sm border bg-white" style="border-color: #f0e8dc;">
            <h3 class="text-xl font-bold mb-5" style="color: #34495E;">Ringkasan Admin</h3>

            <div class="space-y-4">
                <div class="rounded-2xl px-4 py-4 border" style="border-color: #f5eee5; background-color: #FDFBF7;">
                    <p class="font-semibold mb-1" style="color: #34495E;">Manajemen Buku</p>
                    <p class="text-sm" style="color: #5f6f7d;">
                        Pastikan data buku selalu diperbarui agar stok dan informasi tetap akurat.
                    </p>
                </div>

                <div class="rounded-2xl px-4 py-4 border" style="border-color: #f5eee5; background-color: #FDFBF7;">
                    <p class="font-semibold mb-1" style="color: #34495E;">Data Anggota</p>
                    <p class="text-sm" style="color: #5f6f7d;">
                        Pastikan akun anggota aktif dan data siswa selalu sinkron.
                    </p>
                </div>

                <div class="rounded-2xl px-4 py-4 border" style="border-color: #f5eee5; background-color: #FDFBF7;">
                    <p class="font-semibold mb-1" style="color: #34495E;">Aktivitas Transaksi</p>
                    <p class="text-sm" style="color: #5f6f7d;">
                        Pantau peminjaman aktif, pengembalian, keterlambatan, dan denda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Flow -->
        <div class="rounded-3xl p-6 shadow-sm border" style="background-color: #E9EDC9; border-color: #d8deaf;">
            <h3 class="text-xl font-bold mb-5" style="color: #34495E;">Alur Sistem Admin</h3>

            <div class="space-y-4">
                <div class="rounded-2xl px-4 py-4 bg-white/70">
                    <p class="font-semibold" style="color: #34495E;">01. Login sebagai Admin</p>
                    <p class="text-sm mt-1" style="color: #5f6f7d;">Masuk menggunakan akun administrator.</p>
                </div>

                <div class="rounded-2xl px-4 py-4 bg-white/70">
                    <p class="font-semibold" style="color: #34495E;">02. Akses Dashboard</p>
                    <p class="text-sm mt-1" style="color: #5f6f7d;">Lihat ringkasan data perpustakaan secara langsung.</p>
                </div>

                <div class="rounded-2xl px-4 py-4 bg-white/70">
                    <p class="font-semibold" style="color: #34495E;">03. Kelola Buku & Anggota</p>
                    <p class="text-sm mt-1" style="color: #5f6f7d;">Perbarui data buku dan data anggota perpustakaan.</p>
                </div>

                <div class="rounded-2xl px-4 py-4 bg-white/70">
                    <p class="font-semibold" style="color: #34495E;">04. Proses Peminjaman & Pengembalian</p>
                    <p class="text-sm mt-1" style="color: #5f6f7d;">Kelola transaksi perpustakaan sesuai alur sistem.</p>
                </div>
            </div>
        </div>
    </div>
@endsection