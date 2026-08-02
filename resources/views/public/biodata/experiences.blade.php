@extends('layouts.public')
@section('title', 'Pengalaman Kerja')
@section('content')

    <div class="max-w-4xl mx-auto px-6 py-12">

        <!-- Tombol Kembali / Navigasi -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('public.biodata.index') }}" 
               class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-red-700 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Menu Utama
            </a>
            
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold tracking-wider uppercase border border-red-200">
                Karir & Pengalaman
            </span>
        </div>

        <!-- Heading Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Pengalaman <span class="text-red-700">Kerja</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                Rekam jejak profesional, posisi, dan kontribusi pekerjaan yang pernah dijalani.
            </p>
        </div>

        @if($experiences->isEmpty())
            <!-- Empty State jika data belum ada -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-red-50 text-red-700 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-red-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum ada data pengalaman kerja</h3>
                <p class="text-slate-400 text-sm mt-1">Informasi riwayat pekerjaan belum ditambahkan.</p>
            </div>
        @else
            <!-- TIMELINE CONTAINER -->
            <div class="relative pl-6 md:pl-8 border-l-2 border-red-200/80 space-y-8 my-4">

                @foreach($experiences as $exp)
                    <div class="relative group">
                        
                        <!-- Timeline Dot / Node -->
                        <div class="absolute -left-[31px] md:-left-[39px] top-2 w-5 h-5 rounded-full bg-white border-4 {{ $exp->is_current ? 'border-emerald-500 ring-4 ring-emerald-100' : 'border-red-600' }} group-hover:scale-125 transition-all duration-300 shadow-sm"></div>

                        <!-- Card Pekerjaan -->
                        <div class="bg-white rounded-2xl p-6 md:p-7 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-red-300 transition-all duration-300">
                            
                            <div class="flex flex-col sm:flex-row items-start gap-5">
                                
                                <!-- Foto / Logo Perusahaan (Ukuran Besar) -->
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-red-50/60 border border-red-100/80 overflow-hidden shrink-0 flex items-center justify-center text-red-700 shadow-inner">
                                    @if($exp->image)
                                        <img src="{{ asset('storage/' . $exp->image) }}" 
                                             alt="{{ $exp->company_name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <!-- Default Icon Gedung/Kantor -->
                                        <svg class="w-12 h-12 text-red-600/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Konten Detail -->
                                <div class="flex-1 w-full">
                                    
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-1.5">
                                        
                                        <!-- Jabatan / Position -->
                                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 group-hover:text-red-700 transition-colors">
                                            {{ $exp->position }}
                                        </h2>

                                        <!-- Badge Status Periode / Current Job -->
                                        <div class="flex items-center gap-2 self-start sm:self-auto">
                                            @if($exp->is_current)
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-extrabold border border-emerald-200">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    Masih Bekerja
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200/80">
                                                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $exp->start_date }} - {{ $exp->end_date ?? 'Sekarang' }}
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <!-- Nama Instansi / Perusahaan -->
                                    <div class="flex items-center gap-2 text-slate-600 font-semibold text-sm mb-3">
                                        <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $exp->company_name }}</span>

                                        @if($exp->is_current)
                                            <span class="text-xs text-slate-400 font-normal">({{ $exp->start_date }} - Sekarang)</span>
                                        @endif
                                    </div>

                                    <!-- Deskripsi Tugas / Jobdesk -->
                                    @if($exp->description)
                                        <div class="mt-3 pt-3 border-t border-slate-100 text-slate-600 text-sm leading-relaxed">
                                            {!! nl2br(e($exp->description)) !!}
                                        </div>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>

@endsection