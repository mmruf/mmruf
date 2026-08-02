@extends('layouts.public')
@section('title', 'Biodata')
@section('content')

    <div class="max-w-5xl mx-auto px-6 py-12" x-data="{ activeCard: null }">

        <!-- Heading Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                Biodata <span class="text-rose-900">Personal</span>
            </h1>
            <p class="text-slate-500 text-sm md:text-base mt-2">
                Pilih kategori di bawah untuk melihat rincian informasi.
            </p>
        </div>

        <!-- Grid Card Persegi (Square Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">

            <!-- CARD 1: PROFILE / PERKENALAN DIRI (Aksen Maroon Utama) -->
            <a href="{{ route('public.biodata.profile') }}" @mouseenter="activeCard = 'profile'"
                @mouseleave="activeCard = null"
                class="group relative aspect-square bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-rose-900/30 transition-all duration-300 flex flex-col justify-between overflow-hidden">

                <!-- Accent Corner Blur Effect -->
                <div
                    class="absolute -top-12 -right-12 w-28 h-28 bg-rose-100/70 rounded-full blur-2xl group-hover:bg-rose-200/80 transition-all duration-300">
                </div>

                <!-- Top Icon -->
                <div
                    class="w-12 h-12 rounded-xl bg-rose-50 text-rose-900 flex items-center justify-center border border-rose-100 group-hover:scale-110 group-hover:bg-rose-900 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <!-- Bottom Content -->
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-rose-800 block mb-1">Overview</span>
                    <h2 class="text-xl font-bold text-slate-800 group-hover:text-rose-900 transition-colors">
                        Profile
                    </h2>
                    <p class="text-slate-400 text-xs mt-1">Perkenalan & data diri</p>
                </div>

                <!-- Bottom Right Arrow Indicator -->
                <div
                    class="absolute bottom-5 right-5 text-slate-300 group-hover:text-rose-900 group-hover:translate-x-1 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>
            </a>

            <!-- CARD 2: PENDIDIKAN (Aksen Warm Amber / Gold) -->
            <a href="{{ route('public.biodata.educations') }}" @mouseenter="activeCard = 'education'"
                @mouseleave="activeCard = null"
                class="group relative aspect-square bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-amber-400/40 transition-all duration-300 flex flex-col justify-between overflow-hidden">

                <!-- Accent Corner Blur Effect -->
                <div
                    class="absolute -top-12 -right-12 w-28 h-28 bg-amber-100/70 rounded-full blur-2xl group-hover:bg-amber-200/80 transition-all duration-300">
                </div>

                <!-- Top Icon -->
                <div
                    class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100 group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>

                <!-- Bottom Content -->
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-amber-700 block mb-1">Akademik</span>
                    <h2 class="text-xl font-bold text-slate-800 group-hover:text-amber-700 transition-colors">
                        Pendidikan
                    </h2>
                    <p class="text-slate-400 text-xs mt-1">Riwayat sekolah & studi</p>
                </div>

                <!-- Bottom Right Arrow Indicator -->
                <div
                    class="absolute bottom-5 right-5 text-slate-300 group-hover:text-amber-600 group-hover:translate-x-1 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>
            </a>

            <!-- CARD 3: PEKERJAAN (Aksen Crimson / Dark Coral) -->
            <a href="{{ route('public.biodata.experiences') }}" @mouseenter="activeCard = 'experience'"
                @mouseleave="activeCard = null"
                class="group relative aspect-square bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-red-400/40 transition-all duration-300 flex flex-col justify-between overflow-hidden">

                <!-- Accent Corner Blur Effect -->
                <div
                    class="absolute -top-12 -right-12 w-28 h-28 bg-red-100/70 rounded-full blur-2xl group-hover:bg-red-200/80 transition-all duration-300">
                </div>

                <!-- Top Icon -->
                <div
                    class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center border border-red-100 group-hover:scale-110 group-hover:bg-red-700 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                <!-- Bottom Content -->
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-red-700 block mb-1">Karir</span>
                    <h2 class="text-xl font-bold text-slate-800 group-hover:text-red-700 transition-colors">
                        Pekerjaan
                    </h2>
                    <p class="text-slate-400 text-xs mt-1">Pengalaman kerja & karir</p>
                </div>

                <!-- Bottom Right Arrow Indicator -->
                <div
                    class="absolute bottom-5 right-5 text-slate-300 group-hover:text-red-700 group-hover:translate-x-1 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>
            </a>

        </div>

    </div>
@endsection