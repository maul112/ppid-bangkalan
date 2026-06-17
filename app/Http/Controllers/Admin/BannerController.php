<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index() {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    public function create() {
        return view('admin.banner.create');
    }

    public function store(Request $request) {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $nama_gambar = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('uploads/banner'), $nama_gambar);

        Banner::create([
            'judul' => $request->judul,
            'gambar' => $nama_gambar,
        ]);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    public function destroy(Banner $banner) {
        if (file_exists(public_path('uploads/banner/' . $banner->gambar))) {
            unlink(public_path('uploads/banner/' . $banner->gambar));
        }
        $banner->delete();
        return back()->with('success', 'Banner dihapus!');
    }
}