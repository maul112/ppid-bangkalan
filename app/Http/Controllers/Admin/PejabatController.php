<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pejabat;
use Illuminate\Support\Facades\Storage;

class PejabatController extends Controller
{
    public function index(Request $request)
    {
        $query = Pejabat::query();
        $search = $request->input('search');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_pejabat', $request->kategori);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        $pejabats = $query->orderBy('kategori_pejabat')->orderBy('id')->paginate(10);
        return view('admin.pejabat.index', compact('pejabats'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_pejabat' => 'required',
            'nama' => 'required',
            'jabatan_keterangan' => 'required',
            'instansi' => 'nullable|string',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'golongan' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'riwayat_pendidikan' => 'nullable|string',
            'riwayat_karir' => 'nullable|string',
            'penghargaan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pejabat_fotos', 'public');
        }

        $pejabat = Pejabat::create($validated);

        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil ditambahkan.');
    }

    public function edit(Pejabat $pejabat)
    {
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, Pejabat $pejabat)
    {
        $validated = $request->validate([
            'kategori_pejabat' => 'required',
            'nama' => 'required',
            'jabatan_keterangan' => 'required',
            'instansi' => 'nullable|string',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'golongan' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'riwayat_pendidikan' => 'nullable|string',
            'riwayat_karir' => 'nullable|string',
            'penghargaan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto')) {
            if ($pejabat->foto && Storage::disk('public')->exists($pejabat->foto)) {
                Storage::disk('public')->delete($pejabat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pejabat_fotos', 'public');
        }

        $pejabat->update($validated);

        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil diperbarui.');
    }

    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->foto && Storage::disk('public')->exists($pejabat->foto)) {
            Storage::disk('public')->delete($pejabat->foto);
        }
        $pejabat->delete();

        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil dihapus.');
    }
}
