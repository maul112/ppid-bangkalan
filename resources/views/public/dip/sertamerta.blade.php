@extends('layouts.publik')

@section('content')
    <x-public-dip-table 
        title="Informasi Serta Merta" 
        description="Informasi publik yang dapat mengancam hajat hidup orang banyak dan ketertiban umum dan wajib diumumkan secara serta merta tanpa penundaan."
        :dips="$dips" 
    />
@endsection