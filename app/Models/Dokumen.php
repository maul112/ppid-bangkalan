<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'kategori',
        'judul',
        'slug',
        'tahun',
        'keterangan',
        'opd_id',
        'file_path',
        'file_size',
        'dilihat',
        'didownload',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
