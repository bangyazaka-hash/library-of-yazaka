@extends('layouts.admin')

@section('title', 'Edit Anggota - Library')
@section('page-title', 'Edit Anggota')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Edit Anggota</h3>
        <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
            Perbarui data anggota dan akun login siswa.
        </p>
    </div>

    <!-- Form -->
    <div class="rounded-3xl p-6 md:p-8 shadow-sm border bg-white" style="border-color: #f0e8dc;">
        <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            @include('admin.anggota._form')

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <a href="{{ route('admin.anggota.index') }}"
                   class="px-5 py-3 rounded-2xl font-semibold text-center"
                   style="background-color: #E9EDC9; color: #34495E;">
                    Kembali
                </a>

                <button type="submit"
                    class="px-5 py-3 rounded-2xl font-semibold text-white"
                    style="background-color: #F4A261;">
                    Update Anggota
                </button>
            </div>
        </form>
    </div>
@endsection