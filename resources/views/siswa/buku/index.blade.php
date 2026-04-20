<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen" style="background-color:#FDFBF7">

<!-- 🔥 NAVBAR -->
<header class="sticky top-0 z-40 border-b bg-white"
        style="border-color: #f0e8dc;">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <div>
            <h1 class="text-2xl font-bold" style="color:#34495E;">Library</h1>
            <p class="text-sm" style="color:#7b8a97;">Pinjam Buku</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('siswa.dashboard') }}"
               class="px-5 py-2 rounded-2xl font-semibold"
               style="background-color:#E9EDC9; color:#34495E;">
                Dashboard
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="px-5 py-2 rounded-2xl text-white font-semibold"
                        style="background-color:#F4A261;">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<!-- CONTENT -->
<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight" style="color:#34495E;">
            Daftar Buku
        </h1>
        <p class="text-sm mt-1" style="color:#7b8a97;">
            Pilih buku yang ingin kamu pinjam
        </p>
    </div>

    <!-- SEARCH -->
    <form method="GET" action="" class="mb-6">
        <div class="flex items-center bg-white border rounded-2xl px-4 py-2 shadow-sm focus-within:shadow-md transition"
             style="border-color:#f0e8dc;">
            
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul..."
                class="w-full outline-none text-sm"
                style="color:#34495E;"
            >

            <button type="submit"
                class="ml-3 px-4 py-1.5 rounded-xl text-white text-sm font-semibold"
                style="background-color:#F4A261;">
                Cari
            </button>
        </div>
    </form>

    <!-- ALERT -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- LIST -->
    <div class="space-y-4">

        @forelse($buku as $item)
            <div class="flex items-center justify-between bg-white px-6 py-5 rounded-2xl border shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition"
                 style="border-color:#f0e8dc;">

                <div class="flex flex-col gap-1">
                    <h3 class="font-semibold text-lg" style="color:#34495E;">
                        {{ $item->judul }}
                    </h3>

                    <div class="text-sm flex flex-wrap gap-x-4" style="color:#7b8a97;">
                        <span>{{ $item->penulis }}</span>
                        <span>{{ $item->penerbit }}</span>
                    </div>

                    <div class="mt-2">
                        @if($item->stok > 0)
                            <span class="text-xs px-3 py-1 rounded-full"
                                  style="background-color:#f0e8dc; color:#34495E;">
                                Stok: {{ $item->stok }}
                            </span>
                        @else
                            <span class="text-xs px-3 py-1 rounded-full bg-gray-200 text-gray-500">
                                Stok habis
                            </span>
                        @endif
                    </div>
                </div>

                <form action="{{ route('siswa.buku.pinjam', $item->id) }}" method="POST">
                    @csrf

                    @if($item->stok > 0)
                        <button class="px-5 py-2 rounded-xl text-white font-semibold shadow-sm hover:scale-105 transition"
                            style="background-color:#F4A261;">
                            Pinjam
                        </button>
                    @else
                        <button disabled class="px-5 py-2 rounded-xl bg-gray-300 text-white cursor-not-allowed">
                            Habis
                        </button>
                    @endif
                </form>

            </div>
        @empty
            <div class="text-center py-10 text-sm" style="color:#7b8a97;">
                Buku tidak ditemukan
            </div>
        @endforelse

    </div>

</div>

</body>
</html>