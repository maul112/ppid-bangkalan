<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberi izin pengisian kolom
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
    ];
}