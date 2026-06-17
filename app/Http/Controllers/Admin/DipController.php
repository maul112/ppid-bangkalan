<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dip;
use Illuminate\Http\Request;

class DipController extends Controller
{
    public function index() {
        $dips = Dip::latest()->paginate(10);
        return view('admin.dip.index', compact('dips'));
    }

    public function create() {
        return view('admin.dip.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'file_pdf' => 'mimes:pdf|max:5120' // Maksimal 5MB
        ]);

        $nama_file = null;
        if($request->hasFile('file_pdf')) {
            $nama_file = time().'_'.$request->file_pdf->getClientOriginalName();
            $request->file_pdf->move(public_path('uploads/dip'), $nama_file);
        }

        Dip::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file_pdf' => $nama_file
        ]);

        return redirect()->route('admin.dip.index')->with('success', 'DIP Berhasil ditambahkan!');
    }

    public function edit(Dip $dip) {
        return view('admin.dip.edit', compact('dip'));
    }

    public function update(Request $request, Dip $dip) {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'file_pdf' => 'mimes:pdf|max:5120'
        ]);

        $nama_file = $dip->file_pdf;
        if($request->hasFile('file_pdf')) {
            if ($dip->file_pdf && file_exists(public_path('uploads/dip/' . $dip->file_pdf))) {
                unlink(public_path('uploads/dip/' . $dip->file_pdf));
            }
            $nama_file = time().'_'.$request->file_pdf->getClientOriginalName();
            $request->file_pdf->move(public_path('uploads/dip'), $nama_file);
        }

        $dip->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file_pdf' => $nama_file
        ]);

        return redirect()->route('admin.dip.index')->with('success', 'DIP Berhasil diperbarui!');
    }

    public function destroy(Dip $dip) {
        if ($dip->file_pdf && file_exists(public_path('uploads/dip/' . $dip->file_pdf))) {
            unlink(public_path('uploads/dip/' . $dip->file_pdf));
        }
        $dip->delete();
        return back()->with('success', 'DIP berhasil dihapus!');
    }
}