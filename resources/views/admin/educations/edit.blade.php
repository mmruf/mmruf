@extends('layouts.admin')

@section('title', 'Edit Pendidikan')
@section('page_heading', 'Edit Pendidikan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- BREADCRUMB & HEADER -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.educations.index') }}" 
           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-rose-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendidikan
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        
        <!-- HEADER CARD -->
        <div class="p-6 bg-rose-950 text-white border-b border-rose-900">
            <h2 class="text-lg font-bold">Form Edit Riwayat Pendidikan</h2>
            <p class="text-xs text-rose-200/80 mt-1">Perbarui informasi riwayat pendidikan Anda di bawah ini.</p>
        </div>

        <!-- BODY FORM -->
        <form action="{{ route('admin.educations.update', $education->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="p-6 space-y-6"
              x-data="{ isOngoing: {{ old('end_year', $education->end_year) ? 'false' : 'true' }} }">
            @csrf
            @method('PUT')

            <!-- NAMA SEKOLAH / UNIVERSITAS -->
            <div>
                <label for="school_name" class="block text-sm font-semibold text-slate-800 mb-2">
                    Nama Sekolah / Perguruan Tinggi <span class="text-rose-600">*</span>
                </label>
                <input type="text" 
                       name="school_name" 
                       id="school_name" 
                       value="{{ old('school_name', $education->school_name) }}"
                       placeholder="Contoh: Universitas Indonesia / SMAN 1 Jakarta" 
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('school_name') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none" 
                       required>
                @error('school_name')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- GRID: GELAR & JURUSAN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- GELAR -->
                <div>
                    <label for="degree" class="block text-sm font-semibold text-slate-800 mb-2">
                        Gelar / Jenjang
                    </label>
                    <input type="text" 
                           name="degree" 
                           id="degree" 
                           value="{{ old('degree', $education->degree) }}"
                           placeholder="Contoh: S1, D3, SMA, Sarjana Komputer" 
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('degree') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">
                    @error('degree')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- JURUSAN -->
                <div>
                    <label for="field_of_study" class="block text-sm font-semibold text-slate-800 mb-2">
                        Jurusan / Program Studi
                    </label>
                    <input type="text" 
                           name="field_of_study" 
                           id="field_of_study" 
                           value="{{ old('field_of_study', $education->field_of_study) }}"
                           placeholder="Contoh: Teknik Informatika / IPA" 
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('field_of_study') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">
                    @error('field_of_study')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- GRID: TAHUN MASUK & LULUS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- TAHUN MASUK -->
                <div>
                    <label for="start_year" class="block text-sm font-semibold text-slate-800 mb-2">
                        Tahun Masuk <span class="text-rose-600">*</span>
                    </label>
                    <input type="number" 
                           name="start_year" 
                           id="start_year" 
                           min="1900" 
                           max="{{ date('Y') }}"
                           value="{{ old('start_year', $education->start_year) }}"
                           placeholder="YYYY" 
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('start_year') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none" 
                           required>
                    @error('start_year')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TAHUN LULUS -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="end_year" class="block text-sm font-semibold text-slate-800">
                            Tahun Lulus
                        </label>
                        <!-- Checkbox Masih Berlangsung -->
                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-800">
                            <input type="checkbox" 
                                   x-model="isOngoing" 
                                   class="rounded border-slate-300 text-rose-800 focus:ring-rose-800">
                            Masih Berlangsung
                        </label>
                    </div>
                    <input type="number" 
                           name="end_year" 
                           id="end_year" 
                           min="1900" 
                           max="{{ date('Y') + 10 }}"
                           value="{{ old('end_year', $education->end_year) }}"
                           placeholder="YYYY" 
                           :disabled="isOngoing"
                           :class="isOngoing ? 'bg-slate-100 text-slate-400 cursor-not-allowed border-slate-200' : 'border-slate-300 focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800'"
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition outline-none">
                    @error('end_year')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- UPLOAD GAMBAR / LOGO -->
            <div x-data="{ imagePreview: '{{ $education->image ? asset('storage/' . $education->image) : '' }}' }">
                <label class="block text-sm font-semibold text-slate-800 mb-2">
                    Logo / Foto Instansi Pendidikan (Opsional)
                </label>
                
                <div class="flex items-center gap-5">
                    <!-- Preview Box -->
                    <div class="w-20 h-20 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center overflow-hidden shrink-0">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!imagePreview">
                            <span class="text-2xl text-slate-400">🎓</span>
                        </template>
                    </div>

                    <!-- Input File Custom -->
                    <div class="flex-1">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               @change="const file = $event.target.files[0]; if (file) { imagePreview = URL.createObjectURL(file) }"
                               class="hidden">
                        
                        <label for="image" 
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl cursor-pointer transition border border-slate-200">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Ganti Gambar
                        </label>
                        <p class="text-xs text-slate-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto/logo. Format: JPG, PNG, WEBP (Maks 2MB).</p>
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-800 mb-2">
                    Deskripsi / Catatan Tambahan (Opsional)
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          placeholder="Jelaskan prestasi, organisasi, atau detail kegiatan selama masa studi..." 
                          class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">{{ old('description', $education->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- FOOTER / TOMBOL SIMPAN -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.educations.index') }}" 
                   class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                    Perbarui Data
                </button>
            </div>

        </form>

    </div>

</div>
@endsection