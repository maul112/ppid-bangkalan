@props(['title', 'subtitle' => 'PPID Kabupaten Bangkalan'])

@once
<style>
    /* ===== HERO ===== */
    .ppid-hero{
        position: relative;
        overflow: hidden;
        padding: 28px 0 56px;
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
        position:absolute; right:160px; bottom:80px;
        width:34px; height:34px;
        border:2px solid rgba(37,99,235,.18);
        transform: rotate(-12deg);
    }
    .ppid-hero .shape5{
        position:absolute; left:35%; bottom:90px;
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
        height:60px;
    }
    @media (max-width: 640px){
        .ppid-hero h1{ font-size: 30px; }
    }
</style>
@endonce

<section class="ppid-hero">
    <div class="pattern"></div>
    <div class="shape1"></div>
    <div class="shape2"></div>
    <div class="shape3"></div>
    <div class="shape4"></div>
    <div class="shape5"></div>

    <div class="hero-inner">
        <h1>{{ $title }}</h1>
        <div class="badge">{{ $subtitle }}</div>
    </div>

    <svg class="ppid-wave" viewBox="0 0 1440 90" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path fill="#f8fafc"
            d="M0,64L60,58.7C120,53,240,43,360,42.7C480,43,600,53,720,58.7C840,64,960,64,1080,58.7C1200,53,1320,43,1380,37.3L1440,32L1440,90L0,90Z">
        </path>
    </svg>
</section>
