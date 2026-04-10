@extends('layouts.admin')

@section('title', 'Tambah Peminjaman - Library')
@section('page-title', 'Tambah Peminjaman')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Tambah Peminjaman</h3>
        <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
            Tambahkan transaksi peminjaman buku untuk anggota perpustakaan.
        </p>
    </div>

    <!-- Error Alert -->
    @if(session('error'))
        <div class="mb-6 rounded-2xl px-5 py-4 text-sm font-medium"
             style="background-color: #fde8e8; color: #b91c1c;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form -->
    <div class="rounded-3xl p-6 md:p-8 shadow-sm border bg-white" style="border-color: #f0e8dc;">
        <form action="{{ route('admin.peminjaman.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Anggota -->
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                        Pilih Anggota
                    </label>
                    <select name="anggota_id"
                            class="w-full rounded-2xl border px-4 py-3 focus:outline-none focus:ring-2"
                            style="border-color: #E5D7C7;"
                            required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggota as $item)
                            <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->user->name ?? '-' }} - {{ $item->nis }}
                            </option>
                        @endforeach
                    </select>
                    @error('anggota_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buku -->
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                        Pilih Buku
                    </label>
                    <select name="buku_id"
                            class="w-full rounded-2xl border px-4 py-3 focus:outline-none focus:ring-2"
                            style="border-color: #E5D7C7;"
                            required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($buku as $item)
                            <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->judul }} (Stok: {{ $item->stok }})
                            </option>
                        @endforeach
                    </select>
                    @error('buku_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                        Tanggal Pinjam
                    </label>
                    <input type="date" name="tanggal_pinjam"
                           value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                           class="w-full rounded-2xl border px-4 py-3 focus:outline-none focus:ring-2"
                           style="border-color: #E5D7C7;"
                           required>
                    @error('tanggal_pinjam')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jatuh Tempo -->
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                        Tanggal Jatuh Tempo
                    </label>
                    <input type="date" name="tanggal_jatuh_tempo"
                           value="{{ old('tanggal_jatuh_tempo') }}"
                           class="w-full rounded-2xl border px-4 py-3 focus:outline-none focus:ring-2"
                           style="border-color: #E5D7C7;"
                           required>
                    @error('tanggal_jatuh_tempo')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <a href="{{ route('admin.peminjaman.index') }}"
                   class="px-5 py-3 rounded-2xl font-semibold text-center"
                   style="background-color: #E9EDC9; color: #34495E;">
                    Kembali
                </a>

                <button type="submit"
                    class="px-5 py-3 rounded-2xl font-semibold text-white"
                    style="background-color: #F4A261;">
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>
@endsection