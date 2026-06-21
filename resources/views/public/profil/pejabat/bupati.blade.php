@extends('layouts.publik')

@section('content')

<!-- HEADER -->
<section class="bg-blue-100 py-20">

    <div class="max-w-7xl mx-auto px-4 text-center">

        <h1 class="text-5xl md:text-6xl font-bold text-blue-700 mb-6">
            Profil Bupati Kabupaten Bangkalan
        </h1>

        <div class="inline-block bg-yellow-400 px-8 py-3 rounded-lg shadow">
            <span class="font-bold text-black text-lg">
                Informasi Profil Bupati Kabupaten Bangkalan
            </span>
        </div>

    </div>

</section>

<!-- PDF -->
<section class="max-w-7xl mx-auto py-10 px-4">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <iframe
            src="{{ asset('dokumen/Profil_Bupati_Wabup_dan_Kepala_OPD.pdf') }}"
            width="100%"
            height="900"
            class="border-0">
        </iframe>

    </div>

    <div class="mt-6 text-center">
        <a href="{{ asset('dokumen/Profil_Bupati_Wabup_dan_Kepala_OPD.pdf') }}"
           target="_blank"
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

            <i class="fas fa-download mr-2"></i>
            Download Profil Lengkap
        </a>
    </div>

</section>

@endsection