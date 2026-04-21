@extends('layouts.siswa')

@section('title', 'Pinjam Buku')
@section('page-title', 'Pinjam Buku')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-2xl font-semibold" style="color:#34495E;">
        Daftar Buku
    </h2>
    <p class="mt-1 text-sm" style="color:#7b8a97;">
        Pilih buku yang ingin kamu pinjam
    </p>
</div>

<!-- 🔥 SEARCH + FILTER -->
<form method="GET" action="" class="mb-6">
    <div class="flex flex-wrap gap-3 items-center bg-white border rounded-2xl px-4 py-3 shadow-sm"
         style="border-color:#f0e8dc;">
        
        <!-- SEARCH -->
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul..."
            class="flex-1 min-w-[200px] outline-none text-sm"
            style="color:#34495E;"
        >

        <!-- FILTER RAK -->
        <select name="rak" class="text-sm rounded-xl px-3 py-1 border"
                style="border-color:#f0e8dc;">
            <option value="">Semua Rak</option>
            @foreach($buku->pluck('rak')->unique() as $rak)
                <option value="{{ $rak }}" {{ request('rak') == $rak ? 'selected' : '' }}>
                    {{ $rak }}
                </option>
            @endforeach
        </select>

        <!-- BUTTON -->
        <button type="submit"
            class="px-4 py-1.5 rounded-xl text-white text-sm font-medium"
            style="background-color:#F4A261;">
            Filter
        </button>

        <!-- RESET -->
        <a href="{{ url()->current() }}"
           class="px-3 py-1.5 rounded-xl text-sm"
           style="background-color:#f0e8dc; color:#34495E;">
            Reset
        </a>
    </div>
</form>

<!-- LIST -->
<div class="space-y-4">

    @forelse($buku as $item)
    <div 
        onclick="openModal(
            '{{ $item->judul }}',
            '{{ $item->penulis }}',
            '{{ $item->penerbit }}',
            '{{ $item->tahun_terbit }}',
            '{{ $item->rak }}',
            `{{ $item->deskripsi }}`,
            '{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('images/default-book.png') }}'
        )"
        class="cursor-pointer flex items-center justify-between bg-white px-6 py-4 rounded-2xl border shadow-sm hover:shadow-md transition"
        style="border-color:#f0e8dc;"
    >

        <!-- KIRI -->
        <div class="flex items-center gap-5 w-full">

            <!-- GAMBAR -->
            <img 
                src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default-book.png') }}"
                class="w-20 h-28 object-cover rounded-lg shadow"
            >

            <!-- INFO -->
            <div class="flex flex-col gap-1.5 w-full max-w-xl">

                <h3 class="font-semibold text-base" style="color:#34495E;">
                    {{ $item->judul }}
                </h3>

                <div class="text-xs space-y-0.5" style="color:#7b8a97;">
                    <p><span class="font-medium">Penulis:</span> {{ $item->penulis }}</p>
                    <p><span class="font-medium">Penerbit:</span> {{ $item->penerbit }}</p>
                    <p><span class="font-medium">Tahun:</span> {{ $item->tahun_terbit ?? '-' }}</p>
                    <p><span class="font-medium">Rak:</span> {{ $item->rak ?? '-' }}</p>
                </div>

                <!-- DESKRIPSI -->
                <div class="text-xs mt-1" style="color:#7b8a97;">
                    <p class="font-medium text-[#34495E]">Deskripsi:</p>
                    <p>
                        {{ $item->deskripsi 
                            ? \Illuminate\Support\Str::limit($item->deskripsi, 100) 
                            : '-' 
                        }}
                    </p>

                    <span class="text-[11px] font-medium" style="color:#F4A261;">
                        Klik untuk detail →
                    </span>
                </div>

                <!-- STOK -->
                <div class="mt-1">
                    @if($item->stok > 0)
                        <span class="text-[11px] px-2.5 py-1 rounded-full"
                              style="background-color:#f0e8dc; color:#34495E;">
                            Stok: {{ $item->stok }}
                        </span>
                    @else
                        <span class="text-[11px] px-2.5 py-1 rounded-full bg-gray-200 text-gray-500">
                            Stok habis
                        </span>
                    @endif
                </div>

            </div>
        </div>

        <!-- BUTTON -->
        <form action="{{ route('siswa.buku.pinjam', $item->id) }}" method="POST" onclick="event.stopPropagation()">
            @csrf

            @if($item->stok > 0)
                <button class="px-4 py-2 rounded-xl text-white text-sm font-medium hover:scale-105 transition"
                    style="background-color:#F4A261;">
                    Pinjam
                </button>
            @else
                <button disabled class="px-4 py-2 rounded-xl bg-gray-300 text-white text-sm">
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

<!-- 🔥 MODAL POPUP -->
<div id="modalBuku" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    
    <div class="bg-white rounded-3xl w-full max-w-2xl p-6 relative">

        <button onclick="closeModal()" class="absolute top-4 right-4 text-lg">✕</button>

        <div class="flex gap-6">

            <img id="modalGambar" class="w-28 h-40 object-cover rounded-xl shadow">

            <div class="flex flex-col gap-2 text-sm">

                <h2 id="modalJudul" class="text-lg font-semibold text-[#34495E]"></h2>

                <p><b>Penulis:</b> <span id="modalPenulis"></span></p>
                <p><b>Penerbit:</b> <span id="modalPenerbit"></span></p>
                <p><b>Tahun:</b> <span id="modalTahun"></span></p>
                <p><b>Rak:</b> <span id="modalRak"></span></p>

                <div class="mt-2">
                    <p class="font-semibold">Deskripsi:</p>
                    <p id="modalDeskripsi" class="text-xs text-gray-600"></p>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
function openModal(judul, penulis, penerbit, tahun, rak, deskripsi, gambar) {
    document.getElementById('modalBuku').classList.remove('hidden');

    document.getElementById('modalJudul').innerText = judul;
    document.getElementById('modalPenulis').innerText = penulis;
    document.getElementById('modalPenerbit').innerText = penerbit;
    document.getElementById('modalTahun').innerText = tahun;
    document.getElementById('modalRak').innerText = rak;
    document.getElementById('modalDeskripsi').innerText = deskripsi;
    document.getElementById('modalGambar').src = gambar;
}

function closeModal() {
    document.getElementById('modalBuku').classList.add('hidden');
}
</script>

@endsection