@extends('layouts.publik')

@section('content')
    <x-public-dip-table 
        title="Informasi Setiap Saat" 
        description="Informasi publik yang wajib disediakan oleh badan publik dan siap tersedia untuk bisa langsung diberikan kepada pemohon informasi kapan saja."
        :dips="$dips" 
    />
@endsection