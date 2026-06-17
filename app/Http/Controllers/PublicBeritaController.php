<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class PublicBeritaController extends Controller
{
    public function index()
    {
        // Tampilkan semua berita dengan paginasi (contoh 6 berita per halaman)
        $beritas = Berita::latest()->paginate(6);
        return view('public.layanan.berita', compact('beritas'));
    }

    public function show($slug)
    {
        // Cari berita berdasarkan slug, atau munculkan error 404 jika tidak ditemukan
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        // Ambil berita terbaru lainnya untuk rekomendasi di bagian bawah (opsional)
        $beritaLain = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();
        
        return view('public.layanan.berita_show', compact('berita', 'beritaLain'));
    }
}
