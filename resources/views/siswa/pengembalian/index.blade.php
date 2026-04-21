@extends('layouts.siswa')

@section('title', 'Pengembalian Buku')
@section('page-title', 'Pengembalian Buku')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-3xl font-bold" style="color: #34495E;">
        Data Pengembalian
    </h2>
    <p class="mt-2" style="color: #7b8a97;">
        Riwayat buku yang sudah kamu kembalikan.
    </p>
</div>

<!-- TABLE -->
<div class="rounded-3xl overflow-hidden border bg-white"
     style="border-color: #f0e8dc;">

    <div class="overflow-x-auto">
        <table class="w-full min-w-[950px]">
            <thead style="background-color: #FAF3EB;">
                <tr class="text-left">
                    <th class="px-6 py-5 font-bold">Gambar</th>
                    <th class="px-6 py-5 font-bold">Kode</th>
                    <th class="px-6 py-5 font-bold">Judul Buku</th>
                    <th class="px-6 py-5 font-bold">Tgl Pinjam</th>
                    <th class="px-6 py-5 font-bold">Jatuh Tempo</th>
                    <th class="px-6 py-5 font-bold">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengembalian as $item)
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

                        <td class="px-6 py-5 font-semibold">
                            {{ $item->kode_peminjaman }}
                        </td>

                        <td class="px-6 py-5">
                            {{ $item->buku->judul ?? '-' }}
                        </td>

                        <td class="px-6 py-5">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5">
                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5">
                            @if($item->status == 'dikembalikan')
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #E9EDC9; color: #34495E;">
                                    Dikembalikan
                                </span>
                            @else
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #F4A261; color: white;">
                                    Terlambat
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center" style="color:#7b8a97;">
                            Belum ada riwayat pengembalian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengembalian instanceof \Illuminate\Pagination\LengthAwarePaginator && $pengembalian->hasPages())
        <div class="px-6 py-5 border-t" style="border-color:#f0e8dc;">
            {{ $pengembalian->links() }}
        </div>
    @endif

</div>

@endsection