<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $fillable = ['nama_opd', 'singkatan'];

    /**
     * Relasi ke Permohonan via pivot (Many-to-Many)
     */
    public function permohonans()
    {
        return $this->belongsToMany(Permohonan::class, 'permohonan_opd')
                    ->withPivot(['tanggapan', 'status', 'disposisi_at', 'tanggapi_at'])
                    ->withTimestamps();
    }
}
