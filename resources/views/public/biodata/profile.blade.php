@extends('layouts.public')
@section('title', 'Profile Personal')
@section('content')

    <div class="max-w-4xl mx-auto px-6">

        <!-- Tombol Kembali / Breadcrumb Navigasi -->
        <div class="mb-8">
            <a href="{{ route('public.biodata.index') }}" 
               class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-rose-900 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Menu Utama
            </a>
        </div>

        <!-- Main Card Container -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden">
            
            <!-- Header Banner Aksen Maroon -->
            <div class="h-32 bg-gradient-to-r from-rose-950 via-rose-900 to-rose-800 relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent"></div>
            </div>

            <div class="px-6 md:px-10 pb-10">
                <!-- Top Section: Foto Profile & Nama -->
                <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6 -mt-16 mb-8 text-center sm:text-left">
                    
                    <!-- Foto Profile dengan Ring Highlight -->
                    <div class="relative group">
                        <div class="w-32 h-32 md:w-36 md:h-36 rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-slate-100 flex items-center justify-center">
                            @if($profile->photo)
                                <img src="{{ asset('storage/' . $profile->photo) }}" 
                                     alt="{{ $profile->full_name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-rose-50 text-rose-800 flex items-center justify-center">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Nama & Badge -->
                    <div class="sm:mb-2 space-y-1">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-800 text-xs font-bold tracking-wider uppercase border border-rose-100">
                            Data Pribadi
                        </div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
                            {{ $profile->full_name }}
                        </h1>
                    </div>
                </div>

                <hr class="border-slate-100 my-6">

                <!-- Grid Data Detail -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Kartu Info: Tempat & Tanggal Lahir -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4 hover:border-rose-200 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-rose-100/70 text-rose-900 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-400 block mb-0.5">Tempat, Tanggal Lahir</span>
                            <p class="text-base font-semibold text-slate-800">
                                {{ $profile->place_of_birth }}, {{ \Carbon\Carbon::parse($profile->date_of_birth)->isoFormat('D MMMM Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- KARTU BARU: UMUR (Dihitung Otomatis dari date_of_birth) -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4 hover:border-rose-200 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-rose-100/70 text-rose-900 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-400 block mb-0.5">Umur</span>
                            <p class="text-base font-semibold text-slate-800">
                                {{ \Carbon\Carbon::parse($profile->date_of_birth)->age }} Tahun
                            </p>
                        </div>
                    </div>

                    <!-- Kartu Info: Telepon / WhatsApp dengan Tombol Aksi -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start justify-between gap-4 hover:border-rose-200 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-100/70 text-rose-900 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-medium uppercase tracking-wider text-slate-400 block mb-0.5">Nomor Telepon</span>
                                <p class="text-base font-semibold text-slate-800">
                                    {{ $profile->phone ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Tombol Direct WhatsApp (Jika nomor tersedia) -->
                        @if($profile->phone)
                            @php
                                // Mengubah awalan '08' menjadi '628' agar siap dipakai di link WhatsApp
                                $waNumber = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $profile->phone));
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" 
                               class="shrink-0 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white rounded-lg border border-emerald-200 text-xs font-semibold transition-all flex items-center gap-1.5"
                               title="Hubungi via WhatsApp">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                WhatsApp
                            </a>
                        @endif
                    </div>

                    <!-- Kartu Info: Email -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4 hover:border-rose-200 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-rose-100/70 text-rose-900 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-400 block mb-0.5">Email</span>
                            <p class="text-base font-semibold text-slate-800">
                                {{ $profile->email ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Kartu Info: Alamat (Span Full 2 Kolom agar lebih lapang) -->
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-start gap-4 hover:border-rose-200 transition-colors md:col-span-2">
                        <div class="w-10 h-10 rounded-xl bg-rose-100/70 text-rose-900 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-400 block mb-0.5">Alamat Lengkap</span>
                            <p class="text-base font-semibold text-slate-800 leading-relaxed">
                                {{ $profile->address ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection