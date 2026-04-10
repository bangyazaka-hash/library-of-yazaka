<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'stok',
        'rak',
        'deskripsi',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}