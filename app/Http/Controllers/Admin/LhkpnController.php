<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PejabatLhkpn;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LhkpnController extends Controller
{
    public function index()
    {
        $lhkpns = PejabatLhkpn::with('pejabat')->latest()->paginate(10);
        return view('admin.lhkpn.index', compact('lhkpns'));
    }

    public function create()
    {
        $pejabats = Pejabat::orderBy('nama')->get();
        return view('admin.lhkpn.create', compact('pejabats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pejabat_id' => 'required|exists:pejabats,id',
            'tahun' => 'required|digits:4|integer',
            'file_pdf' => 'required|mimes:pdf|max:5120'
        ]);

        $file = $request->file('file_pdf');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/lhkpn'), $fileName);

        PejabatLhkpn::create([
            'pejabat_id' => $request->pejabat_id,
            'tahun' => $request->tahun,
            'file_path' => $fileName
        ]);

        return redirect()->route('admin.lhkpn.index')->with('success', 'LHKPN berhasil ditambahkan.');
    }

    public function edit(PejabatLhkpn $lhkpn)
    {
        $pejabats = Pejabat::orderBy('nama')->get();
        return view('admin.lhkpn.edit', compact('lhkpn', 'pejabats'));
    }

    public function update(Request $request, PejabatLhkpn $lhkpn)
    {
        $request->validate([
            'pejabat_id' => 'required|exists:pejabats,id',
            'tahun' => 'required|digits:4|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:5120'
        ]);

        $data = [
            'pejabat_id' => $request->pejabat_id,
            'tahun' => $request->tahun
        ];

        if ($request->hasFile('file_pdf')) {
            if ($lhkpn->file_path && file_exists(public_path('uploads/lhkpn/' . $lhkpn->file_path))) {
                unlink(public_path('uploads/lhkpn/' . $lhkpn->file_path));
            }
            $file = $request->file('file_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/lhkpn'), $fileName);
            $data['file_path'] = $fileName;
        }

        $lhkpn->update($data);

        return redirect()->route('admin.lhkpn.index')->with('success', 'LHKPN berhasil diperbarui.');
    }

    public function destroy(PejabatLhkpn $lhkpn)
    {
        if ($lhkpn->file_path && file_exists(public_path('uploads/lhkpn/' . $lhkpn->file_path))) {
            unlink(public_path('uploads/lhkpn/' . $lhkpn->file_path));
        }
        $lhkpn->delete();

        return redirect()->route('admin.lhkpn.index')->with('success', 'LHKPN berhasil dihapus.');
    }
}
