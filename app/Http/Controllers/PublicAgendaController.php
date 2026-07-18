<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class PublicAgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::orderBy('tanggal', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $today = \Carbon\Carbon::today();
            if ($request->status == 'Hari Ini') {
                $query->whereDate('tanggal', '=', $today);
            } elseif ($request->status == 'Mendatang') {
                $query->whereDate('tanggal', '>', $today);
            } elseif ($request->status == 'Lewat') {
                $query->whereDate('tanggal', '<', $today);
            }
        }

        $agendas = $query->paginate(10);
        return view('public.layanan.agenda', compact('agendas'));
    }
}
