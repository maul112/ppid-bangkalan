@extends('layouts.publik')

@section('content')

@php
$items = [

    [
        'judul' => 'sk PPID pelaksana 2025',
        'tahun' => '2025',
        'jenis' => 'Google Drive',
        'link'  => 'https://drive.google.com/drive/folders/14rSPR_t9KcubG42aBQaKDWO9nxjxA4Z6',
    ],

    [
        'judul' => 'RKA 2025 seluruh OPD',
        'tahun' => '2025',
        'jenis' => 'Google Drive',
        'link'  => 'https://drive.google.com/drive/folders/1_aQkb2WgbGrN0rWWz23ZA2RfAwHu8v6j',
    ],

    [
        'judul' => 'renstra 2024 - 2026',
        'tahun' => '2025',
        'jenis' => 'Google Drive',
        'link'  => 'https://drive.google.com/drive/folders/12cfpTf7g-BCGysBfGsfulf_vFNUQAEP9',
    ],

    [
        'judul' => 'SK DIK PPID 2025',
        'tahun' => '2025',
        'jenis' => 'PDF',
        'link'  => asset('files/sk/SK_DIK_PPID_2025_compressed.pdf'),
    ],

    [
        'judul' => 'SK DIP 2025',
        'tahun' => '2025',
        'jenis' => 'PDF',
        'link'  => asset('files/sk/SK_DIP_2025.pdf'),
    ],

    [
        'judul' => 'SK DIP 2026',
        'tahun' => '2026',
        'jenis' => 'PDF',
        'link'  => asset('files/sk/SK_DIP_2026.pdf'),
    ],

];
@endphp

<style>

/* HERO */
.ppid-hero{
    position:relative;
    overflow:hidden;
    padding:45px 0;
    background:linear-gradient(to bottom,#cfe8ff 0%,#e8f3ff 55%,#ffffff 100%);
}

.ppid-hero .pattern{
    position:absolute;
    inset:0;
    opacity:.15;
    background-image:radial-gradient(#0b2a6f 0.7px, transparent 0.7px);
    background-size:22px 22px;
}

.hero-inner{
    position:relative;
    text-align:center;
}

.hero-inner h1{
    font-size:38px;
    font-weight:800;
    color:#0b2a6f;
}

.hero-badge{
    display:inline-block;
    margin-top:12px;
    padding:10px 18px;
    background:#facc15;
    border-radius:10px;
    font-weight:700;
}

/* LIST */
.document-list{
    max-width:1100px;
    margin:50px auto;
    padding:0 15px;
}

.doc-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    margin-bottom:22px;
    border:1px solid #e5e7eb;
    box-shadow:0 8px 30px rgba(0,0,0,.06);
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    transition:.3s;
}

.doc-card:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 40px rgba(0,0,0,.10);
}

.doc-left{
    display:flex;
    align-items:center;
    gap:20px;
    flex:1;
}

.doc-icon{
    width:80px;
    height:80px;
    border-radius:20px;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    flex-shrink:0;
}

.doc-title{
    font-size:20px;
    font-weight:700;
    color:#1e293b;
    margin-bottom:10px;
}

.doc-meta{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.doc-badge{
    background:#eff6ff;
    color:#2563eb;
    padding:6px 12px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.btn-doc{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    text-decoration:none;
    padding:14px 22px;
    border-radius:12px;
    font-weight:700;
    transition:.3s;
    white-space:nowrap;
}

.btn-doc:hover{
    color:#fff;
    transform:scale(1.04);
}

@media(max-width:768px){

    .hero-inner h1{
        font-size:28px;
    }

    .doc-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .btn-doc{
        width:100%;
        text-align:center;
    }

    .doc-title{
        font-size:17px;
    }

}
</style>

<section class="ppid-hero">
    <div class="pattern"></div>

    <div class="container hero-inner">
        <h1>DASAR HUKUM PPID</h1>
        <div class="hero-badge">
            PPID Kabupaten Bangkalan
        </div>
    </div>
</section>

<div class="document-list">

    @foreach($items as $it)

    <div class="doc-card">

        <div class="doc-left">

            <div class="doc-icon">
                <i class="fas fa-file-pdf"></i>
            </div>

            <div>

                <div class="doc-title">
                    {{ $it['judul'] }}
                </div>

                <div class="doc-meta">

                    <span class="doc-badge">
                        {{ $it['jenis'] }}
                    </span>

                    <span class="doc-badge">
                        Tahun {{ $it['tahun'] }}
                    </span>

                </div>

            </div>

        </div>

        <a href="{{ $it['link'] }}"
           target="_blank"
           class="btn-doc">
            <i class="fas fa-download"></i>
            Buka Dokumen
        </a>

    </div>

    @endforeach

</div>

@endsection