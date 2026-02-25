@extends('layouts.guest')

@section('title', 'Dashboard')
@section('content')

    <div x-data="{ hovered: false }" class="text-center">
        <div class="relative inline-block">
            <button @mouseenter="hovered = true" @mouseleave="hovered = false"
                @click="window.location.href='{{ route('login') }}'"
                class="group relative px-10 py-5 bg-white text-slate-900 font-black text-xl rounded-2xl overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)]">
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-blue-400/30 to-transparent -translate-x-full group-hover:animate-shimmer">
                </div>

                <span class="relative flex items-center gap-3">
                    MEMULAI PEKERJAAN
                    <svg class="w-6 h-6 transition-transform duration-300 group-hover:translate-x-2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </span>
            </button>

            <div x-show="hovered" x-transition.opacity class="absolute -inset-2 bg-blue-500/20 blur-2xl rounded-full -z-10">
            </div>
        </div>
    </div>
@endsection
