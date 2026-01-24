<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Permohonan - PPID</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8 text-center bg-red-600 text-white">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-black tracking-tight">Lacak Permohonan</h1>
                <p class="text-red-100 text-sm mt-1">Masukkan nomor tiket untuk cek status</p>
            </div>

            <div class="p-8">
                <form action="{{ route('permohonan.cek') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nomor Tiket</label>
                        <input type="text" name="nomor_tiket" required placeholder="Contoh: REQ-2026xxxx" 
                               class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-red-500 focus:border-red-500 font-mono text-gray-700">
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 rounded-2xl hover:bg-red-600 transition shadow-lg flex items-center justify-center gap-2">
                        LACAK SEKARANG
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-gray-400 hover:text-red-600 transition">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>