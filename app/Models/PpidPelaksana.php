<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidPelaksana extends Model
{
    protected $fillable = [
        'kategori',
        'pejabat_id',
        'alamat',
        'telepon',
        'email',
        'website',
        'map_url',
        'sosmed_facebook',
        'sosmed_instagram',
        'sosmed_youtube',
        'sosmed_tiktok',
    ];

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'pejabat_id');
    }

    public function dokumenWajib()
    {
        return $this->hasMany(PpidDokumenWajib::class, 'ppid_pelaksana_id');
    }
}
