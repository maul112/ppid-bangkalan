<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori');

        $query = Dokumen::with('opd')->latest();
        $search = $request->input('search');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $dokumens = $query->paginate(10)->appends(['kategori' => $kategori, 'search' => $search]);

        return view('admin.dokumen.index', compact('dokumens', 'kategori'));
    }

    public function create()
    {
        $opds = Opd::orderBy('nama_opd')->get();

        return view('admin.dokumen.create', compact('opds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:SOP,Dasar Hukum,Alur Pelayanan,Laporan PPID',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'opd_id' => 'required|exists:opds,id',
            'file' => 'required|mimes:pdf|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('dokumens', 'public');

        Dokumen::create([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'tahun' => $request->tahun,
            'opd_id' => $request->opd_id,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Dokumen $dokumen)
    {
        $opds = Opd::orderBy('nama_opd')->get();

        return view('admin.dokumen.edit', compact('dokumen', 'opds'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'kategori' => 'required|in:SOP,Dasar Hukum,Alur Pelayanan,Laporan PPID,LHKPN',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'opd_id' => 'required|exists:opds,id',
            'file' => 'nullable|mimes:pdf|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $data = [
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'opd_id' => $request->opd_id,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file')) {

            if (
                $dokumen->file_path &&
                Storage::disk('public')->exists($dokumen->file_path)
            ) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');

            $data['file_path'] = $file->store('dokumens', 'public');
            $data['file_size'] = $file->getSize();
        }

        if ($dokumen->judul !== $request->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
        }

        $dokumen->update($data);

        return redirect()
            ->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        if (
            $dokumen->file_path &&
            Storage::disk('public')->exists($dokumen->file_path)
        ) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()
            ->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}