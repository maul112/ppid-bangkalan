<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidDokumenWajib extends Model
{
    protected $fillable = [
        'ppid_pelaksana_id',
        'kategori_dokumen',
        'tahun',
        'file_path',
    ];

    public function ppidPelaksana()
    {
        return $this->belongsTo(PpidPelaksana::class, 'ppid_pelaksana_id');
    }
}
