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

        // Query via pivot table: tampilkan permohonan yang memiliki OPD ini di pivot
        $permohonans = Permohonan::with(['user', 'opds'])
            ->whereHas('opds', function ($q) use ($opdId) {
                $q->where('opd_id', $opdId);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
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
        $opdId = Auth::user()->opd_id;

        // Pastikan OPD ini memang ada di pivot
        $pivot = $permohonan->opds()->where('opd_id', $opdId)->first();
        if (!$pivot) {
            abort(403, 'Akses ditolak.');
        }

        return view('opd.permohonan.show', compact('permohonan', 'pivot'));
    }

    public function tanggapi(Request $request, Permohonan $permohonan)
    {
        $opdId = Auth::user()->opd_id;

        $pivot = $permohonan->opds()->where('opd_id', $opdId)->first();
        if (!$pivot) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        // Update data di pivot table untuk OPD ini saja
        $permohonan->opds()->updateExistingPivot($opdId, [
            'tanggapan'   => $request->tanggapan,
            'status'      => 'ditanggapi',
            'tanggapi_at' => now(),
        ]);

        // Cek apakah semua OPD sudah menanggapi, jika ya set permohonan jadi selesai
        $belumDitanggapi = $permohonan->opds()
            ->wherePivot('status', 'menunggu')
            ->count();

        if ($belumDitanggapi === 0) {
            $permohonan->update(['status' => 'selesai']);
        }

        return redirect()->route('admin.opd.permohonan.index')
                         ->with('success', 'Tanggapan berhasil dikirim!');
    }
}
