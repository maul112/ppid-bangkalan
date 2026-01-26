<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PermohonanController extends Controller
{
    public function create() { return view('permohonan.formulir'); }

    public function store(Request $request)
    {
        // Validasi diperbarui: opd_tujuan dihapus dari daftar required
        $request->validate([
            'nama_pemohon'      => 'required|string|max:255',
            'nik'               => 'required|digits:16',
            'alamat'            => 'required|string',
            'email'             => 'required|email',
            'no_hp'             => 'required|string',
            'foto_ktp'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh'   => 'required',
            'cara_mendapatkan'  => 'required',
        ]);

        $nama_file_ktp = null;
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $nama_file_ktp = 'KTP-' . time() . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = public_path('uploads/ktp');
            if (!File::exists($tujuan_upload)) { File::makeDirectory($tujuan_upload, 0755, true); }
            $file->move($tujuan_upload, $nama_file_ktp);
        }

        $nomor_tiket = 'REQ-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        
        $permohonan = Permohonan::create([
            'user_id'           => auth()->id(),
            'nomor_tiket'       => $nomor_tiket,
            'nama_pemohon'      => $request->nama_pemohon,
            'nik'               => $request->nik,
            'alamat'            => $request->alamat,
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'foto_ktp'          => $nama_file_ktp,
            // 'opd_tujuan' sengaja dikosongkan agar Admin yang menentukan nanti
            'opd_tujuan'        => null, 
            'rincian_informasi' => $request->rincian_informasi,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'cara_memperoleh'   => $request->cara_memperoleh,
            'cara_mendapatkan'  => $request->cara_mendapatkan,
            'status'            => 'pending',
        ]);

        return redirect()->route('permohonan.show', ['nomor_tiket' => $permohonan->nomor_tiket])
            ->with('success', 'Permohonan Berhasil Dikirim!');
    }

    public function show($nomor_tiket)
    {
        $permohonan = Permohonan::where('nomor_tiket', $nomor_tiket)->firstOrFail();
        return view('permohonan.show', compact('permohonan'));
    }

    public function cek(Request $request)
    {
        // nik perlu atau tidak? karena tidak ada inputan nik
        $request->validate([
            'nomor_tiket' => 'required|string',
            // 'nik'         => 'required|digits:16',
        ], [
            // 'nik.digits' => 'NIK harus berjumlah 16 digit.',
            // 'nik.required' => 'NIK wajib diisi untuk melihat detail.'
        ]);

        $permohonan = Permohonan::where('nomor_tiket', $request->nomor_tiket)
                                // ->where('nik', $request->nik)
                                ->first();
        if (!$permohonan) {
            return back()->with('error', 'Maaf, kombinasi Nomor Tiket dan NIK tidak ditemukan.');
        }

        return redirect()->route('permohonan.show', $permohonan->nomor_tiket);
    }

    public function index()
    {
        if (auth()->check()) {
            $permohonans = Permohonan::where('email', auth()->user()->email)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
            return view('dashboard', compact('permohonans'));
        }
        return redirect()->route('login');
    }
    
    public function daftarPublik(Request $request)
    {
        $query = Permohonan::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                  ->orWhere('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('rincian_informasi', 'like', "%{$search}%");
            });
        }

        $permohonans = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('permohonan.partials.daftar_publik_table', compact('permohonans'))->render(),
                'pagination' => $permohonans->appends(['search' => $request->search])->links()->render()
            ]);
        }

        return view('permohonan.daftar_publik', compact('permohonans'));
    }
}