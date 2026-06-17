<?php

namespace App\Http\Controllers;

use App\Models\Dip;
use Illuminate\Http\Request;

class PublicDipController extends Controller
{
    public function berkala()
    {
        $dips = Dip::where('kategori', 'Informasi Berkala')->latest()->paginate(10);
        return view('public.dip.berkala', compact('dips'));
    }

    public function setiapsaat()
    {
        $dips = Dip::where('kategori', 'Informasi Setiap Saat')->latest()->paginate(10);
        return view('public.dip.setiapsaat', compact('dips'));
    }

    public function sertamerta()
    {
        $dips = Dip::where('kategori', 'Informasi Serta Merta')->latest()->paginate(10);
        return view('public.dip.sertamerta', compact('dips'));
    }

    public function dikecualikan()
    {
        $dips = Dip::where('kategori', 'Informasi Dikecualikan')->latest()->paginate(10);
        return view('public.dip.dikecualikan', compact('dips'));
    }
}
