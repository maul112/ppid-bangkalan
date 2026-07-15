<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::orderBy('tanggal', 'desc');
        $search = $request->input('search');

        if ($request->has('status') && $request->status != '') {
            $today = \Carbon\Carbon::today();
            if ($request->status == 'Hari Ini') {
                $query->whereDate('tanggal', '=', $today);
            } elseif ($request->status == 'Mendatang') {
                $query->whereDate('tanggal', '>', $today);
            } elseif ($request->status == 'Lewat') {
                $query->whereDate('tanggal', '<', $today);
            }
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('uraian', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $agendas = $query->paginate(10);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'uraian' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'peserta' => 'nullable|string|max:255',
            'jumlah_peserta' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'dibuat_oleh' => 'required|string|max:255',
        ]);

        Agenda::create($validated);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'uraian' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'peserta' => 'nullable|string|max:255',
            'jumlah_peserta' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'dibuat_oleh' => 'required|string|max:255',
        ]);

        $agenda->update($validated);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
