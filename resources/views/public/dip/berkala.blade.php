@extends('layouts.publik')

@section('content')
    <x-public-dip-table 
        title="Informasi Berkala" 
        description="Informasi publik yang wajib disediakan dan diumumkan secara berkala oleh Pemerintah Kabupaten Bangkalan."
        :dips="$dips" 
    />
@endsection