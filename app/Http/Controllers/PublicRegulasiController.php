<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;

class PublicRegulasiController extends Controller
{
    public function index()
    {
        $regulasis = Regulasi::latest()->paginate(6);
        return view('public.layanan.regulasi', compact('regulasis'));
    }
}
