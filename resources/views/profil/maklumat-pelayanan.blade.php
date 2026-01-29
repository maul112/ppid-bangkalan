@extends('layouts.publik')

@section('content')
<style>
  /* ===== HERO BIRU (LEBIH SOLID, NGGAK TEMBUS) ===== */
  .ppid-hero2{
    position: relative;
    overflow: hidden;
    padding: 56px 0 64px;
    /* bikin biru lebih "jadi" */
    background: linear-gradient(180deg, #beddff 0%, #dcedff 55%, #ffffff 100%);
  }

  /* motif gambar (lebih halus) */
  .ppid-hero2 .motif-img{
    position:absolute; inset:0;
    opacity:.10; /* kecil biar ga tembus banget */
    background-image: url("{{ asset('img/IMG_5775.jpeg') }}");
    background-size: cover;
    background-position: center;
    pointer-events:none;
    filter: saturate(.85) contrast(.95);
  }

  /* layer putih tipis supaya motif tidak ganggu (ini yang bikin solid) */
  .ppid-hero2 .wash{
    position:absolute; inset:0;
    background: rgba(255,255,255,.40);
    pointer-events:none;
  }

  /* dot pattern tipis */
  .ppid-hero2 .pattern{
    position:absolute; inset:0;
    opacity:.12;
    background-image: radial-gradient(#0b2a6f 0.7px, transparent 0.7px);
    background-size: 22px 22px;
    pointer-events:none;
  }

  .ppid-hero2 .shape-left{
    position:absolute; left: 80px; top: 92px;
    width: 56px; height: 56px;
    border: 2px solid rgba(29,78,216,.22);
    transform: rotate(18deg);
    border-radius: 12px;
    background: rgba(29,78,216,.06);
    pointer-events:none;
  }
  .ppid-hero2 .shape-right{
    position:absolute; right: 75px; top: 70px;
    width: 180px; height: 120px;
    border-radius: 26px;
    background: rgba(29,78,216,.12);
    transform: rotate(-10deg);
    pointer-events:none;
  }
  .ppid-hero2 .shape-right:after{
    content:"";
    position:absolute; inset: 18px;
    border-radius: 18px;
    border: 2px dashed rgba(29,78,216,.22);
  }

  .ppid-hero2 h1{
    margin: 0;
    font-weight: 900;
    letter-spacing: .2px;
    color: #0b2a6f;
    text-transform: uppercase;
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

  /* ===== KONTEN WRAP ===== */
  .doc-wrap{
    padding: 28px 0 70px;
    background:#fff;
  }

  .doc-card{
    max-width: 1120px;
    margin: 0 auto;
    border-radius: 16px;
    box-shadow: 0 16px 44px rgba(2,23,59,.08);
    overflow:hidden;
    border:1px solid rgba(15,23,42,.06);
    background:#fff;
  }

  .doc-head{
    padding: 16px 18px;
    background: #ffffff;
    border-bottom: 1px solid rgba(15,23,42,.06);
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }

  .doc-head .title-mini{
    font-weight: 900;
    color:#0b2a6f;
    letter-spacing:.2px;
  }

  .btn-unduh{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding: 10px 16px;
    border-radius: 12px;
    background:#1d4ed8;
    color:#fff;
    text-decoration:none;
    font-weight:800;
    border:1px solid rgba(29,78,216,.35);
    white-space: nowrap;
  }
  .btn-unduh:hover{ color:#fff; filter:brightness(.95); }

  /* ===== VIEWER SCROLL (KAYAK CONTOH JEMBER) ===== */
  .viewer{
    background:#111827;
    padding: 14px;
  }

  .viewer-scroll{
    height: 720px;         /* tinggi viewer, ubah sesuai selera */
    overflow: auto;        /* INI yang bikin scroll di dalam */
    padding: 18px;
    background:#0b0f18;
    border-radius: 12px;
    border:1px solid rgba(255,255,255,.06);
  }

  .viewer-scroll img{
    width: 100%;
    height: auto;
    display:block;
    border-radius: 10px;
    background:#fff;       /* biar dokumen kelihatan jelas */
    box-shadow: 0 10px 30px rgba(0,0,0,.22);
  }

  /* scrollbar biar mirip viewer (opsional) */
  .viewer-scroll::-webkit-scrollbar{
    width: 14px;
    background-color: #202124;
  }
  .viewer-scroll::-webkit-scrollbar-thumb{
    background-color: #0c0c0c;
    border: 4px solid #202124;
    border-radius: 10px;
  }
  .viewer-scroll::-webkit-scrollbar-thumb:hover{
    background-color: #0e0e0f;
  }

  @media (max-width: 992px){
    .viewer-scroll{ height: 620px; }
    .ppid-hero2 .shape-right{ display:none; }
  }
</style>

@php
  $maklumat = 'img/maklumat.jpg'; // sesuai folder kamu
@endphp

{{-- HERO --}}
<section class="ppid-hero2">
  <div class="motif-img"></div>
  <div class="wash"></div>
  <div class="pattern"></div>
  <div class="shape-left"></div>
  <div class="shape-right"></div>

  <div class="container position-relative" style="z-index:2;">
    <div class="text-center">
      <h1 class="display-6">Maklumat Pelayanan</h1>
      <div class="badge-yellow">Maklumat Pelayanan Informasi Publik • PPID Kabupaten Bangkalan</div>
    </div>
  </div>
</section>

{{-- KONTEN --}}
<div class="doc-wrap">
  <div class="container">
    <div class="doc-card">

      <div class="doc-head">
        <div class="title-mini">Dokumen Maklumat Pelayanan</div>
        <a class="btn-unduh" href="{{ asset($maklumat) }}" target="_blank" rel="noopener" download>
          Unduh Dokumen
        </a>
      </div>

      <div class="viewer">
        <div class="viewer-scroll">
          <img src="{{ asset($maklumat) }}" alt="Maklumat Pelayanan PPID Kabupaten Bangkalan">
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
