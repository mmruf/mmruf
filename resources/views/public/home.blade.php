@extends('layouts.public')

@section('title', 'Home')

@section('content')
<div class="h-[calc(100vh-8rem)] flex flex-col items-center justify-center relative overflow-hidden text-center px-4">

    <!-- Ambient Glow Background -->
    <div class="absolute w-72 h-72 md:w-96 md:h-96 bg-rose-500/20 rounded-full blur-3xl animate-pulse pointer-events-none"></div>
    <div class="absolute w-48 h-48 md:w-64 md:h-64 bg-amber-500/10 rounded-full blur-2xl pointer-events-none -top-10 -right-10"></div>

    <div class="relative z-10 max-w-3xl space-y-8">
        
        <!-- Interactive Animated Branding Text -->
        <div x-data="{ 
                letters: 'MMRUF'.split(''),
                hoveredIndex: null 
             }" 
             class="flex justify-center items-center gap-2 md:gap-4 select-none">
            
            <template x-for="(letter, index) in letters" :key="index">
                <span @mouseenter="hoveredIndex = index" 
                      @mouseleave="hoveredIndex = null"
                      :class="hoveredIndex === index ? '-translate-y-3 scale-110 text-rose-600 drop-shadow-[0_10px_20px_rgba(128,0,32,0.4)]' : 'text-[#800020]'"
                      class="text-6xl sm:text-8xl md:text-9xl font-black tracking-tighter transition-all duration-300 ease-out cursor-pointer inline-block">
                    <span x-text="letter"></span>
                </span>
            </template>
        </div>

        <!-- Tagline Ringkas -->
        <div class="space-y-2">
            <h2 class="text-lg md:text-2xl font-bold text-slate-800 tracking-wide">
                Personal Space & Activity Hub
            </h2>
            <p class="text-sm md:text-base text-slate-500 font-light max-w-md mx-auto">
                Ruang resmi untuk melihat rekam jejak, biodata, dan lini masa peristiwa penting.
            </p>
        </div>

        <!-- Navigasi Utama (Button Card Minimalis) -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            
            <a href="{{ route('public.biodata.index') }}" 
               class="group relative w-full sm:w-auto px-8 py-4 bg-white border border-rose-100 rounded-2xl shadow-sm hover:shadow-xl hover:border-rose-300 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                <span class="w-2 h-2 rounded-full bg-[#800020] group-hover:scale-150 transition-transform"></span>
                <span class="font-bold text-slate-800 group-hover:text-[#800020] transition-colors">Lihat Biodata</span>
                <span class="text-slate-400 group-hover:translate-x-1 transition-transform">→</span>
            </a>

            <a href="{{ route('public.life-events.index') }}" 
               class="group relative w-full sm:w-auto px-8 py-4 bg-[#800020] text-white rounded-2xl shadow-md hover:shadow-xl hover:bg-rose-900 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                <span class="font-bold">Eksplor Life Events</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>

        </div>

    </div>

</div>
@endsection