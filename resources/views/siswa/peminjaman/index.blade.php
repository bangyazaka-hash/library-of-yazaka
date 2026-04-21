@extends('layouts.siswa')

@section('title', 'Peminjaman Buku')
@section('page-title', 'Peminjaman Buku')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-3xl font-bold" style="color: #34495E;">
        Data Peminjaman
    </h2>
    <p class="mt-2" style="color: #7b8a97;">
        Lihat daftar buku yang sedang kamu pinjam.
    </p>
</div>

<!-- TABLE -->
<div class="rounded-3xl overflow-hidden border bg-white"
     style="border-color: #f0e8dc;">

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px]">
            <thead style="background-color: #FAF3EB;">
                <tr class="text-left">
                    <th class="px-6 py-5 font-bold">Gambar</th>
                    <th class="px-6 py-5 font-bold">Kode</th>
                    <th class="px-6 py-5 font-bold">Judul Buku</th>
                    <th class="px-6 py-5 font-bold">Tgl Pinjam</th>
                    <th class="px-6 py-5 font-bold">Jatuh Tempo</th>
                    <th class="px-6 py-5 font-bold">Denda</th>
                    <th class="px-6 py-5 font-bold">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjaman as $item)

                    @php
                        $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->startOfDay();

                        $tanggalAcuan = $item->tanggal_kembali 
                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->startOfDay()
                            : now()->startOfDay();

                        $hariTerlambat = 0;
                        $denda = 0;

                        if ($tanggalAcuan->gt($jatuhTempo)) {
                            $hariTerlambat = $jatuhTempo->diffInDays($tanggalAcuan);
                            $denda = $hariTerlambat * 1000;
                        }
                    @endphp

                    <tr class="border-t" style="border-color: #f3ece3;">

                        <!-- GAMBAR -->
                        <td class="px-6 py-4">
                            <img 
                                src="{{ $item->buku->gambar 
                                    ? asset('storage/' . $item->buku->gambar) 
                                    : asset('images/default-book.png') }}"
                                class="w-14 h-20 object-cover rounded-lg shadow"
                            >
                        </td>

                        <td class="px-6 py-5 font-semibold" style="color: #34495E;">
                            {{ $item->kode_peminjaman }}
                        </td>

                        <td class="px-6 py-5" style="color: #34495E;">
                            {{ $item->buku->judul ?? '-' }}
                        </td>

                        <td class="px-6 py-5" style="color: #7b8a97;">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5" style="color: #7b8a97;">
                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                        </td>

                        <!-- DENDA -->
                        <td class="px-6 py-5">
                            <span class="font-semibold text-[#34495E]">
                                Rp {{ number_format($denda, 0, ',', '.') }}
                            </span>

                            @if($hariTerlambat > 0)
                                <div class="text-xs text-red-500">
                                    Terlambat {{ $hariTerlambat }} hari
                                </div>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">
                            @if($item->status == 'dipinjam')
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #FEF3C7; color: #92400E;">
                                    Dipinjam
                                </span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #E9EDC9; color: #34495E;">
                                    Dikembalikan
                                </span>
                            @else
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #FEE2E2; color: #991B1B;">
                                    Terlambat
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center" style="color:#7b8a97;">
                            Belum ada buku yang sedang dipinjam.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($peminjaman instanceof \Illuminate\Pagination\LengthAwarePaginator && $peminjaman->hasPages())
        <div class="px-6 py-5 border-t" style="border-color:#f0e8dc;">
            {{ $peminjaman->links() }}
        </div>
    @endif
</div>

@endsection