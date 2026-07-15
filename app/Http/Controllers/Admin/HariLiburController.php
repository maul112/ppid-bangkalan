<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HariLibur;
use Illuminate\Http\Request;

class HariLiburController extends Controller
{
    public function index(Request $request)
    {
        $query = HariLibur::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('keterangan', 'like', "%{$search}%")
                  ->orWhere('tanggal', 'like', "%{$search}%");
        }

        $hariLiburs = $query->orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.hari_libur.index', compact('hariLiburs'));
    }

    public function create()
    {
        return view('admin.hari_libur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:hari_liburs',
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.unique' => 'Tanggal ini sudah terdaftar sebagai hari libur.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        HariLibur::create($request->all());

        return redirect()->route('admin.hari-libur.index')->with('success', 'Hari libur berhasil ditambahkan.');
    }

    public function edit(HariLibur $hariLibur)
    {
        return view('admin.hari_libur.edit', compact('hariLibur'));
    }

    public function update(Request $request, HariLibur $hariLibur)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:hari_liburs,tanggal,'.$hariLibur->id,
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.unique' => 'Tanggal ini sudah terdaftar sebagai hari libur.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        $hariLibur->update($request->all());

        return redirect()->route('admin.hari-libur.index')->with('success', 'Hari libur berhasil diperbarui.');
    }

    public function destroy(HariLibur $hariLibur)
    {
        $hariLibur->delete();

        return redirect()->route('admin.hari-libur.index')->with('success', 'Hari libur berhasil dihapus.');
    }
}
