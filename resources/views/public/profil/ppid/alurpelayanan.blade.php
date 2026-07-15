@extends('layouts.publik')

@section('content')

<style>
.ppid-hero2{
    position:relative;
    overflow:hidden;
    padding:52px 0 62px;
    background:linear-gradient(to bottom,#cfe8ff 0%,#e8f3ff 55%,#ffffff 100%);
}

.ppid-hero2 .pattern{
    position:absolute;
    inset:0;
    opacity:.16;
    background-image:radial-gradient(#0b2a6f 0.7px, transparent 0.7px);
    background-size:22px 22px;
}

.ppid-hero2 h1{
    font-weight:900;
    color:#0b2a6f;
    margin-bottom:10px;
}

.badge-yellow{
    display:inline-block;
    padding:10px 18px;
    background:#f7d24c;
    border-radius:12px;
    font-weight:800;
    color:#111827;
}

.dh-wrap{
    background:#f8fafc;
    padding:50px 0;
}

.section-title{
    text-align:center;
    font-size:30px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:40px;
}

.dh-item{
    background:#fff;
    border-radius:20px;
    padding:24px 28px;
    margin-bottom:20px;
    border:1px solid #e5e7eb;
    box-shadow:0 5px 20px rgba(0,0,0,.06);
    transition:.3s;
}

.dh-item:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 30px rgba(37,99,235,.12);
}

.doc-box{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
}

.doc-left{
    display:flex;
    align-items:center;
    gap:18px;
}

.pdf-icon{
    width:70px;
    height:70px;
    border-radius:18px;
    background:#dbeafe;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    flex-shrink:0;
}

.doc-title{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
    line-height:1.4;
    margin-bottom:6px;
}

.doc-sub{
    color:#64748b;
    font-size:15px;
    line-height:1.6;
}

.btn-download{
    background:#2563eb;
    color:white;
    padding:12px 24px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
    white-space:nowrap;
}

.btn-download:hover{
    background:#1d4ed8;
    color:white;
}

@media(max-width:768px){

    .doc-box{
        flex-direction:column;
        align-items:flex-start;
    }

    .doc-left{
        align-items:flex-start;
    }

    .btn-download{
        width:100%;
        text-align:center;
    }

    .doc-title{
        font-size:18px;
    }

}
</style>

<x-public-header title="ALUR PELAYANAN INFORMASI" subtitle="PPID Kabupaten Bangkalan" />

<div class="dh-wrap">

    <div class="container">

        <div class="section-title">
            Dokumen Alur Pelayanan
        </div>

        {{-- PDF 1 --}}
        <div class="dh-item">
            <div class="doc-box">

                <div class="doc-left">

                    <div class="pdf-icon">
                        📄
                    </div>

                    <div>
                        <div class="doc-title">
                            Alur Pengaduan Melalui Aplikasi
                        </div>

                        <div class="doc-sub">
                            Panduan proses pengaduan masyarakat melalui aplikasi layanan informasi PPID Kabupaten Bangkalan.
                        </div>
                    </div>

                </div>

                <a href="{{ asset('files/alur-layanan/Alur_Pengaduan_Melalui_Aplikasi_(1).pdf') }}"
                   target="_blank"
                   class="btn-download">
                    Buka Dokumen
                </a>

            </div>
        </div>

        {{-- PDF 2 --}}
        <div class="dh-item">
            <div class="doc-box">

                <div class="doc-left">

                    <div class="pdf-icon">
                        📑
                    </div>

                    <div>
                        <div class="doc-title">
                            Alur Pengaduan Melalui Aplikasi (Versi 2)
                        </div>

                        <div class="doc-sub">
                            Dokumen alur pelayanan informasi publik dan mekanisme penanganan pengaduan masyarakat.
                        </div>
                    </div>

                </div>

                <a href="{{ asset('files/alur-layanan/Alur_Pengaduan_Melalui_Aplikasi_(2).pdf') }}"
                   target="_blank"
                   class="btn-download">
                    Buka Dokumen
                </a>

            </div>
        </div>

    </div>

</div>

@endsection