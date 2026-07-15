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

        $today = now();
        $isLibur = $today->isWeekend() || \App\Models\HariLibur::whereDate('tanggal', $today->format('Y-m-d'))->exists();

        return view('opd.permohonan.show', compact('permohonan', 'pivot', 'isLibur'));
    }

    public function tanggapi(Request $request, Permohonan $permohonan)
    {
        $opdId = Auth::user()->opd_id;

        $pivot = $permohonan->opds()->where('opd_id', $opdId)->first();
        if (!$pivot) {
            abort(403, 'Akses ditolak.');
        }

        $today = now();
        $isLibur = $today->isWeekend() || \App\Models\HariLibur::whereDate('tanggal', $today->format('Y-m-d'))->exists();

        if ($isLibur) {
            return back()->with('error', 'Maaf, tidak dapat memberikan tanggapan pada hari libur atau akhir pekan.');
        }

        $request->validate([
            'tanggapan'      => 'required|string',
            'file_tanggapan' => 'nullable|file|max:10240', // Max 10MB
            'link_tanggapan' => 'nullable|string|url',
        ], [
            'link_tanggapan.url' => 'Format link tanggapan tidak valid. Pastikan menggunakan http:// atau https://.',
        ]);

        $nama_file_tanggapan = $pivot->file_tanggapan;
        if ($request->hasFile('file_tanggapan')) {
            $file_tanggapan = $request->file('file_tanggapan');
            $nama_file_tanggapan = 'TANGGAPAN-OPD-' . time() . '-' . \Illuminate\Support\Str::random(5) . '.' . $file_tanggapan->getClientOriginalExtension();
            $tujuan_upload_tanggapan = public_path('uploads/permohonan/tanggapan_opd');
            if (!\Illuminate\Support\Facades\File::exists($tujuan_upload_tanggapan)) { \Illuminate\Support\Facades\File::makeDirectory($tujuan_upload_tanggapan, 0755, true); }
            $file_tanggapan->move($tujuan_upload_tanggapan, $nama_file_tanggapan);
        }

        // Update data di pivot table untuk OPD ini saja
        $permohonan->opds()->updateExistingPivot($opdId, [
            'tanggapan'      => $request->tanggapan,
            'status'         => 'ditanggapi',
            'tanggapi_at'    => now(),
            'file_tanggapan' => $nama_file_tanggapan,
            'link_tanggapan' => $request->link_tanggapan,
        ]);

        // Cek apakah semua OPD sudah menanggapi, jika ya beri tahu PPID
        // (Status tidak otomatis selesai, PPID yang akan menyelesaikannya)

        return redirect()->route('admin.opd.permohonan.index')
                         ->with('success', 'Tanggapan berhasil dikirim!');
    }
}
