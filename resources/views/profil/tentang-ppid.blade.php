@extends('layouts/publik')

@section('content')
    {{-- HERO / HEADER --}}
    <section class="relative overflow-hidden bg-sky-100">
        {{-- dekorasi (opsional) --}}
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -top-16 -left-16 h-44 w-44 rounded-full bg-sky-200/60 blur-2xl"></div>
            <div class="absolute top-10 right-10 h-24 w-24 rounded-xl bg-sky-300/40 rotate-12"></div>
            <div class="absolute bottom-8 left-1/3 h-3 w-28 bg-sky-300/60 rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="text-center">
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-800">
                    Tentang PPID
                </h1>

                <div class="mt-4 inline-flex items-center justify-center">
                    <span class="px-4 py-2 rounded-md bg-yellow-400 text-slate-900 text-sm font-semibold shadow">
                        Pengertian PPID Kabupaten Bangkalan
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                    <div class="p-6 sm:p-8">
                        <h2 class="text-sm font-semibold text-slate-700">
                            Seputar PPID Kabupaten Bangkalan
                        </h2>

                        <div class="mt-5 space-y-4 text-slate-700 leading-relaxed text-sm sm:text-base">
                            <p>
                                (Isi penjelasan tentang PPID kamu taruh di sini. Bisa berupa beberapa paragraf.)
                            </p>
                            <p>
                                (Paragraf berikutnya…)
                            </p>

                            <hr class="my-6">

                            <div class="space-y-2 text-sm">
                                <p class="font-semibold text-slate-800 uppercase tracking-wide">
                                    Sekretariat PPID Kabupaten Bangkalan
                                </p>
                                <p>Alamat: (isi alamat)</p>
                                <p>Telp: (isi telp)</p>
                                <p>Email: (isi email)</p>
                                <p>Website: (isi website)</p>

                                <div class="mt-5">
                                    <p class="font-semibold text-slate-800">Pelayanan (Di Hari & Jam Kerja)</p>
                                    <ul class="list-disc pl-5 mt-2 space-y-1">
                                        <li>Senin–Kamis: 08.00–15.00 WIB</li>
                                        <li>Jum’at: 08.00–11.00 WIB & 13.00–15.00 WIB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- jarak biar footer gak “nempel” --}}
                <div class="h-10"></div>
            </div>
        </div>
    </section>
@endsection
