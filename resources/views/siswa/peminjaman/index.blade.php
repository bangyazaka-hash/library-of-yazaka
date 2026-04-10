<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku - Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen" style="background-color: #FDFBF7;">

<!-- TOPBAR -->
<header class="sticky top-0 z-40 border-b bg-white"
        style="border-color: #f0e8dc;">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold" style="color: #34495E;">Library</h1>
            <p class="text-sm" style="color: #7b8a97;">Peminjaman Buku</p>
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
            <table class="w-full min-w-[850px]">
                <thead style="background-color: #FAF3EB;">
                    <tr class="text-left">
                        <th class="px-6 py-5 font-bold" style="color: #34495E;">Kode</th>
                        <th class="px-6 py-5 font-bold" style="color: #34495E;">Judul Buku</th>
                        <th class="px-6 py-5 font-bold" style="color: #34495E;">Tgl Pinjam</th>
                        <th class="px-6 py-5 font-bold" style="color: #34495E;">Jatuh Tempo</th>
                        <th class="px-6 py-5 font-bold" style="color: #34495E;">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjaman as $item)
                        <tr class="border-t" style="border-color: #f3ece3;">
                            <td class="px-6 py-5 font-semibold" style="color: #34495E;">
                                {{ $item->kode_peminjaman }}
                            </td>

                            <td class="px-6 py-5" style="color: #34495E;">
                                {{ $item->buku->judul ?? '-' }}
                            </td>

                            <td class="px-6 py-5" style="color: #5f6f7d;">
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-5" style="color: #5f6f7d;">
                                {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                                      style="background-color: #FEF3C7; color: #B45309;">
                                    Dipinjam
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center" style="color: #7b8a97;">
                                Belum ada buku yang sedang dipinjam.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($peminjaman instanceof \Illuminate\Pagination\LengthAwarePaginator && $peminjaman->hasPages())
            <div class="px-6 py-5 border-t" style="border-color: #f3ece3;">
                {{ $peminjaman->links() }}
            </div>
        @endif
    </div>

</main>

</body>
</html>