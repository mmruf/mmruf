@extends('layouts.admin')

@section('title', 'Edit Peristiwa Hidup')
@section('page_heading', 'Edit Peristiwa')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.life-events.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- FOTO YANG SUDAH TERSEDIA (MODUL KELOLA FOTO INDIVIDUAL) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <h4 class="text-sm font-bold text-slate-800">Foto Terupload</h4>
            @if ($lifeEvent->photos->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($lifeEvent->photos as $photo)
                        <div class="relative group border border-slate-200 rounded-xl overflow-hidden bg-slate-50">
                            <img src="{{ $photo->photo_url }}" alt="Dokumentasi" class="w-full h-32 object-cover">
                            @if ($photo->caption)
                                <div class="p-2 text-xs text-slate-600 truncate bg-white border-t border-slate-100">
                                    {{ $photo->caption }}
                                </div>
                            @endif
                            <!-- Tombol Hapus Individual -->
                            <form action="{{ route('admin.life-event-photos.destroy', $photo->id) }}" method="POST"
                                class="absolute top-2 right-2"
                                onsubmit="return confirm('Hapus foto ini dari peristiwa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-1.5 bg-red-600 text-white rounded-lg opacity-90 hover:opacity-100 shadow transition"
                                    title="Hapus foto ini">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-400 italic">Belum ada foto yang diunggah untuk peristiwa ini.</p>
            @endif
        </div>

        <!-- FORM UPDATE DATA -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-800">Edit Data Peristiwa</h3>
            </div>

            <form action="{{ route('admin.life-events.update', $lifeEvent->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Life Year Dropdown -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun / Kelompok Tahun <span class="text-red-500">*</span></label>
                        <select name="life_year_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ old('life_year_id', $lifeEvent->life_year_id) == $year->id ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Peristiwa <span class="text-red-500">*</span></label>
                        <input type="date" name="event_date" value="{{ old('event_date', optional($lifeEvent->event_date)->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Peristiwa <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $lifeEvent->title) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $lifeEvent->category) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-800 text-sm">{{ old('description', $lifeEvent->description) }}</textarea>
                </div>

                <!-- Tambah Foto Baru -->
                <div class="border-t border-slate-100 pt-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800">Tambah Foto Tambahan</h4>
                            <p class="text-xs text-slate-500">Pilih foto baru jika ingin menambahkan dokumentasi ekstra.</p>
                        </div>
                        <button type="button" id="add-photo-btn"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition">
                            + Tambah Input Foto
                        </button>
                    </div>

                    <div id="photo-inputs-container" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">File Foto Baru</label>
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
                        Perbarui Peristiwa
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        document.getElementById('add-photo-btn').addEventListener('click', function() {
            const container = document.getElementById('photo-inputs-container');
            const newRow = document.createElement('div');
            newRow.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50 relative group';
            newRow.innerHTML = `
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">File Foto Baru</label>
                    <input type="file" name="photos[]" accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-800 hover:file:bg-rose-100">
                </div>
                <div class="flex gap-2 items-end">
                    <div class="grow">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Keterangan Foto (Caption)</label>
                        <input type="text" name="captions[]" placeholder="Deskripsi singkat foto"
                            class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs focus:outline-none focus:border-rose-800">
                    </div>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="p-2 text-red-500 hover:bg-red-50 rounded-lg text-xs">
                        ✕
                    </button>
                </div>
            `;
            container.appendChild(newRow);
        });
    </script>
@endsection