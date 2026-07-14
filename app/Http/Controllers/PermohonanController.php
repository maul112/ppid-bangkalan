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
            'pekerjaan'         => 'required|string',
            'alamat'            => 'required|string',
            'email'             => 'required|email',
            'no_hp'             => 'required|string',
            'foto_ktp'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh'   => 'required',
            'cara_mendapatkan'  => 'required',
            'file_pendukung'    => 'nullable|file|max:10240', // Max 10MB
            'terms'             => 'accepted',
        ], [
            'nama_pemohon.required' => 'Nama lengkap wajib diisi.',
            'nama_pemohon.max' => 'Nama lengkap maksimal 255 karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_hp.required' => 'Nomor HP/Telepon wajib diisi.',
            'foto_ktp.required' => 'Foto KTP wajib dilampirkan.',
            'foto_ktp.image' => 'File KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Format foto KTP harus jpeg, png, atau jpg.',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2MB.',
            'rincian_informasi.required' => 'Rincian informasi yang dibutuhkan wajib diisi.',
            'tujuan_penggunaan.required' => 'Tujuan penggunaan informasi wajib diisi.',
            'cara_memperoleh.required' => 'Cara memperoleh informasi wajib dipilih.',
            'cara_mendapatkan.required' => 'Cara mendapatkan salinan informasi wajib dipilih.',
            'file_pendukung.file' => 'File pendukung harus berupa file.',
            'file_pendukung.max' => 'Ukuran file pendukung maksimal 10MB.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        $nama_file_ktp = null;
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $nama_file_ktp = 'KTP-' . time() . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = public_path('uploads/ktp');
            if (!File::exists($tujuan_upload)) { File::makeDirectory($tujuan_upload, 0755, true); }
            $file->move($tujuan_upload, $nama_file_ktp);
        }

        $nama_file_pendukung = null;
        if ($request->hasFile('file_pendukung')) {
            $file_pendukung = $request->file('file_pendukung');
            $nama_file_pendukung = 'PENDUKUNG-' . time() . '-' . Str::random(5) . '.' . $file_pendukung->getClientOriginalExtension();
            $tujuan_upload_pendukung = public_path('uploads/permohonan/pendukung');
            if (!File::exists($tujuan_upload_pendukung)) { File::makeDirectory($tujuan_upload_pendukung, 0755, true); }
            $file_pendukung->move($tujuan_upload_pendukung, $nama_file_pendukung);
        }

        $nomor_tiket = 'REQ-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        
        $permohonan = Permohonan::create([
            'user_id'           => auth()->id(),
            'nomor_tiket'       => $nomor_tiket,
            'nama_pemohon'      => $request->nama_pemohon,
            'nik'               => $request->nik,
            'pekerjaan'         => $request->pekerjaan,
            'alamat'            => $request->alamat,
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'foto_ktp'          => $nama_file_ktp,
            'file_pendukung'    => $nama_file_pendukung,
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
        $request->validate([
            'nomor_tiket' => 'required|string',
            'nik'         => 'required|digits:16',
        ], [
            'nik.digits' => 'NIK harus berjumlah 16 digit.',
            'nik.required' => 'NIK wajib diisi untuk melihat detail.'
        ]);

        $permohonan = Permohonan::where('nomor_tiket', $request->nomor_tiket)
                                ->where('nik', $request->nik)
                                ->first();
        if (!$permohonan) {
            return back()->with('error', 'Maaf, verifikasi gagal. NIK tidak cocok dengan pemilik tiket ini.');
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
    
    public function layananInformasi(Request $request)
    {
        // 1. Hitung Statistik
        $total_permohonan = Permohonan::count();
        $diproses = Permohonan::whereIn('status', ['pending', 'proses'])->count();
        $selesai = Permohonan::whereIn('status', ['selesai', 'diterima'])->count();
        $ditolak = Permohonan::where('status', 'ditolak')->count();

        // 2. Ambil data permohonan untuk tabel
        $query = Permohonan::with('opds');

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

        return view('public.layanan.permohonan-informasi', compact(
            'permohonans', 'total_permohonan', 'diproses', 'selesai', 'ditolak'
        ));
    }
}