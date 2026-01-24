<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permohonan extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_tiket',
        'nama_pemohon',
        'nik',
        'alamat',
        'email',
        'no_hp',
        'foto_ktp',
        'opd_tujuan',
        'rincian_informasi',
        'tujuan_penggunaan',
        'cara_memperoleh',
        'cara_mendapatkan',
        'status',
        'tanggapan', 
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id')->withDefault([
        'name' => $this->nama_pemohon, // Mengambil inputan nama dari form jika user_id null
    ]);
}
}