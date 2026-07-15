<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;

class PublicDokumenController extends Controller
{
    public function sop()
    {
        $dokumens = Dokumen::where('kategori', 'SOP')
            ->latest()
            ->paginate(10);

        $kategoriTitle = 'Standar Operasional Prosedur (SOP)';

        return view('public.dokumen.index', compact('dokumens', 'kategoriTitle'));
    }

    public function dasarHukum()
    {
        $dokumens = Dokumen::where('kategori', 'Dasar Hukum')
            ->latest()
            ->paginate(10);

        $kategoriTitle = 'Dasar Hukum';

        return view('public.dokumen.index', compact('dokumens', 'kategoriTitle'));
    }

    public function alurPelayanan()
    {
        $dokumens = Dokumen::where('kategori', 'Alur Pelayanan')
            ->latest()
            ->paginate(10);

        $kategoriTitle = 'Alur Pelayanan';

        return view('public.dokumen.index', compact('dokumens', 'kategoriTitle'));
    }

    public function laporanPpid()
    {
        $dokumens = Dokumen::where('kategori', 'Laporan PPID')
            ->latest()
            ->paginate(10);

        $kategoriTitle = 'Laporan PPID';

        return view('public.dokumen.index', compact('dokumens', 'kategoriTitle'));
    }

    public function lhkpn()
    {
        $lhkpns = \App\Models\PejabatLhkpn::with('pejabat')
            ->latest('tahun')
            ->paginate(10);

        return view('public.dokumen.lhkpn', compact('lhkpns'));
    }

    public function show($slug)
    {
        $dokumen = Dokumen::where('slug', $slug)->firstOrFail();

        $dokumen->increment('dilihat');

        return view('public.dokumen.show', compact('dokumen'));
    }

    public function download($slug)
    {
        $dokumen = Dokumen::where('slug', $slug)->firstOrFail();

        if (Storage::disk('public')->exists($dokumen->file_path)) {

            $dokumen->increment('didownload');

            return Storage::disk('public')->download(
                $dokumen->file_path,
                $dokumen->judul . '.pdf'
            );
        }

        abort(404, 'File tidak ditemukan');
    }
}