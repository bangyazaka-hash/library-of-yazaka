<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku - Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen" style="background-color: #FDFBF7;">

<!-- TOPBAR -->
<header class="sticky top-0 z-40 border-b bg-white"
        style="border-color: #f0e8dc;">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold" style="color: #34495E;">Library</h1>
            <p class="text-sm" style="color: #7b8a97;">Pengembalian Buku</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('siswa.dashboard') }}"
               class="px-5 py-2 rounded-2xl font-semibold"
               style="background-color: #E9EDC9; color: #34495E;">
                Dashboard
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="px-5 py-2 rounded-2xl text-white font-semibold"
                    style="background-color: #F4A261;">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-8">

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
            <table class="w-full min-w-[900px]">
                <thead style="background-color: #FAF3EB;">
                    <tr class="text-left">
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
                                          style="background-color: #DCFCE7; color: #166534;">
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
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                Belum ada riwayat pengembalian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengembalian instanceof \Illuminate\Pagination\LengthAwarePaginator && $pengembalian->hasPages())
            <div class="px-6 py-5 border-t">
                {{ $pengembalian->links() }}
            </div>
        @endif
    </div>

</main>

</body>
</html>