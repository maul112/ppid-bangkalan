@extends('layouts.publik')

@section('content')
<style>
    /* ===== HERO ===== */
    .ppid-hero{
        position: relative;
        overflow: hidden;

        /* lebih pendek biar gak banyak kosong */
        padding: 26px 0 34px;

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
        position:absolute; right:60px; top:44px;
        width:120px; height:120px; border-radius:20px;
        background: rgba(37,99,235,.18);
        transform: rotate(12deg);
    }
    .ppid-hero .shape3{
        position:absolute; left:160px; top:95px;
        width:44px; height:44px;
        border:2px solid rgba(37,99,235,.22);
        transform: rotate(12deg);
    }
    .ppid-hero .shape4{
        position:absolute; right:160px; bottom:52px;
        width:34px; height:34px;
        border:2px solid rgba(37,99,235,.18);
        transform: rotate(-12deg);
    }
    .ppid-hero .shape5{
        position:absolute; left:35%; bottom:58px;
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
        height:42px; /* lebih kecil */
    }

    /* ===== CONTENT ===== */
    .ppid-content{
        background:#f8fafc;
        padding: 12px 0 60px;

        /* bikin card “naik” ke area hero (ngurangin jarak kosong yg kamu lingkari) */
        margin-top: -28px;
        position: relative;
        z-index: 2;
    }
</style>

<x-public-header title="Struktur Organisasi" />

<section class="ppid-content">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-2xl p-4 sm:p-6 border border-slate-200">

            {{-- PDF Embed --}}
            <div class="w-full overflow-hidden rounded-xl border border-slate-200">
                <iframe
                    src="{{ asset('img/struktur/struktur-organisasi-ppid-bkl.pdf') }}"
                    style="width:100%; height:650px;"
                    frameborder="0">
                </iframe>
            </div>

        </div>
    </div>
</section>
@endsection
