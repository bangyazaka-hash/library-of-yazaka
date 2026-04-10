<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataBuku = [
            [
                'kode_buku' => 'BK001',
                'judul' => 'Pemrograman Web Dasar',
                'penulis' => 'Andi Setiawan',
                'penerbit' => 'Informatika Press',
                'tahun_terbit' => 2022,
                'kategori' => 'Teknologi',
                'stok' => 5,
                'rak' => 'A1',
                'deskripsi' => 'Buku dasar pemrograman web untuk pemula.',
                'status' => 'tersedia',
            ],
            [
                'kode_buku' => 'BK002',
                'judul' => 'Basis Data MySQL',
                'penulis' => 'Budi Santoso',
                'penerbit' => 'Tekno Media',
                'tahun_terbit' => 2021,
                'kategori' => 'Database',
                'stok' => 3,
                'rak' => 'A2',
                'deskripsi' => 'Panduan memahami dan menggunakan MySQL.',
                'status' => 'tersedia',
            ],
            [
                'kode_buku' => 'BK003',
                'judul' => 'Laravel untuk Pemula',
                'penulis' => 'Rizky Pratama',
                'penerbit' => 'Code House',
                'tahun_terbit' => 2023,
                'kategori' => 'Framework',
                'stok' => 4,
                'rak' => 'B1',
                'deskripsi' => 'Belajar Laravel dari dasar sampai bisa membuat aplikasi.',
                'status' => 'tersedia',
            ],
        ];

        foreach ($dataBuku as $buku) {
            Buku::updateOrCreate(
                ['kode_buku' => $buku['kode_buku']],
                $buku
            );
        }
    }
}