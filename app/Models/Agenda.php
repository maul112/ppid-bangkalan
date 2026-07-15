<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'waktu',
        'judul',
        'uraian',
        'lokasi',
        'peserta',
        'jumlah_peserta',
        'keterangan',
        'dibuat_oleh'
    ];

    public function getStatusAttribute()
    {
        $today = now()->startOfDay();
        $agendaDate = \Carbon\Carbon::parse($this->tanggal)->startOfDay();

        if ($agendaDate->isToday()) {
            return 'Hari Ini';
        } elseif ($agendaDate->isPast()) {
            return 'Lewat';
        } else {
            return 'Mendatang';
        }
    }
}
