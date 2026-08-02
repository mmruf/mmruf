@extends('layouts.admin')

@section('title', 'Tambah Life Years')
@section('page_heading', 'Tambah Life Years')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- BREADCRUMB & HEADER -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.life-years.index') }}" 
           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-rose-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Life Years
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        
        <!-- HEADER CARD -->
        <div class="p-6 bg-rose-950 text-white border-b border-rose-900">
            <h2 class="text-lg font-bold">Form Tambah Perjalanan Tahun (Life Year)</h2>
            <p class="text-xs text-rose-200/80 mt-1">Tambahkan catatan penting atau momen bersejarah pada tahun tertentu dalam perjalanan hidup Anda.</p>
        </div>

        <!-- BODY FORM -->
        <form action="{{ route('admin.life-years.store') }}" 
              method="POST" 
              class="p-6 space-y-6">
            @csrf

            <!-- TAHUN (YEAR - INPUT MANUAL) -->
            <div>
                <label for="year" class="block text-sm font-semibold text-slate-800 mb-2">
                    Tahun <span class="text-rose-600">*</span>
                </label>
                <input type="number" 
                       name="year" 
                       id="year" 
                       min="1900" 
                       max="2100"
                       value="{{ old('year', date('Y')) }}"
                       placeholder="Contoh: 1998" 
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('year') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none" 
                       required>
                @error('year')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- JUDUL / MOMEN UTAMA (TITLE) -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-800 mb-2">
                    Judul / Momen Utama
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}"
                       placeholder="Contoh: Lahir ke Dunia / Memulai Karir Baru / Lulus Kuliah" 
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('title') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">
                @error('title')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- RINGKASAN / DESKRIPSI (SUMMARY) -->
            <div>
                <label for="summary" class="block text-sm font-semibold text-slate-800 mb-2">
                    Ringkasan / Catatan Perjalanan (Summary)
                </label>
                <textarea name="summary" 
                          id="summary" 
                          rows="5" 
                          placeholder="Jelaskan secara ringkas peristiwa penting, pencapaian, atau refleksi Anda di tahun ini..." 
                          class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('summary') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">{{ old('summary') }}</textarea>
                @error('summary')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- FOOTER / TOMBOL SIMPAN -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.life-years.index') }}" 
                   class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                    Simpan Data
                </button>
            </div>

        </form>

    </div>

</div>
@endsection