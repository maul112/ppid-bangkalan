@extends('layouts.publik')

@section('content')
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
      pointer-events:none;
    }
    .ppid-hero2 .shape-left{
      position:absolute;
      left: 65px; top: 86px;
      width: 46px; height: 46px;
      border: 2px solid rgba(29,78,216,.25);
      transform: rotate(18deg);
      border-radius: 10px;
      background: rgba(29,78,216,.05);
      pointer-events:none;
    }
    .ppid-hero2 .shape-right{
      position:absolute;
      right: 70px; top: 70px;
      width: 140px; height: 100px;
      border-radius: 22px;
      background: rgba(29,78,216,.10);
      transform: rotate(-10deg);
      pointer-events:none;
    }
    .ppid-hero2 .shape-right:after{
      content:"";
      position:absolute; inset: 16px;
      border-radius: 16px;
      border: 2px dashed rgba(29,78,216,.22);
    }
  
    .ppid-hero2 h1{
      margin: 0;
      font-weight: 900;
      letter-spacing: .2px;
      color: #0b2a6f;
    }
    .ppid-hero2 .badge-yellow{
      display:inline-block;
      margin-top: 14px;
      padding: 10px 18px;
      border-radius: 12px;
      background: #f7d24c;
      color: #0b2a6f;
      font-weight: 800;
      box-shadow: 0 10px 18px rgba(2, 23, 59, .08);
    }
  </style>
  
  <section class="ppid-hero2">
    <div class="pattern"></div>
    <div class="shape-left"></div>
    <div class="shape-right"></div>
  
    <div class="container position-relative" style="z-index:2;">
      <div class="text-center">
        {{-- Judul dinamis sesuai dokumen --}}
        <h1 class="display-6">
          {{ strtoupper($doc['judul']) }}
        </h1>
  
        {{-- Badge sesuai tema --}}
        <div class="badge-yellow">
          PPID Kabupaten Bangkalan
        </div>
      </div>
    </div>
  </section>
  
@php
    // Sesuaikan ini dengan lokasi PDF kamu (WAJIB bisa diakses public)
    $basePath = 'themes/OnePage/assets/img/dasar-hukum/';

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

<div class="dh-wrap">
    <div class="container dh-container">
        <h2 class="dh-title">Dasar Hukum</h2>
        <div class="dh-line"></div>
        <div class="text-center">
            <span class="dh-sub">Dasar Hukum PPID Kabupaten Bangkalan</span>
        </div>

        <div class="dh-list">
            @foreach($items as $it)
            <div class="dh-item">
                <div class="dh-icon" aria-hidden="true">
                    <!-- icon download -->
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 3v10m0 0 4-4m-4 4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 15v3a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <div class="dh-text">
                    <p class="dh-judul">{{ $it['judul'] }}</p>
                    <div class="dh-meta">
                        <span class="dh-chip">{{ $it['jenis'] }}</span>
                        <span> Tahun: <b>{{ $it['tahun'] }}</b></span>
                    </div>
                </div>

                <a class="dh-btn"
                   href="{{ asset($basePath.$it['file']) }}"
                   target="_blank" rel="noopener"
                   download>
                    Unduh
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
