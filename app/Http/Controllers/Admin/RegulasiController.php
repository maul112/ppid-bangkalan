<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    public function index() {
        $regulasis = Regulasi::latest()->get();
        return view('admin.regulasi.index', compact('regulasis'));
    }

    public function create() {
        return view('admin.regulasi.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'nomor' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:5120'
        ]);

        $nama_file = time().'_regulasi.'.$request->file_pdf->extension();  
        $request->file_pdf->move(public_path('uploads/regulasi'), $nama_file);

        Regulasi::create([
            'judul' => $request->judul,
            'nomor' => $request->nomor,
            'file_pdf' => $nama_file,
        ]);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil ditambahkan!');
    }

    public function destroy(Regulasi $regulasi) {
        if (file_exists(public_path('uploads/regulasi/' . $regulasi->file_pdf))) {
            unlink(public_path('uploads/regulasi/' . $regulasi->file_pdf));
        }
        $regulasi->delete();
        return back()->with('success', 'Regulasi berhasil dihapus!');
    }
}