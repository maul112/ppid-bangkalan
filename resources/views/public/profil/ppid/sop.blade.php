@extends('layouts.publik')

@section('content')

@php

$items = [

[
'id' => 1,
'judul' => 'Penanganan Keberatan',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '760 KB',
'keterangan' => '-',
'link' => url('/files/sop/Penanganan_Keberatan.pdf'),
],

[
'id' => 2,
'judul' => 'Pendokumentasian Informasi Publik',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '782 KB',
'keterangan' => '-',
'link' => url('/files/sop/pendokumentasian_dip_rotated.pdf'),
],

[
'id' => 3,
'judul' => 'Penetapan dan Pemutakhiran DIP',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '815 KB',
'keterangan' => '-',
'link' => url('/files/sop/penetapan_dip_rotated.pdf'),
],

[
'id' => 4,
'judul' => 'Permohonan Informasi Publik',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '1.597 KB',
'keterangan' => '-',
'link' => url('/files/sop/pip_rotated.pdf'),
],

[
'id' => 5,
'judul' => 'SOP Standar Pelayanan Informasi Publik',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '292 KB',
'keterangan' => '-',
'link' => url('/files/sop/SOP Standar Pelayanan Informasi Publik.pdf'),
],

[
'id' => 6,
'judul' => 'SOP Penanganan Sengketa Informasi Publik',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '152 KB',
'keterangan' => '-',
'link' => url('/files/sop/SOP_Penanganan_Sengketa_Informasi.pdf'),
],

[
'id' => 7,
'judul' => 'SOP Penanggulangan Kebakaran',
'tahun' => '2025',
'instansi' => 'Satuan Polisi Pamong Praja Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '81 KB',
'keterangan' => '-',
'link' => url('/files/sop/SOP_penanggulangan_kebakaran.pdf'),
],

[
'id' => 8,
'judul' => 'SOP Uji Konsekuensi',
'tahun' => '2025',
'instansi' => 'Dinas Komunikasi dan Informatika Kabupaten Bangkalan',
'kategori' => 'Standar Operasional Prosedur',
'ukuran' => '621 KB',
'keterangan' => '-',
'link' => url('/files/sop/SOP_Uji_Konsekuensi.pdf'),
],

];

@endphp

<style>



.document-grid{
max-width:1200px;
margin:40px auto;
display:grid;
grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
gap:20px;
padding:0 15px;
}

.doc-card{
background:#fff;
border-radius:16px;
overflow:hidden;
border:1px solid #e5e7eb;
box-shadow:0 4px 15px rgba(0,0,0,.08);
}

.doc-body{
padding:25px;
}

.doc-title{
font-size:18px;
font-weight:700;
margin-bottom:10px;
}

.doc-meta{
font-size:14px;
color:#64748b;
}

.doc-footer{
padding:20px;
border-top:1px solid #e5e7eb;
}

.btn-doc{
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#1d4ed8;
color:#fff;
font-weight:700;
}

.btn-doc:hover{
background:#1e40af;
}

.preview-pdf{
width:100%;
height:700px;
border:1px solid #ddd;
border-radius:10px;
}

</style>

<x-public-header title="SOP PPID" subtitle="Standar Operasional Prosedur" />

<div class="document-grid">

@foreach($items as $it)

<div class="doc-card">

<div class="doc-body">

<div class="doc-title">
{{ $it['judul'] }}
</div>

<div class="doc-meta">
{{ $it['instansi'] }}
</div>

<div class="doc-meta mt-2">
Tahun {{ $it['tahun'] }} • {{ $it['ukuran'] }}
</div>

</div>

<div class="doc-footer">

<button
type="button"
class="btn-doc"
data-bs-toggle="modal"
data-bs-target="#pdfModal{{ $it['id'] }}">
Lihat Detail </button>

</div>

</div>

@endforeach

</div>

{{-- MODAL DETAIL --}}
@foreach($items as $it)

<div class="modal fade"
     id="pdfModal{{ $it['id'] }}"
     tabindex="-1"
     aria-labelledby="pdfModalLabel{{ $it['id'] }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title"
                    id="pdfModalLabel{{ $it['id'] }}">
                    {{ $it['judul'] }}
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="220">Kategori</th>
                        <td>{{ $it['kategori'] }}</td>
                    </tr>

                    <tr>
                        <th>Instansi</th>
                        <td>{{ $it['instansi'] }}</td>
                    </tr>

                    <tr>
                        <th>Tahun</th>
                        <td>{{ $it['tahun'] }}</td>
                    </tr>

                    <tr>
                        <th>Ukuran</th>
                        <td>{{ $it['ukuran'] }}</td>
                    </tr>

                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $it['keterangan'] }}</td>
                    </tr>

                </table>

                <iframe
                    src="{{ $it['link'] }}"
                    width="100%"
                    height="700"
                    frameborder="0">
                </iframe>

            </div>

            <div class="modal-footer">

                <a href="{{ $it['link'] }}"
                   target="_blank"
                   class="btn btn-primary">
                    Buka PDF
                </a>

                <a href="{{ $it['link'] }}"
                   download
                   class="btn btn-success">
                    Download PDF
                </a>

            </div>

        </div>

    </div>

</div>


@endforeach


