# Implementasi Fitur Disposisi OPD, Tanggapan, Laporan, & Sisa Waktu

Rencana ini dibuat berdasarkan permintaan klien untuk menambahkan fitur penerusan (disposisi) permohonan dari Admin PPID ke Admin OPD, pengelolaan tanggapan dari OPD, perhitungan sisa waktu 17 hari kerja, dan pembuatan master Hari Libur.

## User Review Required
> [!IMPORTANT]
> **Perubahan Struktur Database:** Rencana ini akan menambah tabel baru `hari_liburs` dan memodifikasi tabel `permohonans` (menambahkan `opd_id` untuk relasi pasti ke OPD). Mohon pastikan rencana ini sudah sesuai dengan kebutuhan sebelum dieksekusi.

## Open Questions
> [!WARNING]
> 1. **Mulai Perhitungan 17 Hari:** Apakah sisa waktu 17 hari kerja dihitung sejak permohonan **dibuat (masuk)** oleh pemohon, atau sejak permohonan **didisposisikan** oleh Admin PPID ke OPD? (Asumsi saat ini: Dihitung sejak permohonan masuk / `created_at`).
> 2. **Alur Status:** Jika OPD memberikan tanggapan, apakah status otomatis menjadi "Selesai" dan langsung bisa dilihat pemohon, atau harus diverifikasi ulang oleh Admin PPID utama? (Asumsi saat ini: Tanggapan dari OPD akan membuat status menjadi "Selesai").

## Proposed Changes

---

### Database Migrations & Models

Akan ada penambahan tabel dan modifikasi struktur relasi agar data terhubung dengan kuat.

#### [NEW] `database/migrations/xxxx_xx_xx_xxxxxx_create_hari_liburs_table.php`
- Membuat tabel `hari_liburs` dengan field `tanggal` (date) dan `keterangan` (string).
- Membuat model `App\Models\HariLibur`.

#### [NEW] `database/migrations/xxxx_xx_xx_xxxxxx_add_opd_id_to_permohonans_table.php`
- Menambahkan field `opd_id` (foreign key nullable) pada tabel `permohonans` untuk menandakan permohonan ditugaskan ke OPD mana (Disposisi).

#### [MODIFY] `app/Models/Permohonan.php`
- Menambahkan relasi `opd()` (BelongsTo) ke model `Opd`.
- Menambahkan method/accessor `getSisaWaktuAttribute()` untuk menghitung sisa waktu pengerjaan (17 hari dikurangi hari berjalan, abaikan *weekend* dan tanggal merah di `hari_liburs`).

#### [MODIFY] `database/seeders/RoleSeeder.php`
- Menambahkan beberapa data dummy `Opd` lain (Dinas Pendidikan, Dinas PU, dll).
- Menambahkan user Admin OPD yang berkorespondensi dengan OPD-OPD tersebut.

---

### Admin PPID (Utama)

Fitur untuk Admin PPID Utama untuk mengatur Hari Libur dan meneruskan permohonan.

#### [NEW] `app/Http/Controllers/Admin/HariLiburController.php`
- Controller CRUD untuk mengatur tanggal merah setahun sekali.

#### [NEW] `resources/views/admin/hari_libur/`
- `index.blade.php` (tabel daftar libur)
- `create.blade.php` / `edit.blade.php` (form input)

#### [MODIFY] `routes/web.php`
- Menambahkan resource route untuk `hari-libur` di bawah middleware `admin_ppid`.
- Menambahkan route `disposisi` yang mengarah ke `PermohonanAdminController@disposisi` jika belum aktif.
- Menambahkan routes untuk `Admin OPD` mengarah ke controller baru.

#### [MODIFY] `app/Http/Controllers/Admin/PermohonanAdminController.php`
- Menambahkan fungsi `disposisi(Request $request, Permohonan $permohonan)` untuk memperbarui `opd_id` permohonan.

#### [MODIFY] `resources/views/admin/permohonan/show.blade.php`
- Menambahkan form "Disposisi ke OPD" (berisi dropdown semua OPD).
- Menampilkan sisa waktu pengerjaan di UI.

---

### Admin OPD

Fitur untuk Admin OPD merespons permohonan yang ditugaskan ke dinas mereka.

#### [NEW] `app/Http/Controllers/Admin/PermohonanOpdController.php`
- Controller khusus untuk OPD.
- `index()`: Mengambil daftar permohonan dimana `opd_id` sama dengan `Auth::user()->opd_id`.
- `show()`: Menampilkan detail permohonan beserta form tanggapan.
- `tanggapi()`: Menyimpan tanggapan dari OPD dan mengubah status permohonan menjadi Selesai.

#### [NEW] `resources/views/opd/permohonan/`
- `index.blade.php`: Tabel laporan daftar permohonan masuk untuk OPD tersebut beserta indikator sisa waktu.
- `show.blade.php`: Halaman detail untuk mengisi jawaban/tanggapan.

#### [MODIFY] `resources/views/opd/dashboard.blade.php`
- Merapikan dashboard OPD dan menambah menu navigasi ke "Permohonan Masuk" dan "Tabel Laporan".

---

## Verification Plan

### Automated Tests
- Menjalankan `php artisan migrate:fresh --seed` untuk memastikan semua tabel dan relasi baru berjalan dengan baik, beserta akun-akun OPD baru.

### Manual Verification
1. Login sebagai Admin PPID (`admin_ppid@bangkalankab.go.id`), isi master hari libur.
2. Buat permohonan baru di halaman publik.
3. Di Admin PPID, buka permohonan tersebut, perhatikan kalkulasi hari sisa, lalu pilih opsi **Disposisi ke Dinas Kesehatan**.
4. Login sebagai Admin OPD (Dinas Kesehatan), pastikan permohonan tersebut muncul di tabel laporan mereka.
5. Admin OPD memberikan jawaban (tanggapan).
6. Cek melalui Tracking publik / Admin PPID apakah status telah berubah dan tanggapan tersimpan dengan baik.
