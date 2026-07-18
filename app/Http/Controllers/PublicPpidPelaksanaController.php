<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPpidPelaksanaController extends Controller
{
    public function index($kategori)
    {
        // Kategori jamak: Badan, Bagian, Dinas, Kecamatan, Kelurahan, RSUD, Puskesmas, BUMD
        // Di database kategorinya adalah: Badan, Dinas, Camat (atau Kecamatan), dll
        // Kita petakan agar sesuai dengan nama kategori di database
        $kategoriMap = [
            'badan' => 'Badan',
            'bagian' => 'Bagian',
            'dinas' => 'Dinas',
            'kecamatan' => 'Camat',
            'rsud' => 'Direktur RSUD',
            'puskesmas' => 'Kepala Puskesmas',
            'bumd' => 'Direktur',
            'kelurahan' => 'Lurah'
        ];

        $kategoriDb = $kategoriMap[strtolower($kategori)] ?? ucfirst($kategori);

        $query = \App\Models\PpidPelaksana::with('pejabat')
            ->where('kategori', $kategoriDb);

        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('pejabat', function($q2) use ($search) {
                    $q2->where('instansi', 'like', "%{$search}%");
                });
            });
        }

        $ppidPelaksanas = $query->paginate(15)->withQueryString();

        return view('public.ppidpelaksana.index', compact('ppidPelaksanas', 'kategori'));
    }

    public function showSingle($type)
    {
        // Kategori tunggal: Inspektorat, Setwan
        if ($type === 'inspektorat') {
            $keyword = 'Inspektur';
        } elseif ($type === 'setwan') {
            $keyword = 'Sekretaris DPRD';
        } else {
            abort(404);
        }

        $ppidPelaksana = \App\Models\PpidPelaksana::with(['pejabat', 'dokumenWajib'])
            ->whereHas('pejabat', function ($query) use ($keyword) {
                $query->where('instansi', 'like', '%' . $keyword . '%');
            })->firstOrFail();

        return view('public.ppidpelaksana.show', compact('ppidPelaksana'));
    }

    public function show($id)
    {
        $ppidPelaksana = \App\Models\PpidPelaksana::with(['pejabat', 'dokumenWajib'])->findOrFail($id);
        return view('public.ppidpelaksana.show', compact('ppidPelaksana'));
    }
}
