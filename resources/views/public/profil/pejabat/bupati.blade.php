@extends('layouts.publik')

@section('content')

<x-public-header title="Profil Bupati Kabupaten Bangkalan" subtitle="Informasi Profil Bupati Kabupaten Bangkalan" />

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