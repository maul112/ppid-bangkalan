@extends('layouts.publik')

@section('content')

@php
    // ===== JUDUL HALAMAN (FIX ERROR $doc) =====
    $doc = [
        'judul' => 'Dasar Hukum PPID Kabupaten Bangkalan'
    ];

    // ===== PATH PDF (HARUS ADA DI PUBLIC) =====
    $basePath = 'themes/OnePage/assets/img/dasar-hukum/';

    // ===== DATA DOKUMEN =====
    $items = [
        [
            'judul' => 'Peraturan Bupati Nomor 11 Tahun 2021 tentang Pedoman PPID di Lingkungan Pemkab Bangkalan',
            'tahun' => 2021,
            'jenis' => 'Perbup',
            'file'  => 'Perbup_No_11_2021_Tentang_PPID_compressed.pdf',
        ],
        [
            'judul' => 'Peraturan Bupati Nomor 11 Tahun 2011 tentang Pedoman PPID di Lingkungan Pemkab Bangkalan',
            'tahun' => 2011,
            'jenis' => 'Perbup',
            'file'  => 'PerBup_Pedoman_PPID_th_2011_compressed.pdf',
        ],
        [
            'judul' => 'SK tentang Penetapan PPID Pembantu di Lingkungan Pemkab Bangkalan',
            'tahun' => 2011,
            'jenis' => 'SK',
            'file'  => 'SK_Tentang_Penetapan_Pejabat_PPID_Pembantu_Tahun_2011_compressed.pdf',
        ],
        [
            'judul' => 'SK tentang Penunjukan PPID di Lingkungan Pemkab Bangkalan',
            'tahun' => 2011,
            'jenis' => 'SK',
            'file'  => 'SK_Tentang_Penunjukan_Pejabat_PPID_Tahun_2011_compressed.pdf',
        ],
        [
            'judul' => 'SK tentang Susunan Keanggotaan PPID Kab. Bangkalan',
            'tahun' => 2016,
            'jenis' => 'SK',
            'file'  => 'SK_Tentang_Susunan_Keanggotaan_PPID_2016_compressed.pdf',
        ],
        [
            'judul' => 'SK Bupati tentang Tim PPID Kab. Bangkalan',
            'tahun' => 2018,
            'jenis' => 'SK',
            'file'  => 'SK_Bupati_Tentang_Tim_PPID_2018_compressed.pdf',
        ],
        [
            'judul' => 'SK Nomor 188.45/49/Kpts/433.013/2023 tentang PPID Kabupaten Bangkalan',
            'tahun' => 2023,
            'jenis' => 'SK',
            'file'  => 'SK_PPID_2023_compressed.pdf',
        ],
    ];
@endphp

<style>
.ppid-hero2{
  position: relative;
  overflow: hidden;
  padding: 52px 0 62px;
  background: linear-gradient(to bottom, #cfe8ff 0%, #e8f3ff 55%, #ffffff 100%);
}
.ppid-hero2 .pattern{
  position:absolute; inset:0;
  opacity:.16;
  background-image: radial-gradient(#0b2a6f 0.7px, transparent 0.7px);
  background-size: 22px 22px;
}
.ppid-hero2 h1{
  font-weight:900;
  color:#0b2a6f;
}
.badge-yellow{
  margin-top:14px;
  display:inline-block;
  padding:10px 18px;
  background:#f7d24c;
  border-radius:12px;
  font-weight:800;
}
</style>

<section class="ppid-hero2">
  <div class="pattern"></div>
  <div class="container text-center">
    <h1 class="display-6">{{ strtoupper($doc['judul']) }}</h1>
    <div class="badge-yellow">PPID Kabupaten Bangkalan</div>
  </div>
</section>

<div class="dh-wrap">
  <div class="container">
    <h2 class="text-center mt-4">Dasar Hukum</h2>

    @foreach($items as $it)
    <div class="dh-item d-flex align-items-center mb-3">
      <div class="flex-grow-1">
        <b>{{ $it['judul'] }}</b><br>
        <small>{{ $it['jenis'] }} | Tahun {{ $it['tahun'] }}</small>
      </div>
      <a class="btn btn-primary"
         href="{{ asset($basePath.$it['file']) }}"
         target="_blank"
         download>
         Unduh
      </a>
    </div>
    @endforeach
  </div>
</div>

@endsection
