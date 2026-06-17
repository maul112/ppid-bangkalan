<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Gunakan Facade File agar lebih rapi

class BeritaController extends Controller
{
    public function index()
    {
        // Menggunakan latest() agar berita terbaru muncul di atas
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            // jika error mau bahasa indonesia
            // 'judul.required' => 'Judul berita harus diisi.',
        ]);

        $nama_gambar = null;
        if($request->hasFile('gambar')) {
            $nama_gambar = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('uploads/berita'), $nama_gambar);
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $nama_gambar
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $nama_gambar = $berita->gambar;
        if($request->hasFile('gambar')) {
            $path = public_path('uploads/berita/' . $berita->gambar);
            if ($berita->gambar && File::exists($path)) {
                File::delete($path);
            }
            $nama_gambar = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('uploads/berita'), $nama_gambar);
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $nama_gambar
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Perbaikan pada fungsi Destroy
     * Menggunakan ID secara langsung untuk memastikan data ditemukan dan dihapus
     */
    public function destroy($id)
    {
        // 1. Cari data berdasarkan ID, jika tidak ada akan error 404 (lebih aman)
        $berita = Berita::findOrFail($id);

        // 2. Hapus file gambar dari folder public jika ada
        $path = public_path('uploads/berita/' . $berita->gambar);
        if ($berita->gambar && File::exists($path)) {
            File::delete($path);
        }

        // 3. Hapus data dari database
        $berita->delete();

        // 4. Redirect kembali dengan prefix 'admin.'
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}