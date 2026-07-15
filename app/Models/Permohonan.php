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
        'pekerjaan',
        'alamat',
        'email',
        'no_hp',
        'foto_ktp',
        'rincian_informasi',
        'tujuan_penggunaan',
        'cara_memperoleh',
        'cara_mendapatkan',
        'status',
        'tanggapan',
        'file_pendukung',
        'file_tanggapan',
        'link_tanggapan',
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

    /**
     * Relasi ke OPD (Legacy - Single OPD, ditinggalkan)
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }

    /**
     * Relasi ke OPD via pivot (Many-to-Many)
     */
    public function opds()
    {
        return $this->belongsToMany(Opd::class, 'permohonan_opd')
                    ->withPivot(['tanggapan', 'status', 'disposisi_at', 'tanggapi_at', 'file_tanggapan', 'link_tanggapan'])
                    ->withTimestamps();
    }

    /**
     * Accessor Sisa Waktu 17 Hari Kerja
     */
    public function getSisaWaktuAttribute()
    {
        $start = $this->created_at ? $this->created_at->copy()->startOfDay() : now()->startOfDay();
        $end = now()->startOfDay();
        
        // Cek jika permohonan belum ada created_at, sisa = 17
        if (!$this->created_at) {
            return 17;
        }

        // Kalau status selesai atau ditolak, waktu berhenti (sisa waktu saat itu)
        // Kita asumsikan perhitungan berjalan jika status selain selesai/ditolak.
        // Jika sudah selesai, kita kembalikan 0 atau teks "Selesai".
        if (in_array($this->status, ['selesai', 'ditolak'])) {
            return 0; // atau bisa juga dihandle di view
        }

        $daysPassed = 0;
        $currentDate = $start->copy();

        // Ambil semua tanggal libur dari database menggunakan static cache untuk mencegah N+1 Query
        static $hariLiburs = null;
        if ($hariLiburs === null) {
            $hariLiburs = \App\Models\HariLibur::pluck('tanggal')->toArray();
        }

        // Hitung berapa hari kerja yang sudah berlalu
        while ($currentDate < $end) {
            $isWeekend = $currentDate->isWeekend();
            $isLibur = in_array($currentDate->format('Y-m-d'), $hariLiburs);

            if (!$isWeekend && !$isLibur) {
                $daysPassed++;
            }

            $currentDate->addDay();
        }

        $sisaWaktu = 17 - $daysPassed;
        
        // Batasi agar tidak negatif
        return $sisaWaktu > 0 ? $sisaWaktu : 0;
    }
}