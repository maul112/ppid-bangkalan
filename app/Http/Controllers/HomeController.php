<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Dip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $beritas = Berita::latest()->take(3)->get(); 
        $total_dokumen = \App\Models\Dokumen::count();
        return view('welcome', compact('banners', 'beritas', 'total_dokumen'));
    }

    public function struktur() {
        $struktur = \App\Models\StrukturOrganisasi::first();
        return view('profil.struktur-organisasi', compact('struktur'));
    }

    public function strukturPpid() {
        $struktur = \App\Models\StrukturOrganisasi::first();
        return view('public.profil.ppid.strukturorganisasi', compact('struktur'));
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