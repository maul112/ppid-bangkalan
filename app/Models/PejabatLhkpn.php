<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PejabatLhkpn extends Model
{
    protected $fillable = [
        'pejabat_id',
        'tahun',
        'file_path',
    ];

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'pejabat_id');
    }
}
