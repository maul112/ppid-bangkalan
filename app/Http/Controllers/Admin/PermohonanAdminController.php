<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanAdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari input 'search'
        $search = $request->query('search');

        // 2. Query data dengan filter pencarian jika ada
        $permohonans = Permohonan::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama_pemohon', 'like', "%{$search}%")
                             ->orWhere('nomor_tiket', 'like', "%{$search}%")
                             ->orWhere('nik', 'like', "%{$search}%");
            })
            ->latest()
            // 3. Gunakan paginate() agar fungsi ->links() di view bekerja
            ->paginate(10); 

        $opds = \App\Models\Opd::all();
        return view('admin.permohonan.index', compact('permohonans', 'opds'));
    }

    public function show(Permohonan $permohonan)
    {
        $opds = \App\Models\Opd::all();
        return view('admin.permohonan.show', compact('permohonan', 'opds'));
    }

    public function updateStatus(Request $request, Permohonan $permohonan)
    {
        $request->validate([
            'status' => 'required',
            'tanggapan' => 'required_if:status,selesai'
        ]);

        $permohonan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui!');
    }

    public function disposisi(Request $request, Permohonan $permohonan)
    {
        // Pencegahan Disposisi di Hari Libur / Akhir Pekan
        $today = \Carbon\Carbon::now();
        
        if ($today->isWeekend()) {
            return redirect()->back()->with('error', 'Gagal! Tidak dapat melakukan disposisi pada akhir pekan (Sabtu/Minggu).');
        }

        $isHariLibur = \App\Models\HariLibur::whereDate('tanggal', $today->format('Y-m-d'))->exists();
        if ($isHariLibur) {
            return redirect()->back()->with('error', 'Gagal! Tidak dapat melakukan disposisi pada tanggal merah atau hari libur nasional.');
        }

        $request->validate([
            'opd_id' => 'required|exists:opds,id',
        ]);

        $permohonan->update([
            'opd_id' => $request->opd_id,
            'disposisi_at' => now(),
            'status' => 'diverifikasi',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil didisposisikan ke OPD terkait!');
    }
    public function destroy(Permohonan $permohonan)
{
    // Hapus data permohonan
    $permohonan->delete();

    return redirect()->route('admin.permohonan.index')
                     ->with('success', 'Permohonan berhasil dihapus!');
}
}