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
                <p class="text-sm font-semibold mb-2 uppercase" style="color:#F4A261;">
                    Library Management
                </p>

                <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color:#34495E;">
                    Selamat datang, {{ auth()->user()->name }}
                </h3>

                <p class="text-sm md:text-base" style="color:#5f6f7d;">
                    Kelola seluruh aktivitas perpustakaan dari satu dashboard.
                </p>
            </div>

            <div class="rounded-3xl px-6 py-5 shadow-sm border bg-white min-w-[240px]"
                 style="border-color:#f0e8dc;">
                <p class="text-sm text-center" style="color:#7b8a97;">Status Sistem</p>
                <h4 class="text-lg font-semibold text-center" style="color:#34495E;">
                    Administrator Aktif
                </h4>
                <p class="text-sm text-center" style="color:#F4A261;">
                    Sistem siap digunakan
                </p>
            </div>

        </div>
    </div>
</div>

<!-- 🔥 STATISTIK CENTER -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

    <!-- TOTAL BUKU -->
    <div class="rounded-3xl p-6 border bg-white text-center hover:shadow-md transition"
         style="border-color:#f0e8dc;">
        
        <p class="text-sm mb-2" style="color:#7b8a97;">
            Total Buku
        </p>

        <h3 class="text-4xl font-bold mb-2" style="color:#34495E;">
            {{ $jumlahBuku }}
        </h3>

        <p class="text-sm" style="color:#5f6f7d;">
            Seluruh koleksi buku
        </p>
    </div>

    <!-- TOTAL ANGGOTA -->
    <div class="rounded-3xl p-6 border bg-white text-center hover:shadow-md transition"
         style="border-color:#f0e8dc;">
        
        <p class="text-sm mb-2" style="color:#7b8a97;">
            Total Anggota
        </p>

        <h3 class="text-4xl font-bold mb-2" style="color:#34495E;">
            {{ $jumlahAnggota }}
        </h3>

        <p class="text-sm" style="color:#5f6f7d;">
            Pengguna perpustakaan
        </p>
    </div>

    <!-- DIPINJAM -->
    <div class="rounded-3xl p-6 border bg-white text-center hover:shadow-md transition"
         style="border-color:#f0e8dc;">
        
        <p class="text-sm mb-2" style="color:#7b8a97;">
            Sedang Dipinjam
        </p>

        <h3 class="text-4xl font-bold mb-2" style="color:#F4A261;">
            {{ $jumlahDipinjam }}
        </h3>

        <p class="text-sm" style="color:#5f6f7d;">
            Buku belum dikembalikan
        </p>
    </div>

</div>

<!-- MENU -->
<div class="mb-10">
    <h3 class="text-xl font-bold mb-4" style="color:#34495E;">Menu Utama</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('admin.buku.index') }}"
           class="rounded-3xl p-6 border bg-white hover:-translate-y-1 hover:shadow-md transition"
           style="border-color:#f0e8dc;">
            <h4 class="text-lg font-semibold mb-2" style="color:#34495E;">
                Kelola Data Buku
            </h4>
            <p class="text-sm" style="color:#5f6f7d;">
                Tambah, edit, hapus, dan lihat seluruh data buku.
            </p>
        </a>

        <a href="{{ route('admin.peminjaman.index') }}"
           class="rounded-3xl p-6 border bg-white hover:-translate-y-1 hover:shadow-md transition"
           style="border-color:#f0e8dc;">
            <h4 class="text-lg font-semibold mb-2" style="color:#34495E;">
                Transaksi
            </h4>
            <p class="text-sm" style="color:#5f6f7d;">
                Kelola peminjaman dan pengembalian buku.
            </p>
        </a>

        <a href="{{ route('admin.anggota.index') }}"
           class="rounded-3xl p-6 border bg-white hover:-translate-y-1 hover:shadow-md transition"
           style="border-color:#f0e8dc;">
            <h4 class="text-lg font-semibold mb-2" style="color:#34495E;">
                Kelola Anggota
            </h4>
            <p class="text-sm" style="color:#5f6f7d;">
                Kelola data anggota perpustakaan.
            </p>
        </a>

    </div>
</div>

@endsection