@extends('layouts.admin')

@section('title', 'Data Buku - Library')
@section('page-title', 'Kelola Data Buku')

@section('content')
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Data Buku</h3>
            <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
                Kelola seluruh koleksi buku perpustakaan dengan lebih terstruktur.
            </p>
        </div>

        <a href="{{ route('admin.buku.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-white font-semibold shadow-sm hover:scale-[1.01] transition"
           style="background-color: #F4A261;">
            Tambah Buku
        </a>
    </div>

    <!-- Search -->
    <div class="rounded-3xl p-5 shadow-sm border bg-white mb-6" style="border-color: #f0e8dc;">
        <form action="{{ route('admin.buku.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul, kode buku, penulis, atau kategori..."
                class="w-full rounded-2xl px-4 py-3 border outline-none"
                style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;">

            <button type="submit"
                class="px-5 py-3 rounded-2xl font-semibold text-white"
                style="background-color: #34495E;">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="rounded-3xl shadow-sm border overflow-hidden bg-white" style="border-color: #f0e8dc;">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead style="background-color: #fff7ef;">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-center font-semibold">Gambar</th> <!-- ✅ BARU -->
                        <th class="px-6 py-4 text-left font-semibold">Kode Buku</th>
                        <th class="px-6 py-4 text-left font-semibold">Judul</th>
                        <th class="px-6 py-4 text-left font-semibold">Penulis</th>
                        <th class="px-6 py-4 text-left font-semibold">Kategori</th>
                        <th class="px-6 py-4 text-left font-semibold">Stok</th>
                        <th class="px-6 py-4 text-left font-semibold">Status</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $index => $item)
                        <tr class="border-t" style="border-color: #f5eee5;">
                            <td class="px-6 py-4">{{ $buku->firstItem() + $index }}</td>

                            <!-- ✅ GAMBAR -->
                            <td class="px-6 py-4 text-center">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         class="w-16 h-20 object-cover rounded-lg mx-auto shadow">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-medium">{{ $item->kode_buku }}</td>
                            <td class="px-6 py-4">{{ $item->judul }}</td>
                            <td class="px-6 py-4">{{ $item->penulis }}</td>
                            <td class="px-6 py-4">{{ $item->kategori ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->stok }}</td>

                            <td class="px-6 py-4">
                                @if($item->status == 'tersedia')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                          style="background-color: #ecfdf3; color: #047857;">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                          style="background-color: #fff4e5; color: #b45309;">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.buku.edit', $item->id) }}"
                                       class="px-4 py-2 rounded-xl text-sm font-medium"
                                       style="background-color: #E9EDC9; color: #34495E;">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.buku.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl text-sm font-medium text-white"
                                            style="background-color: #dc2626;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center" style="color: #7b8a97;">
                                Belum ada data buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t" style="border-color: #f5eee5;">
            {{ $buku->withQueryString()->links() }}
        </div>
    </div>
@endsection