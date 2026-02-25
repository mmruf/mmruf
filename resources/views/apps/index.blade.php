@extends('layouts.guest')

@section('title', 'Aplikasi Saya')

@section('content')

    <div class="max-w-5xl w-full">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-3">Pilih Aplikasi</h2>
            <p class="text-4xl font-extrabold text-slate-900 tracking-tight">Apa yang ingin Anda kerjakan?</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 fade-in-up" style="animation-delay: 0.2s">

            <a href="#"
                class="group relative bg-white border border-slate-200 p-8 rounded-[2rem] flex flex-col items-center justify-center transition-all duration-300 hover:border-blue-500 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-slate-50 text-slate-900 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Timer</span>
            </a>

            <a href="#"
                class="group relative bg-white border border-slate-200 p-8 rounded-[2rem] flex flex-col items-center justify-center transition-all duration-300 hover:border-emerald-500 hover:shadow-2xl hover:shadow-emerald-100 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-slate-50 text-slate-900 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">Kalkulator</span>
            </a>

            <a href="#"
                class="group relative bg-white border border-slate-200 p-8 rounded-[2rem] flex flex-col items-center justify-center transition-all duration-300 hover:border-orange-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-slate-50 text-slate-900 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">Skor Voli</span>
            </a>

            <a href="{{ route('apps.love') }}"
                class="group relative bg-white border border-slate-200 p-8 rounded-[2rem] flex flex-col items-center justify-center transition-all duration-300 hover:border-rose-500 hover:shadow-2xl hover:shadow-rose-100 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-slate-50 text-slate-900 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="font-bold text-slate-800 group-hover:text-rose-600 transition-colors text-center">Cek
                    Cinta</span>
            </a>

        </div>
    </div>
@endsection
