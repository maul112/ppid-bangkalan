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
});
    
Route::middleware(['auth', 'role:admin_opd'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/opd', function() {
        return view('opd/dashboard');
    })->name('opd.dashboard');
});
            

/* --- 3. PROFIL & AUTH --- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';