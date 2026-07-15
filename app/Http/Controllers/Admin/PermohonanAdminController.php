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
        $permohonans = Permohonan::with(['user', 'opds'])
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
        $permohonan->load(['user', 'opds']);
        $opds = \App\Models\Opd::orderBy('nama_opd')->get();
        return view('admin.permohonan.show', compact('permohonan', 'opds'));
    }

    public function updateStatus(Request $request, Permohonan $permohonan)
    {
        $request->validate([
            'status'         => 'required|in:pending,diverifikasi,selesai,ditolak',
            'tanggapan'      => 'required_if:status,selesai|required_if:status,ditolak|nullable|string',
        ], [
            'tanggapan.required_if' => 'Kolom tanggapan wajib diisi ketika status adalah Selesai atau Ditolak.',
        ]);

        if ($request->status === 'selesai') {
            $hasOpd = $permohonan->opds()->count() > 0;
            if ($hasOpd) {
                $unansweredOpds = $permohonan->opds()->wherePivot('status', '!=', 'ditanggapi')->count();
                if ($unansweredOpds > 0) {
                    return redirect()->back()->with('error', 'Tidak dapat menyelesaikan permohonan. Masih ada OPD yang belum memberikan tanggapan.');
                }
            }
        }

        $permohonan->update([
            'status'         => $request->status,
            'tanggapan'      => $request->tanggapan,
        ]);

        return redirect()->route('admin.permohonan.index')->with('success', 'Status permohonan berhasil diperbarui menjadi "' . strtoupper($request->status) . '"!');
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
            'opd_ids'   => 'nullable|array',
            'opd_ids.*' => 'exists:opds,id',
        ]);

        $submittedIds = collect($request->opd_ids ?? [])->map(fn($id) => (int)$id);
        $existingIds  = $permohonan->opds->pluck('id');

        // 1. Hapus OPD yang sebelumnya dicentang tapi sekarang tidak dicentang
        $toDetach = $existingIds->diff($submittedIds);
        if ($toDetach->isNotEmpty()) {
            $permohonan->opds()->detach($toDetach->toArray());
        }

        // 2. Tambahkan OPD baru yang belum ada di pivot
        $toAttach = $submittedIds->diff($existingIds);
        if ($toAttach->isNotEmpty()) {
            $pivotData = [];
            foreach ($toAttach as $opdId) {
                $pivotData[$opdId] = [
                    'status'       => 'menunggu',
                    'disposisi_at' => now(),
                ];
            }
            $permohonan->opds()->syncWithoutDetaching($pivotData);
        }

        // 3. Sinkronkan status permohonan
        $totalOpd = $submittedIds->count();
        if ($totalOpd === 0) {
            // Tidak ada OPD — kembalikan ke pending
            $permohonan->update(['status' => 'pending']);
            return redirect()->back()->with('success', 'Semua OPD telah dihapus, permohonan dikembalikan ke pending.');
        } elseif ($permohonan->status === 'pending') {
            $permohonan->update(['status' => 'diverifikasi']);
        }

        $pesanDetach = $toDetach->isNotEmpty() ? ', ' . $toDetach->count() . ' OPD dihapus' : '';
        $pesanAttach = $toAttach->isNotEmpty() ? $toAttach->count() . ' OPD baru ditambahkan' : 'Tidak ada OPD baru';

        return redirect()->back()->with('success', $pesanAttach . $pesanDetach . '. Total ' . $totalOpd . ' OPD aktif.');
    }

    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();

        return redirect()->route('admin.permohonan.index')
                         ->with('success', 'Permohonan berhasil dihapus!');
    }
}