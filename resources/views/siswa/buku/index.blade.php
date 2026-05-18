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

<!-- SEARCH + FILTER -->
<form method="GET" action="" class="mb-8">

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

        <!-- FILTER -->
        <select name="rak"
                class="text-sm rounded-xl px-3 py-1 border"
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

<!-- GRID BUKU -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

    @forelse($buku as $item)

    <!-- CARD -->
    <div class="group">

        <!-- COVER -->
        <div
            onclick="openModal(
                '{{ $item->judul }}',
                '{{ $item->penulis }}',
                '{{ $item->penerbit }}',
                '{{ $item->tahun_terbit }}',
                '{{ $item->rak }}',
                `{{ $item->deskripsi }}`,
                '{{ $item->stok }}',
                '{{ route('siswa.buku.pinjam', $item->id) }}',
                '{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('images/default-book.png') }}'
            )"

            class="relative overflow-hidden rounded-2xl shadow-md cursor-pointer"
        >

            <img
                src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default-book.png') }}"
                class="w-full h-64 md:h-72 object-cover transition duration-300 group-hover:scale-105"
            >

            <!-- OVERLAY -->
            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition"></div>

        </div>

        <!-- TITLE -->
        <div class="mt-3">

            <h3 class="font-semibold text-sm md:text-base line-clamp-2"
                style="color:#34495E;">

                {{ $item->judul }}

            </h3>

            <p class="text-xs mt-1"
               style="color:#7b8a97;">

                {{ $item->penulis }}

            </p>

        </div>

    </div>

    @empty

        <div class="col-span-full text-center py-10 text-sm"
             style="color:#7b8a97;">

            Buku tidak ditemukan

        </div>

    @endforelse

</div>

<!-- MODAL -->
<div id="modalBuku"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-5">

    <!-- BOX -->
    <div class="bg-white rounded-3xl w-full max-w-3xl p-6 relative">

        <!-- CLOSE -->
        <button onclick="closeModal()"
                class="absolute top-4 right-4 text-lg text-gray-500 hover:text-black">

            ✕

        </button>

        <div class="flex flex-col md:flex-row gap-6">

            <!-- IMAGE -->
            <img id="modalGambar"
                 class="w-full md:w-56 h-80 object-cover rounded-2xl shadow">

            <!-- CONTENT -->
            <div class="flex flex-col justify-between w-full">

                <div>

                    <h2 id="modalJudul"
                        class="text-2xl font-bold text-[#34495E]">
                    </h2>

                    <div class="mt-4 space-y-2 text-sm text-gray-600">

                        <p>
                            <span class="font-semibold text-[#34495E]">
                                Penulis:
                            </span>

                            <span id="modalPenulis"></span>
                        </p>

                        <p>
                            <span class="font-semibold text-[#34495E]">
                                Penerbit:
                            </span>

                            <span id="modalPenerbit"></span>
                        </p>

                        <p>
                            <span class="font-semibold text-[#34495E]">
                                Tahun:
                            </span>

                            <span id="modalTahun"></span>
                        </p>

                        <p>
                            <span class="font-semibold text-[#34495E]">
                                Rak:
                            </span>

                            <span id="modalRak"></span>
                        </p>

                        <p>
                            <span class="font-semibold text-[#34495E]">
                                Stok:
                            </span>

                            <span id="modalStok"></span>
                        </p>

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mt-5">

                        <h3 class="font-semibold text-[#34495E] mb-2">
                            Deskripsi
                        </h3>

                        <p id="modalDeskripsi"
                           class="text-sm text-gray-600 leading-relaxed">
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-6">

                    <form id="modalPinjamForm" method="POST">

                        @csrf

                        <button
                            id="modalPinjamButton"
                            type="submit"
                            class="w-full md:w-auto px-6 py-3 rounded-2xl text-white font-medium hover:scale-105 transition"
                            style="background-color:#F4A261;">

                            Pinjam Buku

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function openModal(
    judul,
    penulis,
    penerbit,
    tahun,
    rak,
    deskripsi,
    stok,
    pinjamUrl,
    gambar
) {

    const modal = document.getElementById('modalBuku');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('modalJudul').innerText = judul;
    document.getElementById('modalPenulis').innerText = penulis;
    document.getElementById('modalPenerbit').innerText = penerbit;
    document.getElementById('modalTahun').innerText = tahun;
    document.getElementById('modalRak').innerText = rak;
    document.getElementById('modalStok').innerText = stok;
    document.getElementById('modalDeskripsi').innerText = deskripsi;
    document.getElementById('modalGambar').src = gambar;

    // FORM PINJAM
    document.getElementById('modalPinjamForm').action = pinjamUrl;

    // BUTTON
    const btn = document.getElementById('modalPinjamButton');

    if (parseInt(stok) > 0) {

        btn.disabled = false;

        btn.innerText = 'Pinjam Buku';

        btn.classList.remove('bg-gray-300', 'cursor-not-allowed');

        btn.style.backgroundColor = '#F4A261';

    } else {

        btn.disabled = true;

        btn.innerText = 'Stok Habis';

        btn.style.backgroundColor = '#D1D5DB';

    }

}

function closeModal() {

    const modal = document.getElementById('modalBuku');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}

</script>

@endsection