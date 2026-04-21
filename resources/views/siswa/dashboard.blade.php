@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard Siswa')

@section('content')

<!-- WELCOME -->
<div class="mb-10">
    <h2 class="text-3xl md:text-4xl font-bold" style="color:#34495E;">
        Halo, {{ auth()->user()->name }}
    </h2>
    <p class="mt-2 text-sm md:text-base" style="color:#7b8a97;">
        Pilih menu sesuai kebutuhan sistem perpustakaan.
    </p>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">

    <div class="rounded-3xl p-6 bg-white border shadow-sm text-center"
         style="border-color:#f0e8dc;">
        <p class="text-sm mb-2" style="color:#7b8a97;">Total Buku</p>
        <h3 class="text-5xl font-bold" style="color:#34495E;">
            {{ $jumlahBuku }}
        </h3>
    </div>

    <div class="rounded-3xl p-6 bg-white border shadow-sm text-center"
         style="border-color:#f0e8dc;">
        <p class="text-sm mb-2" style="color:#7b8a97;">Sedang Dipinjam</p>
        <h3 class="text-5xl font-bold" style="color:#F4A261;">
            {{ $jumlahDipinjam }}
        </h3>
    </div>

    <div class="rounded-3xl p-6 bg-white border shadow-sm text-center"
         style="border-color:#f0e8dc;">
        <p class="text-sm mb-2" style="color:#7b8a97;">Sudah Dikembalikan</p>
        <h3 class="text-5xl font-bold" style="color:#34495E;">
            {{ $jumlahDikembalikan }}
        </h3>
    </div>

</div>

<!-- MENU -->
<div>
    <h3 class="text-2xl font-bold mb-6" style="color:#34495E;">
        Menu Utama
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('siswa.buku.index') }}"
           class="block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
           style="border-color:#f0e8dc;">
           
            <h4 class="text-xl font-bold mb-2" style="color:#34495E;">
                Pinjam Buku
            </h4>

            <p class="text-sm mb-6" style="color:#7b8a97;">
                Lihat daftar buku dan lakukan peminjaman.
            </p>

            <span class="font-semibold" style="color:#F4A261;">
                Masuk →
            </span>
        </a>

        <a href="{{ route('siswa.peminjaman.index') }}"
           class="block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
           style="border-color:#f0e8dc;">
           
            <h4 class="text-xl font-bold mb-2" style="color:#34495E;">
                Riwayat Peminjaman
            </h4>

            <p class="text-sm mb-6" style="color:#7b8a97;">
                Lihat buku yang sedang dipinjam.
            </p>

            <span class="font-semibold" style="color:#F4A261;">
                Masuk →
            </span>
        </a>

        <a href="{{ route('siswa.pengembalian.index') }}"
           class="block rounded-3xl p-6 border bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition"
           style="border-color:#f0e8dc;">
           
            <h4 class="text-xl font-bold mb-2" style="color:#34495E;">
                Riwayat Pengembalian
            </h4>

            <p class="text-sm mb-6" style="color:#7b8a97;">
                Lihat buku yang sudah dikembalikan.
            </p>

            <span class="font-semibold" style="color:#F4A261;">
                Masuk →
            </span>
        </a>

    </div>
</div>

@endsection