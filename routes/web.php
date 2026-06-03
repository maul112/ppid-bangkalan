<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DipController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\PermohonanAdminController;
use App\Http\Controllers\Admin\PermohonanOpdController;
use App\Http\Controllers\Admin\HariLiburController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

/* --- 1. HALAMAN PUBLIK --- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/struktur-organisasi', [HomeController::class, 'struktur'])->name('struktur_organisasi');
    Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
    Route::get('/tugas-fungsi', [HomeController::class, 'tugasFungsi'])->name('tugas_fungsi');
    Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi_misi');
    Route::get('/dasar-hukum', [HomeController::class, 'dasarHukum'])->name('dasar_hukum');
    Route::get('/sop', [HomeController::class, 'sop'])->name('sop');
    Route::get('/maklumat-pelayanan', [HomeController::class, 'maklumatPelayanan'])->name('maklumat_pelayanan');
    Route::get('/alur-pelayanan', [HomeController::class, 'alurPelayanan'])->name('alur_pelayanan');
    Route::get('/laporan-pelayanan', [HomeController::class, 'laporanPelayanan'])->name('laporan_pelayanan');
});

// Daftar Publik
Route::get('/permohonan/daftar-publik', [PermohonanController::class, 'daftarPublik'])->name('permohonan.daftar_publik');

// Fitur Tracking
Route::get('/permohonan/lacak', function () {
    return view('permohonan.tracking');
})->name('permohonan.tracking');

// PERBAIKAN: Diarahkan ke PermohonanController@cek untuk validasi NIK
Route::post('/permohonan/cek', [PermohonanController::class, 'cek'])->name('permohonan.cek');

Route::get('/permohonan/buat', [PermohonanController::class, 'create'])->name('permohonan.buat');
Route::post('/permohonan/simpan', [PermohonanController::class, 'store'])->name('permohonan.simpan');
Route::get('/permohonan/track/{nomor_tiket}', [PermohonanController::class, 'show'])->name('permohonan.show');

/* --- 2. HALAMAN ADMIN --- */
Route::middleware(['auth', 'role:admin_ppid'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('banner', BannerController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('regulasi', RegulasiController::class);
    Route::resource('dip', DipController::class);

    Route::get('/permohonan', [PermohonanAdminController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/{permohonan}', [PermohonanAdminController::class, 'show'])->name('permohonan.show');
    Route::patch('/permohonan/{permohonan}', [PermohonanAdminController::class, 'updateStatus'])->name('permohonan.update');
    Route::patch('/permohonan/{permohonan}/disposisi', [PermohonanAdminController::class, 'disposisi'])->name('permohonan.disposisi');
    Route::delete('/permohonan/{permohonan}', [PermohonanAdminController::class, 'destroy'])->name('permohonan.destroy');

    Route::resource('hari-libur', HariLiburController::class);
});
    
Route::middleware(['auth', 'role:admin_opd'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/opd', function() {
        return view('opd.dashboard');
    })->name('opd.dashboard');

    Route::get('/opd/permohonan', [PermohonanOpdController::class, 'index'])->name('opd.permohonan.index');
    Route::get('/opd/permohonan/{permohonan}', [PermohonanOpdController::class, 'show'])->name('opd.permohonan.show');
    Route::patch('/opd/permohonan/{permohonan}/tanggapi', [PermohonanOpdController::class, 'tanggapi'])->name('opd.permohonan.tanggapi');
});
            

/* --- 3. PROFIL & AUTH --- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// --- GENERATED PUBLIC ROUTES ---
Route::view('/profil/ppid/tentang', 'public.profil.ppid.tentang')->name('public.profil_ppid_tentang');
Route::view('/profil/ppid/tupoksi', 'public.profil.ppid.tupoksi')->name('public.profil_ppid_tupoksi');
Route::view('/profil/ppid/visimisi', 'public.profil.ppid.visimisi')->name('public.profil_ppid_visimisi');
Route::view('/profil/ppid/strukturorganisasi', 'public.profil.ppid.strukturorganisasi')->name('public.profil_ppid_strukturorganisasi');
Route::view('/profil/ppid/dasarhukum', 'public.profil.ppid.dasarhukum')->name('public.profil_ppid_dasarhukum');
Route::view('/profil/ppid/sop', 'public.profil.ppid.sop')->name('public.profil_ppid_sop');
Route::view('/profil/ppid/maklumatpelayanan', 'public.profil.ppid.maklumatpelayanan')->name('public.profil_ppid_maklumatpelayanan');
Route::view('/profil/ppid/alurpelayanan', 'public.profil.ppid.alurpelayanan')->name('public.profil_ppid_alurpelayanan');
Route::view('/profil/ppid/laporan', 'public.profil.ppid.laporan')->name('public.profil_ppid_laporan');
Route::view('/profil/pejabat/bupati', 'public.profil.pejabat.bupati')->name('public.profil_pejabat_bupati');
Route::view('/profil/pejabat/wakilbupati', 'public.profil.pejabat.wakilbupati')->name('public.profil_pejabat_wakilbupati');
Route::view('/profil/pejabat/sekda', 'public.profil.pejabat.sekda')->name('public.profil_pejabat_sekda');
Route::view('/profil/pejabat/asisten', 'public.profil.pejabat.asisten')->name('public.profil_pejabat_asisten');
Route::view('/profil/pejabat/stafahli', 'public.profil.pejabat.stafahli')->name('public.profil_pejabat_stafahli');
Route::view('/profil/pejabat/inspektur', 'public.profil.pejabat.inspektur')->name('public.profil_pejabat_inspektur');
Route::view('/profil/pejabat/kepalabadan', 'public.profil.pejabat.kepalabadan')->name('public.profil_pejabat_kepalabadan');
Route::view('/profil/pejabat/kepaladinas', 'public.profil.pejabat.kepaladinas')->name('public.profil_pejabat_kepaladinas');
Route::view('/profil/pejabat/kepalabagian', 'public.profil.pejabat.kepalabagian')->name('public.profil_pejabat_kepalabagian');
Route::view('/profil/pejabat/kepalapuskesmas', 'public.profil.pejabat.kepalapuskesmas')->name('public.profil_pejabat_kepalapuskesmas');
Route::view('/profil/pejabat/camat', 'public.profil.pejabat.camat')->name('public.profil_pejabat_camat');
Route::view('/profil/pejabat/lurah', 'public.profil.pejabat.lurah')->name('public.profil_pejabat_lurah');
Route::view('/profil/pejabat/direkturrsd', 'public.profil.pejabat.direkturrsd')->name('public.profil_pejabat_direkturrsd');
Route::view('/profil/pejabat/direkturbumd', 'public.profil.pejabat.direkturbumd')->name('public.profil_pejabat_direkturbumd');
Route::view('/dip/berkala', 'public.dip.berkala')->name('public.dip_berkala');
Route::view('/dip/setiapsaat', 'public.dip.setiapsaat')->name('public.dip_setiapsaat');
Route::view('/dip/sertamerta', 'public.dip.sertamerta')->name('public.dip_sertamerta');
Route::view('/dip/dikecualikan', 'public.dip.dikecualikan')->name('public.dip_dikecualikan');
Route::view('/layanan/berita', 'public.layanan.berita')->name('public.layanan_berita');
Route::view('/layanan/permohonan-informasi', 'public.layanan.permohonan-informasi')->name('public.layanan_permohonan_informasi');
Route::view('/layanan/formulir-keberatan', 'public.layanan.formulir-keberatan')->name('public.layanan_formulir_keberatan');
Route::view('/layanan/agenda-bulanan', 'public.layanan.agenda-bulanan')->name('public.layanan_agenda_bulanan');
Route::view('/layanan/agenda-tahunan', 'public.layanan.agenda-tahunan')->name('public.layanan_agenda_tahunan');
Route::view('/transparansi-pemkab', 'public.transparansi-pemkab')->name('public.transparansi_pemkab');
Route::view('/ppidpelaksana/badan', 'public.ppidpelaksana.badan')->name('public.ppidpelaksana_badan');
Route::view('/ppidpelaksana/bagian', 'public.ppidpelaksana.bagian')->name('public.ppidpelaksana_bagian');
Route::view('/ppidpelaksana/inspektorat', 'public.ppidpelaksana.inspektorat')->name('public.ppidpelaksana_inspektorat');
Route::view('/ppidpelaksana/setwan', 'public.ppidpelaksana.setwan')->name('public.ppidpelaksana_setwan');
Route::view('/ppidpelaksana/dinas', 'public.ppidpelaksana.dinas')->name('public.ppidpelaksana_dinas');
Route::view('/ppidpelaksana/kecamatan', 'public.ppidpelaksana.kecamatan')->name('public.ppidpelaksana_kecamatan');
Route::view('/ppidpelaksana/kelurahan', 'public.ppidpelaksana.kelurahan')->name('public.ppidpelaksana_kelurahan');
Route::view('/ppidpelaksana/rsd', 'public.ppidpelaksana.rsd')->name('public.ppidpelaksana_rsd');
Route::view('/ppidpelaksana/puskesmas', 'public.ppidpelaksana.puskesmas')->name('public.ppidpelaksana_puskesmas');
Route::view('/ppidpelaksana/bumd', 'public.ppidpelaksana.bumd')->name('public.ppidpelaksana_bumd');
