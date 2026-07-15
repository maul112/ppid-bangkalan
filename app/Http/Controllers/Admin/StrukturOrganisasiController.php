<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $struktur = StrukturOrganisasi::first();
        return view('admin.struktur-organisasi.index', compact('struktur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $struktur = StrukturOrganisasi::first();
        
        if ($struktur) {
            return redirect()->route('admin.struktur-organisasi.index')->with('error', 'Struktur organisasi sudah ada, gunakan fitur edit.');
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/struktur'), $filename);

            StrukturOrganisasi::create([
                'gambar' => $filename,
            ]);
        }

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Gambar struktur organisasi berhasil diunggah.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $struktur = StrukturOrganisasi::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Delete old file
            if ($struktur->gambar && File::exists(public_path('uploads/struktur/' . $struktur->gambar))) {
                File::delete(public_path('uploads/struktur/' . $struktur->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/struktur'), $filename);

            $struktur->update([
                'gambar' => $filename,
            ]);
        }

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Gambar struktur organisasi berhasil diperbarui.');
    }
}
