@extends('layouts.admin')

@section('title', 'Edit Buku - Library')
@section('page-title', 'Edit Buku')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h3 class="text-2xl md:text-3xl font-bold" style="color: #34495E;">Edit Buku</h3>
        <p class="text-sm md:text-base mt-2" style="color: #7b8a97;">
            Perbarui informasi buku yang sudah tersimpan di sistem.
        </p>
    </div>

    <!-- Form Card -->
    <div class="rounded-3xl p-6 md:p-8 shadow-sm border bg-white" style="border-color: #f0e8dc;">
        
        <!-- ✅ FIX DI SINI -->
        <form action="{{ route('admin.buku.update', $buku->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-8">
            @csrf
            @method('PUT')

            @include('admin.buku._form')

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <a href="{{ route('admin.buku.index') }}"
                   class="px-5 py-3 rounded-2xl font-semibold text-center"
                   style="background-color: #E9EDC9; color: #34495E;">
                    Kembali
                </a>

                <button type="submit"
                    class="px-5 py-3 rounded-2xl font-semibold text-white"
                    style="background-color: #F4A261;">
                    Update Buku
                </button>
            </div>
        </form>
    </div>
@endsection