@extends('layouts.admin')

@section('title', 'Data Anggota - Library')
@section('page-title', 'Kelola Anggota')

@section('content')
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Data Anggota</h3>
            <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
                Kelola seluruh data anggota perpustakaan.
            </p>
        </div>

        <a href="{{ route('admin.anggota.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-white font-semibold shadow-sm"
           style="background-color: #F4A261;">
            Tambah Anggota
        </a>
    </div>

    <!-- Search -->
    <div class="rounded-3xl p-5 shadow-sm border bg-white mb-6" style="border-color: #f0e8dc;">
        <form action="{{ route('admin.anggota.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, username, NIS, atau kelas..."
                class="w-full rounded-2xl px-4 py-3 border outline-none"
                style="background-color: #FDFBF7; border-color: #e8e2d8;">

            <button type="submit"
                class="px-5 py-3 rounded-2xl font-semibold text-white"
                style="background-color: #34495E;">
                Cari
            </button>
        </form>
    </div>

    <!-- Table Desktop -->
    <div class="hidden md:block rounded-3xl shadow-sm border overflow-hidden bg-white" style="border-color: #f0e8dc;">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead style="background-color: #fff7ef;">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Username</th>
                        <th class="px-6 py-4 text-left">NIS</th>
                        <th class="px-6 py-4 text-left">Kelas</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $index => $item)
                        <tr class="border-t" style="border-color: #f5eee5;">
                            <td class="px-6 py-4">{{ $anggota->firstItem() + $index }}</td>
                            <td class="px-6 py-4 font-medium">{{ $item->user->name }}</td>
                            <td class="px-6 py-4">{{ $item->user->username }}</td>
                            <td class="px-6 py-4">{{ $item->nis }}</td>
                            <td class="px-6 py-4">{{ $item->kelas ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($item->status == 'aktif')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                          style="background-color: #ecfdf3; color: #047857;">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                          style="background-color: #fde8e8; color: #b91c1c;">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.anggota.edit', $item->id) }}"
                                       class="px-4 py-2 rounded-xl text-sm"
                                       style="background-color: #E9EDC9; color: #34495E;">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.anggota.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
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
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                Belum ada data anggota.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t">
            {{ $anggota->withQueryString()->links() }}
        </div>
    </div>

    <!-- Card Mobile -->
    <div class="md:hidden space-y-4">
        @forelse($anggota as $item)
            <div class="rounded-3xl p-5 shadow-sm border bg-white" style="border-color: #f0e8dc;">
                <div class="mb-3">
                    <p class="text-xs mb-1" style="color: #7b8a97;">Nama</p>
                    <p class="font-semibold" style="color: #34495E;">{{ $item->user->name }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Username</p>
                        <p class="text-sm" style="color: #34495E;">{{ $item->user->username }}</p>
                    </div>
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">NIS</p>
                        <p class="text-sm" style="color: #34495E;">{{ $item->nis }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Kelas</p>
                        <p class="text-sm" style="color: #34495E;">{{ $item->kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs mb-1" style="color: #7b8a97;">Status</p>
                        @if($item->status == 'aktif')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                  style="background-color: #ecfdf3; color: #047857;">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                  style="background-color: #fde8e8; color: #b91c1c;">
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.anggota.edit', $item->id) }}"
                       class="w-full text-center px-4 py-3 rounded-2xl text-sm font-medium"
                       style="background-color: #E9EDC9; color: #34495E;">
                        Edit
                    </a>

                    <form action="{{ route('admin.anggota.destroy', $item->id) }}" method="POST"
                          class="w-full"
                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
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
                <p style="color: #7b8a97;">Belum ada data anggota.</p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $anggota->withQueryString()->links() }}
        </div>
    </div>
@endsection