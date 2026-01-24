<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Regulasi;
use App\Models\Dip; // Tambahkan ini agar bisa memanggil model DIP
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil semua banner untuk slider
        $banners = Banner::all();
        
        // 2. Ambil 3 berita terbaru
        $beritas = Berita::latest()->take(3)->get(); 
        
        // 3. Ambil 5 regulasi terbaru
        $regulasis = Regulasi::latest()->take(5)->get();
        
        // 4. Ambil data DIP (Daftar Informasi Publik)
        // Jika hanya ingin menampilkan beberapa, gunakan take(). Jika semua, gunakan all()
        $dips = Dip::latest()->take(5)->get(); 

        // Pastikan 'dips' dimasukkan ke dalam compact
        return view('welcome', compact('banners', 'beritas', 'regulasis', 'dips'));
    }
}