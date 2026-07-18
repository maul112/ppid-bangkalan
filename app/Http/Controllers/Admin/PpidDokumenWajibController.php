<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidDokumenWajib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpidDokumenWajibController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ppid_pelaksana_id' => 'required|exists:ppid_pelaksanas,id',
            'kategori_dokumen' => 'required|string',
            'tahun' => 'required|integer',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $request->file('file')->store('dokumen_wajib', 'public');

        PpidDokumenWajib::create([
            'ppid_pelaksana_id' => $request->ppid_pelaksana_id,
            'kategori_dokumen' => $request->kategori_dokumen,
            'tahun' => $request->tahun,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Dokumen Wajib berhasil diunggah.');
    }

    public function destroy($id)
    {
        $dokumen = PpidDokumenWajib::findOrFail($id);
        
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }
        
        $dokumen->delete();
        
        return back()->with('success', 'Dokumen Wajib berhasil dihapus.');
    }
}
