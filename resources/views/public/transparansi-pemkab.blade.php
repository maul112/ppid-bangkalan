@extends('layouts.publik')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        Transparansi Pemerintah Kabupaten Bangkalan
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('profil.dasar_hukum') }}"
           class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-blue-700">
                Dasar Hukum
            </h2>
            <p class="mt-2 text-gray-600">
                Kumpulan dokumen dasar hukum PPID.
            </p>
        </a>

        <a href="{{ route('profil.sop') }}"
           class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-blue-700">
                SOP
            </h2>
            <p class="mt-2 text-gray-600">
                Standar Operasional Prosedur layanan informasi.
            </p>
        </a>

        <a href="{{ route('profil.alur_pelayanan') }}"
           class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-blue-700">
                Alur Pelayanan
            </h2>
            <p class="mt-2 text-gray-600">
                Alur pelayanan permohonan informasi publik.
            </p>
        </a>

        <a href="{{ route('profil.laporan_pelayanan') }}"
           class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-blue-700">
                Laporan PPID
            </h2>
            <p class="mt-2 text-gray-600">
                Laporan pelayanan informasi publik.
            </p>
        </a>

        <a href="{{ route('public.lhkpn') }}"
           class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-blue-700">
                LHKPN
            </h2>
            <p class="mt-2 text-gray-600">
                Laporan Harta Kekayaan Penyelenggara Negara.
            </p>
        </a>

    </div>

</div>
@endsection