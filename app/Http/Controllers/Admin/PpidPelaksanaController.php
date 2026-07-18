<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidPelaksana;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PpidPelaksanaController extends Controller
{
    public function index(Request $request)
    {
        $query = PpidPelaksana::with('pejabat');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('pejabat', function($q2) use ($search) {
                    $q2->where('instansi', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%");
                })->orWhere('kategori', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }
        
        $ppidPelaksanas = $query->paginate(10);
        return view('admin.ppid_pelaksana.index', compact('ppidPelaksanas'));
    }

    public function create()
    {
        $excludedCategories = ['Bupati', 'Wakil Bupati', 'Sekda', 'Asisten', 'Staf Ahli'];
        $pejabats = Pejabat::whereNotIn('kategori_pejabat', $excludedCategories)->get();
        $kategoriList = ['Badan', 'Bagian', 'Inspektorat', 'Sekretariat DPRD', 'Dinas', 'Camat', 'Lurah', 'Direktur RSUD', 'Kepala Puskesmas', 'Direktur'];
        return view('admin.ppid_pelaksana.create', compact('pejabats', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'pejabat_id' => 'nullable|exists:pejabats,id',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'map_url' => ['nullable', 'url', function ($attribute, $value, $fail) {
                if (!str_starts_with($value, 'https://www.google.com/maps/') && !str_starts_with($value, 'https://google.com/maps/')) {
                    $fail('Tautan lokasi harus berupa link langsung dari Address Bar Google Maps (https://www.google.com/maps/...). Jangan gunakan link pendek (goo.gl).');
                }
            }],
            'sosmed_facebook' => 'nullable|url',
            'sosmed_instagram' => 'nullable|url',
            'sosmed_youtube' => 'nullable|url',
            'sosmed_tiktok' => 'nullable|url',
        ]);

        PpidPelaksana::create($validated);
        return redirect()->route('admin.ppid_pelaksana.index')->with('success', 'Data PPID Pelaksana berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ppidPelaksana = PpidPelaksana::with('dokumenWajib')->findOrFail($id);
        $excludedCategories = ['Bupati', 'Wakil Bupati', 'Sekda', 'Asisten', 'Staf Ahli'];
        $pejabats = Pejabat::whereNotIn('kategori_pejabat', $excludedCategories)->get();
        $kategoriList = ['Badan', 'Bagian', 'Inspektorat', 'Sekretariat DPRD', 'Dinas', 'Camat', 'Lurah', 'Direktur RSUD', 'Kepala Puskesmas', 'Direktur'];
        return view('admin.ppid_pelaksana.edit', compact('ppidPelaksana', 'pejabats', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $ppidPelaksana = PpidPelaksana::findOrFail($id);
        $validated = $request->validate([
            'kategori' => 'required|string',
            'pejabat_id' => 'nullable|exists:pejabats,id',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'map_url' => ['nullable', 'url', function ($attribute, $value, $fail) {
                if (!str_starts_with($value, 'https://www.google.com/maps/') && !str_starts_with($value, 'https://google.com/maps/')) {
                    $fail('Tautan lokasi harus berupa link langsung dari Address Bar Google Maps (https://www.google.com/maps/...). Jangan gunakan link pendek (goo.gl).');
                }
            }],
            'sosmed_facebook' => 'nullable|url',
            'sosmed_instagram' => 'nullable|url',
            'sosmed_youtube' => 'nullable|url',
            'sosmed_tiktok' => 'nullable|url',
        ]);

        $ppidPelaksana->update($validated);
        return redirect()->route('admin.ppid_pelaksana.edit', $ppidPelaksana->id)->with('success', 'Data PPID Pelaksana berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ppidPelaksana = PpidPelaksana::findOrFail($id);
        $ppidPelaksana->delete();
        return redirect()->route('admin.ppid_pelaksana.index')->with('success', 'Data PPID Pelaksana berhasil dihapus');
    }
}
