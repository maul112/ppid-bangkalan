<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    public function index() {
        $regulasis = Regulasi::latest()->paginate(10);
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

    public function edit(Regulasi $regulasi) {
        return view('admin.regulasi.edit', compact('regulasi'));
    }

    public function update(Request $request, Regulasi $regulasi) {
        $request->validate([
            'judul' => 'required',
            'nomor' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:5120'
        ]);

        $data = [
            'judul' => $request->judul,
            'nomor' => $request->nomor,
        ];

        if ($request->hasFile('file_pdf')) {
            // Hapus file lama
            if (file_exists(public_path('uploads/regulasi/' . $regulasi->file_pdf))) {
                unlink(public_path('uploads/regulasi/' . $regulasi->file_pdf));
            }
            $nama_file = time().'_regulasi.'.$request->file_pdf->extension();  
            $request->file_pdf->move(public_path('uploads/regulasi'), $nama_file);
            $data['file_pdf'] = $nama_file;
        }

        $regulasi->update($data);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil diperbarui!');
    }

    public function destroy(Regulasi $regulasi) {
        if (file_exists(public_path('uploads/regulasi/' . $regulasi->file_pdf))) {
            unlink(public_path('uploads/regulasi/' . $regulasi->file_pdf));
        }
        $regulasi->delete();
        return back()->with('success', 'Regulasi berhasil dihapus!');
    }
}