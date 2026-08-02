@extends('layouts.public')
@section('title', 'Riwayat Pendidikan')
@section('content')

    <div class="max-w-4xl mx-auto px-6">

        <!-- Tombol Kembali / Navigasi -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('public.biodata.index') }}" 
               class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-amber-600 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Menu Utama
            </a>
            
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold tracking-wider uppercase border border-amber-200">
                Riwayat Akademik
            </span>
        </div>

        <!-- Heading Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Pendidikan <span class="text-amber-600">Formal</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                Jejak langkah dan latar belakang pendidikan yang telah ditempuh.
            </p>
        </div>

        @if($educations->isEmpty())
            <!-- Empty State jika data belum ada -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-amber-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum ada data pendidikan</h3>
                <p class="text-slate-400 text-sm mt-1">Informasi riwayat pendidikan belum ditambahkan.</p>
            </div>
        @else
            <!-- TIMELINE CONTAINER -->
            <div class="relative pl-6 md:pl-8 border-l-2 border-amber-200/80 space-y-8 my-4">

                @foreach($educations as $edu)
                    <div class="relative group">
                        
                        <!-- Timeline Dot / Node -->
                        <div class="absolute -left-[31px] md:-left-[39px] top-2 w-5 h-5 rounded-full bg-white border-4 border-amber-500 group-hover:scale-125 group-hover:border-amber-600 transition-all duration-300 shadow-sm"></div>

                        <!-- Card Pendidikan -->
                        <div class="bg-white rounded-2xl p-6 md:p-7 border border-slate-200/80 shadow-sm hover:shadow-md hover:border-amber-300 transition-all duration-300">
                            
                            <div class="flex flex-col sm:flex-row items-start gap-5">
                                
                                <!-- Foto / Logo Instansi (Diperbesar) -->
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-amber-50/60 border border-amber-100/80 overflow-hidden shrink-0 flex items-center justify-center text-amber-600 shadow-inner">
                                    @if($edu->image)
                                        <img src="{{ asset('storage/' . $edu->image) }}" 
                                             alt="{{ $edu->school_name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <!-- Default Icon jika tidak ada gambar -->
                                        <svg class="w-12 h-12 text-amber-500/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Konten Detail -->
                                <div class="flex-1 w-full">
                                    
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                        <!-- Badge Degree & Field of Study -->
                                        <div class="flex items-center gap-2 flex-wrap">
                                            @if($edu->degree)
                                                <span class="px-2.5 py-1 rounded-lg bg-amber-100/80 text-amber-800 text-xs font-extrabold tracking-wide">
                                                    {{ $edu->degree }}
                                                </span>
                                            @endif
                                            
                                            @if($edu->field_of_study)
                                                <span class="text-xs font-semibold text-slate-500">
                                                    {{ $edu->field_of_study }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Badge Tahun (Start - End) -->
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200/80 self-start sm:self-auto">
                                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}
                                        </span>
                                    </div>

                                    <!-- Nama Sekolah -->
                                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 group-hover:text-amber-700 transition-colors">
                                        {{ $edu->school_name }}
                                    </h2>

                                    <!-- Deskripsi / Keterangan Tambahan -->
                                    @if($edu->description)
                                        <div class="mt-3 pt-3 border-t border-slate-100 text-slate-600 text-sm leading-relaxed">
                                            {!! nl2br(e($edu->description)) !!}
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