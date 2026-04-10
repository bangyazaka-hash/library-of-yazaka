<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color:#FDFBF7">

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6" style="color:#34495E;">
        Daftar Buku
    </h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($buku as $item)
            <div class="bg-white p-5 rounded-2xl border" style="border-color:#f0e8dc;">
                <h3 class="font-bold text-lg mb-2">{{ $item->judul }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ $item->penulis }}</p>
                <p class="mb-3">Stok: {{ $item->stok }}</p>

                <form action="{{ route('siswa.buku.pinjam', $item->id) }}" method="POST">
                    @csrf
                    <button class="w-full py-2 rounded-xl text-white"
                        style="background-color:#F4A261;">
                        Pinjam
                    </button>
                </form>
            </div>
        @endforeach

    </div>

</div>

</body>
</html>