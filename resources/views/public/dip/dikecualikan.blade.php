@extends('layouts.publik')

@section('content')
    <x-public-dip-table 
        title="Informasi Dikecualikan" 
        description="Informasi publik yang tidak dapat diakses oleh pemohon informasi publik karena apabila dibuka dapat menghambat proses penegakan hukum atau membahayakan keamanan negara."
        :dips="$dips" 
    />
@endsection