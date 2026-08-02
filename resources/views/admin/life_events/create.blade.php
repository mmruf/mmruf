@extends('layouts.admin')

@section('title', 'Tambah Peristiwa Hidup')
@section('page_heading', 'Tambah Peristiwa Baru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.life-events.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-800">Form Momen Peristiwa</h3>
                <p class="text-xs text-slate-500 mt-0.5">Isi rincian informasi dan unggah foto dokumentasi terkait.</p>
            </div>

            <form action="{{ route('admin.life-events.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Life Year Dropdown -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun / Kelompok Tahun <span class="text-red-500">*</span></label>
                        <select name="life_year_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ old('life_year_id') == $year->id ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                        @error('life_year_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Peristiwa <span class="text-red-500">*</span></label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                        @error('event_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Peristiwa <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Kelulusan S1" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Pendidikan, Karir, Pribadi"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" placeholder="Tuliskan cerita singkat peristiwa ini..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Multiple Photo Upload Block -->
                <div class="border-t border-slate-100 pt-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800">Dokumentasi Foto</h4>
                            <p class="text-xs text-slate-500">Unggah satu atau beberapa foto sekaligus beserta keterangan (caption).</p>
                        </div>
                        <button type="button" id="add-photo-btn"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition">
                            + Tambah Input Foto
                        </button>
                    </div>

                    <div id="photo-inputs-container" class="space-y-4">
                        <!-- Baris Pertama Upload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">File Foto</label>
                                <input type="file" name="photos[]" accept="image/*"
                                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-800 hover:file:bg-rose-100">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Keterangan Foto (Caption)</label>
                                <input type="text" name="captions[]" placeholder="Deskripsi singkat foto"
                                    class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs focus:outline-none focus:border-rose-800">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.life-events.index') }}"
                        class="px-5 py-2.5 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-xl transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm transition border border-rose-700">
                        Simpan Peristiwa
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Script Tambah Input Foto Dinamis -->
    <script>
        document.getElementById('add-photo-btn').addEventListener('click', function() {
            const container = document.getElementById('photo-inputs-container');
            const newRow = document.createElement('div');
            newRow.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50 relative group';
            newRow.innerHTML = `
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">File Foto</label>
                    <input type="file" name="photos[]" accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-800 hover:file:bg-rose-100">
                </div>
                <div class="flex gap-2 items-end">
                    <div class="grow">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Keterangan Foto (Caption)</label>
                        <input type="text" name="captions[]" placeholder="Deskripsi singkat foto"
                            class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs focus:outline-none focus:border-rose-800">
                    </div>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="p-2 text-red-500 hover:bg-red-50 rounded-lg text-xs" title="Hapus Baris">
                        ✕
                    </button>
                </div>
            `;
            container.appendChild(newRow);
        });
    </script>
@endsection