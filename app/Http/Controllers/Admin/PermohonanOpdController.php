<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanOpdController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $opdId = Auth::user()->opd_id;

        $permohonans = Permohonan::with('user')
            ->where('opd_id', $opdId)
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama_pemohon', 'like', "%{$search}%")
                      ->orWhere('nomor_tiket', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10); 

        return view('opd.permohonan.index', compact('permohonans'));
    }

    public function show(Permohonan $permohonan)
    {
        // Pastikan hanya admin OPD yang bersangkutan yang bisa melihat
        if ($permohonan->opd_id != Auth::user()->opd_id) {
            abort(403, 'Akses ditolak.');
        }

        return view('opd.permohonan.show', compact('permohonan'));
    }

    public function tanggapi(Request $request, Permohonan $permohonan)
    {
        if ($permohonan->opd_id != Auth::user()->opd_id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $permohonan->update([
            'tanggapan' => $request->tanggapan,
            'status' => 'selesai', // Otomatis selesai setelah ditanggapi OPD
        ]);

        return redirect()->route('admin.opd.permohonan.index')
                         ->with('success', 'Tanggapan berhasil dikirim dan permohonan diselesaikan!');
    }
}
