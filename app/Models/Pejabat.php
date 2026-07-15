<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = [
        'kategori_pejabat',
        'nama',
        'jabatan_keterangan',
        'instansi',
        'nip',
        'pangkat',
        'golongan',
        'tempat_lahir',
        'tanggal_lahir',
        'riwayat_pendidikan',
        'riwayat_karir',
        'penghargaan',
        'foto',
        'is_active',
    ];

    public function lhkpns()
    {
        return $this->hasMany(PejabatLhkpn::class, 'pejabat_id');
    }
}
