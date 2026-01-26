<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Regulasi;
use App\Models\Dip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $beritas = Berita::latest()->take(3)->get(); 
        $regulasis = Regulasi::latest()->take(5)->get();
        // 4. Ambil data DIP (Daftar Informasi Publik)
        // Jika hanya ingin menampilkan beberapa, gunakan take(). Jika semua, gunakan all()
        $dips = Dip::latest()->take(5)->get(); 

        return view('welcome', compact('banners', 'beritas', 'regulasis', 'dips'));
    }

    public function struktur() {
        return view('profil.struktur-organisasi');
    }

    public function tentang()
    {
        return view('profil.tentang-ppid');
    }

    public function tugasFungsi()
    {
        return view('profil.tugas-fungsi');
    }

    public function visiMisi()
    {
        return view('profil.visi-misi');
    }

    public function dasarHukum()
    {
        return view('profil.dasar-hukum');
    }

    public function sop()
    {
        return view('profil.sop');
    }

    public function maklumatPelayanan()
    {
        return view('profil.maklumat-pelayanan');
    }

    public function alurPelayanan()
    {
        return view('profil.alur-pelayanan');
    }

    public function laporanPelayanan()
    {
        return view('profil.laporan-pelayanan');
    }
}