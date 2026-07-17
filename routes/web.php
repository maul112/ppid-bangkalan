<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DipController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\PermohonanAdminController;
use App\Http\Controllers\Admin\PermohonanOpdController;
use App\Http\Controllers\Admin\HariLiburController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\LhkpnController;
use App\Http\Controllers\PublicDokumenController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

/* --- 0. PORTAL ADMIN (TERSEMBUNYI) --- */
Route::get('/portal-admin', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return $role === 'admin_opd'
            ? redirect()->route('admin.opd.dashboard')
            : redirect()->route('admin.dashboard');
    }
    return view('auth.login');
})->name('portal.admin');

/* --- 1. HALAMAN PUBLIK --- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/struktur-organisasi', [HomeController::class, 'struktur'])->name('struktur_organisasi');
    Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
    Route::get('/tugas-fungsi', [HomeController::class, 'tugasFungsi'])->name('tugas_fungsi');
    Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi_misi');

    Route::get('/dasar-hukum', [PublicDokumenController::class, 'dasarHukum'])->name('dasar_hukum');
    Route::get('/sop', [PublicDokumenController::class, 'sop'])->name('sop');

    Route::get('/maklumat-pelayanan', [HomeController::class, 'maklumatPelayanan'])
        ->name('maklumat_pelayanan');

    Route::get('/alur-pelayanan', [PublicDokumenController::class, 'alurPelayanan'])
        ->name('alur_pelayanan');

    Route::get('/laporan-pelayanan', [PublicDokumenController::class, 'laporanPpid'])
        ->name('laporan_pelayanan');
        

});

// Daftar Publik (Dialihkan ke layanan permohonan informasi)
// Route::get('/permohonan/daftar-publik', [PermohonanController::class, 'daftarPublik'])->name('permohonan.daftar_publik');

Route::get('/dokumen/{slug}', [PublicDokumenController::class, 'show'])->name('public.dokumen.show');
Route::get('/dokumen/{slug}/download', [PublicDokumenController::class, 'download'])->name('public.dokumen.download');



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
    Route::resource('dokumen', DokumenController::class);
    Route::resource('pejabat', PejabatController::class);
    Route::resource('lhkpn', LhkpnController::class);
    Route::resource('agenda', \App\Http\Controllers\Admin\AgendaController::class);

    Route::get('struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');
    Route::post('struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'store'])->name('struktur-organisasi.store');
    Route::put('struktur-organisasi/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'update'])->name('struktur-organisasi.update');

    Route::resource('ppid_pelaksana', \App\Http\Controllers\Admin\PpidPelaksanaController::class);
    Route::post('ppid_dokumen_wajib', [\App\Http\Controllers\Admin\PpidDokumenWajibController::class, 'store'])->name('ppid_dokumen_wajib.store');
    Route::delete('ppid_dokumen_wajib/{id}', [\App\Http\Controllers\Admin\PpidDokumenWajibController::class, 'destroy'])->name('ppid_dokumen_wajib.destroy');
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
Route::get('/profil/ppid/strukturorganisasi', [App\Http\Controllers\HomeController::class, 'strukturPpid'])->name('public.profil_ppid_strukturorganisasi');
Route::get('/profil/ppid/dasarhukum', [PublicDokumenController::class, 'dasarHukum'])->name('public.profil_ppid_dasarhukum');
Route::get('/profil/ppid/sop', [PublicDokumenController::class, 'sop'])->name('public.profil_ppid_sop');
Route::view('/profil/ppid/maklumatpelayanan', 'public.profil.ppid.maklumatpelayanan')->name('public.profil_ppid_maklumatpelayanan');
Route::get(
    '/profil/ppid/alurpelayanan',
    [PublicDokumenController::class, 'alurPelayanan']
)->name('public.profil_ppid_alurpelayanan');
Route::get(
    '/profil/ppid/laporan',
    [PublicDokumenController::class, 'laporanPpid']
)->name('public.profil_ppid_laporan');
Route::get('/profil/pejabat/bupati', [\App\Http\Controllers\PublicPejabatController::class, 'index'])->defaults('kategori', 'bupati')->name('public.profil_pejabat_bupati');
Route::get('/profil/pejabat/wakilbupati', [\App\Http\Controllers\PublicPejabatController::class, 'index'])->defaults('kategori', 'wakilbupati')->name('public.profil_pejabat_wakilbupati');
Route::get('/profil/pejabat/{kategori}', [\App\Http\Controllers\PublicPejabatController::class, 'index'])->name('public.profil_pejabat');
Route::get('/dip/berkala', [\App\Http\Controllers\PublicDipController::class, 'berkala'])->name('public.dip_berkala');
Route::get('/dip/setiapsaat', [\App\Http\Controllers\PublicDipController::class, 'setiapsaat'])->name('public.dip_setiapsaat');
Route::get('/dip/sertamerta', [\App\Http\Controllers\PublicDipController::class, 'sertamerta'])->name('public.dip_sertamerta');
Route::get('/dip/dikecualikan', [\App\Http\Controllers\PublicDipController::class, 'dikecualikan'])->name('public.dip_dikecualikan');
Route::get('/layanan/berita', [\App\Http\Controllers\PublicBeritaController::class, 'index'])->name('public.layanan_berita');
Route::get('/layanan/berita/{slug}', [\App\Http\Controllers\PublicBeritaController::class, 'show'])->name('public.layanan_berita_show');
Route::get('/layanan/regulasi', [\App\Http\Controllers\PublicRegulasiController::class, 'index'])->name('public.layanan_regulasi');
Route::get('/layanan/lhkpn', [PublicDokumenController::class, 'lhkpn'])->name('public.lhkpn');
Route::get('/layanan/permohonan-informasi', [\App\Http\Controllers\PermohonanController::class, 'layananInformasi'])->name('public.layanan_permohonan_informasi');
Route::view('/layanan/formulir-keberatan', 'public.layanan.formulir-keberatan')->name('public.layanan_formulir_keberatan');
Route::get('/layanan/agenda', [\App\Http\Controllers\PublicAgendaController::class, 'index'])->name('public.layanan_agenda');
Route::view('/transparansi-pemkab', 'public.transparansi-pemkab')->name('public.transparansi_pemkab');

// Single Data Routes (Inspektorat, Setwan)
Route::get('/ppidpelaksana/inspektorat', [\App\Http\Controllers\PublicPpidPelaksanaController::class, 'showSingle'])->defaults('type', 'inspektorat')->name('public.ppidpelaksana_inspektorat');
Route::get('/ppidpelaksana/setwan', [\App\Http\Controllers\PublicPpidPelaksanaController::class, 'showSingle'])->defaults('type', 'setwan')->name('public.ppidpelaksana_setwan');

// Detail Data Route
Route::get('/ppidpelaksana/detail/{id}', [\App\Http\Controllers\PublicPpidPelaksanaController::class, 'show'])->name('public.ppidpelaksana.show');

// Jamak Data Routes
Route::get('/ppidpelaksana/{kategori}', [\App\Http\Controllers\PublicPpidPelaksanaController::class, 'index'])
    ->where('kategori', 'badan|bagian|dinas|kecamatan|kelurahan|rsud|puskesmas|bumd')
    ->name('public.ppidpelaksana.index');

