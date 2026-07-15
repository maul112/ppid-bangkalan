@extends('layouts/publik')

@section('content')

<style>
    /* ===== HERO ===== */
    .ppid-hero{
        position: relative;
        overflow: hidden;

        /* ini yang ngurangin area kosong */
        padding: 26px 0 32px;

        background: linear-gradient(to bottom, #cfe8ff 0%, #e8f3ff 55%, #ffffff 100%);
    }
    .ppid-hero .pattern{
        position:absolute; inset:0;
        opacity:.16;
        background-image: radial-gradient(#0b2a6f 0.7px, transparent 0.7px);
        background-size: 22px 22px;
    }
    .ppid-hero .shape1{
        position:absolute; left:-90px; top:-90px;
        width:280px; height:280px; border-radius:999px;
        background: rgba(59,130,246,.18);
        filter: blur(34px);
    }
    .ppid-hero .shape2{
        position:absolute; right:60px; top:64px;
        width:120px; height:120px; border-radius:20px;
        background: rgba(37,99,235,.18);
        transform: rotate(12deg);
    }
    .ppid-hero .shape3{
        position:absolute; left:160px; top:110px;
        width:44px; height:44px;
        border:2px solid rgba(37,99,235,.22);
        transform: rotate(12deg);
    }
    .ppid-hero .shape4{
        position:absolute; right:160px; bottom:54px;
        width:34px; height:34px;
        border:2px solid rgba(37,99,235,.18);
        transform: rotate(-12deg);
    }
    .ppid-hero .shape5{
        position:absolute; left:35%; bottom:62px;
        width:160px; height:10px; border-radius:999px;
        background: rgba(37,99,235,.16);
    }
    .ppid-hero .hero-inner{
        position: relative;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 16px;
        text-align: center;
    }
    .ppid-hero h1{
        margin:0;
        font-size: 38px;
        font-weight: 800;
        color:#0b2a6f;
        letter-spacing: .2px;
    }
    .ppid-hero .badge{
        display:inline-block;
        margin-top:12px;
        padding:10px 16px;
        background:#facc15;
        color:#111827;
        font-weight:700;
        border-radius:8px;
        border:1px solid #f2c200;
        box-shadow: 0 2px 10px rgba(0,0,0,.08);
        font-size: 14px;
    }
    .ppid-wave{
        position:absolute;
        left:0; bottom:-1px;
        width:100%;

        /* kecilin wave biar gak nyisa ruang */
        height:42px;
    }

    /* ===== CONTENT ===== */
    .ppid-content{
        background:#f8fafc;
        padding: 0 0 60px;

        /* ini yang bikin card “naik” lebih dekat hero */
        margin-top: -0px;
    }
    .ppid-wrap{
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 16px;
    }
    .ppid-card{
        max-width: 920px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(15,23,42,.08);
        overflow:hidden;
    }
    .ppid-card .body{
        padding: 26px;
    }

    @media (max-width: 640px){
        .ppid-hero h1{ font-size: 30px; }
        .ppid-card .body{ padding:18px; }
        .ppid-content{ margin-top: -34px; }
    }
</style>

<x-public-header title="Tugas Pokok dan Fungsi" />

<section class="ppid-content">
    <div class="ppid-wrap">
        <div class="ppid-card">
            <div class="body">

                {{-- TUGAS --}}
                <h2 class="text-base sm:text-lg font-semibold text-slate-800">
                    A. Tugas Pejabat Pengelola Informasi dan Dokumentasi (PPID)
                </h2>

                <ol class="mt-4 list-decimal pl-6 space-y-3 text-slate-700 leading-relaxed">
                    <li>Mengkoordinasikan dan mengkonsolidasikan pengumpulan bahan informasi dan dokumentasi dari PPID Pembantu.</li>
                    <li>Menyimpan, mendokumentasikan, menyediakan, dan memberikan pelayanan informasi kepada publik.</li>
                </ol>

                <hr class="my-6 border-slate-200">

                {{-- FUNGSI --}}
                <h2 class="text-base sm:text-lg font-semibold text-slate-800">
                    B. Fungsi Pejabat Pengelola Informasi dan Dokumentasi (PPID)
                </h2>

                <ol class="mt-4 list-decimal pl-6 space-y-3 text-slate-700 leading-relaxed">
                    <li>Melakukan verifikasi bahan informasi publik.</li>
                    <li>Melakukan uji konsekuensi atas informasi yang dikecualikan.</li>
                    <li>Melakukan pemutakhiran informasi dan dokumentasi.</li>
                    <li>Menyediakan informasi dan dokumentasi agar dapat diakses oleh masyarakat.</li>
                </ol>

            </div>
        </div>
    </div>
</section>

@endsection
