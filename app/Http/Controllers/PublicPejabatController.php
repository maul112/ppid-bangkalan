<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pejabat;

class PublicPejabatController extends Controller
{
    public function index($kategori)
    {
        // Map slug back to category enum
        $kategoriMap = [
            'bupati' => 'Bupati',
            'wakilbupati' => 'Wakil Bupati',
            'sekda' => 'Sekda',
            'asisten' => 'Asisten',
            'stafahli' => 'Staf Ahli',
            'sekretaris-dprd' => 'Sekretaris DPRD',
            'inspektur' => 'Inspektur',
            'kepala-dinas' => 'Kepala Dinas',
            'kepala-badan' => 'Kepala Badan',
            'direktur-rsud' => 'Direktur RSUD',
            'direktur' => 'Direktur',
            'camat' => 'Camat',
            'kepala-pelaksana-bpbd' => 'Kepala Pelaksana BPBD',
            'kepala-bagian' => 'Kepala Bagian',
            'lainnya' => 'Lainnya',
        ];

        if (!array_key_exists($kategori, $kategoriMap)) {
            abort(404);
        }

        $namaKategori = $kategoriMap[$kategori];
        
        $pejabats = Pejabat::where('kategori_pejabat', $namaKategori)
                            ->where('is_active', true)
                            ->orderBy('id')
                            ->get();

        if (in_array($kategori, ['bupati', 'wakilbupati'])) {
            $pejabat = $pejabats->first();
            return view('public.pejabat.bupati', compact('pejabat', 'namaKategori'));
        }

        return view('public.pejabat.index', compact('pejabats', 'namaKategori'));
    }
}
