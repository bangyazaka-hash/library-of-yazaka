@extends('layouts.admin')

@section('title', 'Data Peminjaman - Library')
@section('page-title', 'Data Peminjaman')

@section('content')

<!-- Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Data Peminjaman</h3>
        <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
            Kelola transaksi peminjaman dan pengembalian buku perpustakaan.
        </p>
    </div>

    <a href="{{ route('admin.peminjaman.create') }}"
       class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-white font-semibold shadow-sm"
       style="background-color: #F4A261;">
        Tambah Peminjaman
    </a>
</div>

<!-- SEARCH -->
<div class="rounded-3xl p-5 shadow-sm border bg-white mb-6" style="border-color: #f0e8dc;">
    <form action="{{ route('admin.peminjaman.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">

        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Cari kode, anggota, atau buku..."
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
        >

        <button type="submit"
            class="px-5 py-3 rounded-2xl font-semibold text-white"
            style="background-color: #34495E;">
            Cari
        </button>
    </form>
</div>

<!-- Alert -->
@if(session('success'))
    <div class="mb-6 rounded-2xl px-5 py-4 text-sm font-medium"
         style="background-color: #ecfdf3; color: #047857;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-2xl px-5 py-4 text-sm font-medium"
         style="background-color: #fde8e8; color: #b91c1c;">
        {{ session('error') }}
    </div>
@endif

<!-- Table -->
<div class="hidden md:block rounded-3xl shadow-sm border overflow-hidden bg-white" style="border-color: #f0e8dc;">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead style="background-color: #fff7ef;">
                <tr>
                    <th class="px-6 py-4 text-left">Kode</th>
                    <th class="px-6 py-4 text-left">Nama Anggota</th>
                    <th class="px-6 py-4 text-left">Buku</th>
                    <th class="px-6 py-4 text-left">Tgl Pinjam</th>
                    <th class="px-6 py-4 text-left">Jatuh Tempo</th>
                    <th class="px-6 py-4 text-left">Tgl Kembali</th>
                    <th class="px-6 py-4 text-left">Denda</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @forelse($peminjaman as $item)

                    @php
                        $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->startOfDay();

                        // 🔥 gunakan tanggal kembali jika ada, kalau belum pakai sekarang
                        $tanggalAcuan = $item->tanggal_kembali 
                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->startOfDay()
                            : now()->startOfDay();

                        $hariTerlambat = 0;
                        $dendaRealtime = 0;

                        if ($tanggalAcuan->gt($jatuhTempo)) {
                            $hariTerlambat = $jatuhTempo->diffInDays($tanggalAcuan); // 🔥 pasti integer
                            $dendaRealtime = $hariTerlambat * 1000;
                        }
                    @endphp

                    <tr class="border-t" style="border-color: #f5eee5;">
                        <td class="px-6 py-4 font-medium">{{ $item->kode_peminjaman }}</td>
                        <td class="px-6 py-4">{{ $item->anggota->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $item->buku->judul ?? '-' }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                        </td>

                        <!-- DENDA -->
                        <td class="px-6 py-4">
                            <span class="font-semibold">
                                Rp {{ number_format($dendaRealtime, 0, ',', '.') }}
                            </span>

                            @if($hariTerlambat > 0)
                                <div class="text-xs text-red-500">
                                    Terlambat {{ $hariTerlambat }} hari
                                </div>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4">
                            @if($item->status == 'dipinjam')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color: #FEF3C7; color: #92400E;">
                                    Dipinjam
                                </span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color: #ecfdf3; color: #047857;">
                                    Dikembalikan
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color: #fde8e8; color: #b91c1c;">
                                    Terlambat
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2 flex-wrap">

                                @if($item->status == 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.kembalikan', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="px-4 py-2 rounded-xl text-sm text-white"
                                            style="background-color: #16a34a;">
                                            Kembalikan
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.peminjaman.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 rounded-xl text-sm text-white"
                                        style="background-color: #dc2626;">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="p-5 border-t">
        {{ $peminjaman->links() }}
    </div>
</div>

@endsection