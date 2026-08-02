@extends('layouts.public')

@section('title', 'Peristiwa Kehidupan - MMRUF')

@section('content')
@php
    $firstYearId = $lifeYears->first()?->id ?? 0;
@endphp

<div class="max-w-6xl mx-auto space-y-10" 
     x-data="{ 
         activeYear: {{ $firstYearId }}, 
         activePhoto: null,
         activeEvent: null, // Menyimpan object/data event yang sedang dibuka di modal detail
         scrollToActive(el) {
             el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
         }
     }">

    <!-- Header Halaman -->
    <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-rose-50 border border-rose-200/60 text-[#800020] rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#800020] animate-pulse"></span>
            Jejak Langkah
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Peristiwa Kehidupan</h1>
        <p class="text-slate-600 text-sm md:text-base leading-relaxed">
            Menjelajahi setiap babak cerita, pencapaian, dan kenangan indah yang terukir dari tahun ke tahun.
        </p>
    </div>

    <!-- 1. DERETAN TAHUN (SCROLLABLE TAB BARIS HORIZONTAL) -->
    @if($lifeYears->isNotEmpty())
        <div class="relative group/tabs" x-data="{ 
            scrollLeft() { $refs.yearContainer.scrollBy({ left: -250, behavior: 'smooth' }) },
            scrollRight() { $refs.yearContainer.scrollBy({ left: 250, behavior: 'smooth' }) }
        }">
            <!-- Tombol Scroll Kiri (Desktop) -->
            <button @click="scrollLeft()" 
                    type="button"
                    class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-20 w-10 h-10 rounded-full bg-white/90 border border-slate-200 text-slate-700 hover:text-[#800020] hover:bg-rose-50 shadow-md items-center justify-center transition-all duration-200"
                    aria-label="Scroll Kiri">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <!-- Container List Tahun -->
            <div x-ref="yearContainer" 
                 class="flex items-center gap-3 overflow-x-auto py-3 px-2 no-scrollbar scroll-smooth w-full">
                @foreach($lifeYears as $yearGroup)
                    <button @click="activeYear = {{ $yearGroup->id }}; scrollToActive($el)"
                            :class="activeYear === {{ $yearGroup->id }} 
                                ? 'bg-[#800020] text-white shadow-lg shadow-rose-950/20 scale-105 border-[#800020]' 
                                : 'bg-white text-slate-700 hover:border-[#800020]/50 hover:text-[#800020] border-slate-200/80 shadow-sm hover:shadow'"
                            class="group relative flex flex-col items-center justify-center min-w-[100px] sm:min-w-[115px] px-4 py-3 rounded-2xl border-2 font-bold transition-all duration-200 shrink-0 cursor-pointer select-none">
                        
                        <span class="text-xl sm:text-2xl font-black tracking-tight whitespace-nowrap">
                            {{ $yearGroup->year }}
                        </span>
                        
                        <span class="text-[10px] font-semibold opacity-80 whitespace-nowrap mt-0.5">
                            {{ $yearGroup->events->count() }} Event
                        </span>

                        <div x-show="activeYear === {{ $yearGroup->id }}" 
                             class="absolute bottom-0 inset-x-3 h-1 bg-rose-300 rounded-t-full"></div>
                    </button>
                @endforeach
            </div>

            <!-- Tombol Scroll Kanan (Desktop) -->
            <button @click="scrollRight()" 
                    type="button"
                    class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-20 w-10 h-10 rounded-full bg-white/90 border border-slate-200 text-slate-700 hover:text-[#800020] hover:bg-rose-50 shadow-md items-center justify-center transition-all duration-200"
                    aria-label="Scroll Kanan">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    @endif

    <!-- 2. KONTEN PERISTIWA (CONTAINER TAHUN AKTIF) -->
    <div class="space-y-8">
        @forelse($lifeYears as $yearGroup)
            <div x-show="activeYear === {{ $yearGroup->id }}"
                 x-cloak
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-6">

                <!-- Header Informasi Tahun Banner -->
                <div class="relative overflow-hidden bg-gradient-to-br from-white via-rose-50/30 to-white rounded-3xl border border-rose-100 p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-1 relative z-10">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl md:text-4xl font-black text-[#800020]">{{ $yearGroup->year }}</span>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800">{{ $yearGroup->title }}</h2>
                        </div>
                        @if($yearGroup->summary)
                            <p class="text-slate-600 text-sm md:text-base max-w-3xl pt-1">{{ $yearGroup->summary }}</p>
                        @endif
                    </div>
                    
                    <span class="absolute -right-4 -bottom-6 text-8xl font-black text-rose-950/5 select-none pointer-events-none">
                        {{ $yearGroup->year }}
                    </span>
                </div>

                <!-- LIST PERISTIWA (PREVIEW CARD) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($yearGroup->events as $event)
                        @php
                            $firstPhoto = $event->photos->first();
                            // Data Event disiapkan dalam format JSON untuk Alpine.js
                            $eventData = [
                                'id' => $event->id,
                                'title' => $event->title,
                                'date' => $event->formatted_date,
                                'category' => $event->category,
                                'description' => $event->description,
                                'photos' => $event->photos->map(fn($p) => [
                                    'url' => $p->photo_url,
                                    'caption' => $p->caption
                                ])->values()
                            ];
                        @endphp
                        
                        <div @click="activeEvent = {{ json_encode($eventData) }}"
                             class="group bg-white rounded-3xl border border-slate-200/80 hover:border-rose-300 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-5 cursor-pointer flex flex-col justify-between space-y-4">
                            
                            <div class="space-y-3">
                                <!-- Tanggal & Kategori -->
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#800020] bg-rose-50 border border-rose-100 px-2.5 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $event->formatted_date }}
                                    </span>
                                    @if($event->category)
                                        <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full">
                                            {{ $event->category }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Judul Peristiwa -->
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#800020] transition-colors line-clamp-2">
                                    {{ $event->title }}
                                </h3>
                            </div>

                            <!-- Thumbnail Foto Utama & Tombol Detail -->
                            <div class="flex items-center justify-between gap-3 pt-2 border-t border-slate-100">
                                @if($firstPhoto)
                                    <div class="relative w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                                        <img src="{{ $firstPhoto->photo_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                        @if($event->photos->count() > 1)
                                            <span class="absolute bottom-0.5 right-0.5 px-1 rounded bg-black/70 text-white text-[9px] font-bold">
                                                +{{ $event->photos->count() - 1 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">Tanpa Foto</span>
                                @endif

                                <span class="inline-flex items-center gap-1 text-xs font-bold text-[#800020] group-hover:underline">
                                    Lihat Detail
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-3xl border border-rose-100 p-10 text-center text-slate-400 italic">
                            Belum ada peristiwa yang dicatatkan pada tahun {{ $yearGroup->year }}.
                        </div>
                    @endforelse
                </div>

            </div>
        @empty
            <div class="bg-white p-12 rounded-3xl border border-rose-100 text-center space-y-3">
                <p class="text-slate-500 font-medium">Belum ada data peristiwa kehidupan.</p>
            </div>
        @endforelse
    </div>

    <!-- 3. MODAL DETAIL PERISTIWA (ALPINE.JS) -->
    <div x-show="activeEvent" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="activeEvent = null"
         @keydown.escape.window="activeEvent = null"
         class="fixed inset-0 z-[9999] bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6 overflow-y-auto">
        
        <div class="relative bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden my-auto"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <!-- Modal Header -->
            <div class="flex items-start justify-between gap-4 p-6 border-b border-slate-100 bg-slate-50/50">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span x-text="activeEvent?.date" class="text-xs font-bold text-[#800020] bg-rose-50 border border-rose-100 px-2.5 py-0.5 rounded-full"></span>
                        <template x-if="activeEvent?.category">
                            <span x-text="activeEvent?.category" class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full"></span>
                        </template>
                    </div>
                    <h3 x-text="activeEvent?.title" class="text-xl sm:text-2xl font-bold text-slate-900 leading-snug"></h3>
                </div>

                <!-- Close Button -->
                <button @click="activeEvent = null" 
                        class="w-9 h-9 rounded-full bg-slate-200/60 hover:bg-rose-100 text-slate-500 hover:text-[#800020] flex items-center justify-center transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Content (Scrollable Body) -->
            <div class="p-6 overflow-y-auto space-y-6">
                <!-- Deskripsi Peristiwa -->
                <template x-if="activeEvent?.description">
                    <div class="space-y-2">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi / Catatan</h4>
                        <p x-text="activeEvent?.description" class="text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line bg-rose-50/30 p-4 rounded-2xl border border-rose-100/60"></p>
                    </div>
                </template>

                <!-- Galeri Foto Peristiwa -->
                <template x-if="activeEvent?.photos && activeEvent?.photos.length > 0">
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Dokumentasi Foto (<span x-text="activeEvent?.photos.length"></span>)
                        </h4>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <template x-for="(photo, index) in activeEvent?.photos" :key="index">
                                <div @click="activePhoto = { url: photo.url, caption: photo.caption, eventTitle: activeEvent?.title }"
                                     class="group/photo relative aspect-[4/3] rounded-2xl overflow-hidden cursor-pointer bg-slate-100 border border-slate-200 shadow-2xs hover:shadow-md transition-all duration-200">
                                    
                                    <img :src="photo.url" :alt="photo.caption || activeEvent?.title" class="w-full h-full object-cover group-hover/photo:scale-105 transition-transform duration-300">
                                    
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/photo:opacity-100 transition-opacity flex items-end p-2">
                                        <span x-text="photo.caption || 'Perbesar Foto'" class="text-white text-xs truncate"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex justify-end">
                <button @click="activeEvent = null" 
                        class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- 4. MODAL LIGHTBOX FOTO (GAMPANG DIPERBESAR SAAT FOTO DI MODAL DIKLIK) -->
    <div x-show="activePhoto" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="activePhoto = null"
         @keydown.escape.window="activePhoto = null"
         class="fixed inset-0 z-[10000] bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4 md:p-8">
        
        <div class="relative max-w-5xl w-full flex flex-col items-center space-y-4">
            <button @click="activePhoto = null" 
                    class="self-end inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 text-white font-semibold text-xs tracking-wide backdrop-blur-md border border-white/10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Tutup (Esc)
            </button>

            <div class="relative rounded-2xl overflow-hidden border border-white/10 shadow-2xl bg-black/40 max-h-[75vh]">
                <img :src="activePhoto?.url" 
                     :alt="activePhoto?.caption || activePhoto?.eventTitle" 
                     class="max-h-[75vh] w-auto object-contain">
            </div>

            <div x-show="activePhoto?.caption || activePhoto?.eventTitle" 
                 class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 text-center max-w-2xl w-full space-y-1">
                <h4 x-text="activePhoto?.eventTitle" class="text-rose-300 font-bold text-xs uppercase tracking-wider"></h4>
                <p x-text="activePhoto?.caption" class="text-white text-sm leading-relaxed"></p>
            </div>
        </div>
    </div>

</div>

<!-- CSS Scrollbar Hide -->
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection
