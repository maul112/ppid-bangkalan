@extends('layouts/publik')

@section('content')

<style>
    /* ===== HERO ===== */
    .ppid-hero{
      position: relative;
      overflow: hidden;
  
      /* DIPENDEKIN biar gak kebanyakan putih */
      padding: 30px 0 28px;
  
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
      position:absolute; right:60px; top:44px; /* naik dikit */
      width:120px; height:120px; border-radius:20px;
      background: rgba(37,99,235,.18);
      transform: rotate(12deg);
    }
    .ppid-hero .shape3{
      position:absolute; left:160px; top:95px; /* naik dikit */
      width:44px; height:44px;
      border:2px solid rgba(37,99,235,.22);
      transform: rotate(12deg);
    }
    .ppid-hero .shape4{
      position:absolute; right:160px; bottom:52px; /* naik dikit */
      width:34px; height:34px;
      border:2px solid rgba(37,99,235,.18);
      transform: rotate(-12deg);
    }
    .ppid-hero .shape5{
      position:absolute; left:35%; bottom:58px; /* naik dikit */
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
  
      /* DIPENDEKIN biar hero gak nyisain ruang */
      height:42px;
    }
  
    /* ===== CONTENT TEXT STYLE (mirip screenshot) ===== */
    .vm-title{
      font-size: 20px;
      font-weight: 800;
      color: #0f172a;
      margin: 0 0 10px;
    }
  
    .vm-list{
      margin: 0 0 22px;
      padding-left: 22px;
      color: #334155;
      font-size: 18px;
      line-height: 1.9;
    }
  
    .vm-list li{
      margin: 10px 0;
    }
  
    /* responsif */
    @media (max-width: 640px){
      .ppid-hero h1{ font-size: 30px; }
      .vm-list{ font-size: 16px; }
    }
  </style>
  


{{-- HERO --}}
<x-public-header title="Visi dan Misi" />

{{-- CONTENT --}}
<section class="bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="p-6 sm:p-10">

                    {{-- VISI --}}
                    <div class="vm-title">Visi :</div>
                    <ul class="vm-list">
                        <li>
                            • Mewujudkan tata kelola pemerintahan yang baik di lingkungan Pemerintah Kabupaten Bangkalan
                              melalui transparansi informasi publik dan akuntabel untuk memenuhi hak pemohon informasi
                              sesuai peraturan perundang-undangan.
                        </li>
                    </ul>

                    {{-- MISI --}}
                    <div class="vm-title">Misi :</div>
                    <ul class="vm-list">
                        <li>• Menyediakan informasi publik secara responsif, akurat, akuntabel, dan tepat waktu.</li>
                        <li>
                            • Membangun sistem layanan informasi melalui pemanfaatan teknologi informasi dan komunikasi
                              demi mewujudkan pelayanan informasi yang cepat, tepat, dan benar.
                        </li>
                    </ul>

                </div>
            </div>

            <div class="h-10"></div>
        </div>
    </div>
</section>
@endsection
