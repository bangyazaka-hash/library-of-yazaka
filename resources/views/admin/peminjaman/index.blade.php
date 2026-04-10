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

    <!-- Table Desktop -->
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
                        <tr class="border-t" style="border-color: #f5eee5;">
                            <td class="px-6 py-4 font-medium">{{ $item->kode_peminjaman }}</td>
                            <td class="px-6 py-4">{{ $item->anggota->user->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->buku->judul ?? '-' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                            </td>
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
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    @if($item->status == 'dipinjam')
                                        <form action="{{ route('admin.peminjaman.kembalikan', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button class="px-4 py-2 rounded-xl text-sm text-white"
                                                style="background-color: #16a34a;">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.peminjaman.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
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

    <!-- Card Mobile -->
    <div class="md:hidden space-y-4">
        @forelse($peminjaman as $item)
            <div class="rounded-3xl p-5 shadow-sm border bg-white" style="border-color: #f0e8dc;">
                <div class="mb-3">
                    <p class="text-xs mb-1" style="color: #7b8a97;">Kode Peminjaman</p>
                    <p class="font-semibold" style="color: #34495E;">{{ $item->kode_peminjaman }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-xs mb-1" style="color: #7b8a97;">Anggota</p>
                    <p class="text-sm" style="color: #34495E;">{{ $item->anggota->user->name ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <p class="text-xs mb-1" style="color: #7b8a97;">Buku</p>
                    <p class="text-sm" style="color: #34495E;">{{ $item->buku->judul ?? '-' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Tgl Pinjam</p>
                        <p class="text-sm" style="color: #34495E;">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Jatuh Tempo</p>
                        <p class="text-sm" style="color: #34495E;">
                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Tgl Kembali</p>
                        <p class="text-sm" style="color: #34495E;">
                            {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Denda</p>
                        <p class="text-sm font-semibold" style="color: #34495E;">
                            Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-xs mb-1" style="color: #7b8a97;">Status</p>
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
                </div>

                <div class="flex flex-col gap-2">
                    @if($item->status == 'dipinjam')
                        <form action="{{ route('admin.peminjaman.kembalikan', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="w-full px-4 py-3 rounded-2xl text-sm font-medium text-white"
                                style="background-color: #16a34a;">
                                Kembalikan
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.peminjaman.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-3 rounded-2xl text-sm font-medium text-white"
                            style="background-color: #dc2626;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-3xl p-6 text-center shadow-sm border bg-white" style="border-color: #f0e8dc;">
                <p style="color: #7b8a97;">Belum ada data peminjaman.</p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $peminjaman->links() }}
        </div>
    </div>
@endsection