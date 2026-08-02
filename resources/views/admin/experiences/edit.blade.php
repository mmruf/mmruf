@extends('layouts.admin')

@section('title', 'Edit Pengalaman')
@section('page_heading', 'Edit Pengalaman')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- BREADCRUMB & HEADER -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.experiences.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-rose-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Pengalaman
            </a>
        </div>

        <!-- CARD FORM -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

            <!-- HEADER CARD -->
            <div class="p-6 bg-rose-950 text-white border-b border-rose-900">
                <h2 class="text-lg font-bold">Form Edit Riwayat Pengalaman</h2>
                <p class="text-xs text-rose-200/80 mt-1">Perbarui informasi pengalaman kerja atau organisasi Anda di bawah ini.</p>
            </div>

            <!-- BODY FORM -->
            <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6" x-data="{ isCurrent: {{ old('is_current', $experience->is_current) ? 'true' : 'false' }} }">
                @csrf
                @method('PUT')

                <!-- GRID: JABATAN & PERUSAHAAN/INSTANSI -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- POSISI / JABATAN -->
                    <div>
                        <label for="position" class="block text-sm font-semibold text-slate-800 mb-2">
                            Posisi / Jabatan <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" name="position" id="position" value="{{ old('position', $experience->position) }}"
                            placeholder="Contoh: Web Developer / Staf Perencanaan / Ketua Himpunan"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('position') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none"
                            required>
                        @error('position')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NAMA PERUSAHAAN / INSTANSI -->
                    <div>
                        <label for="company_name" class="block text-sm font-semibold text-slate-800 mb-2">
                            Perusahaan / Instansi / Organisasi <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $experience->company_name) }}"
                            placeholder="Contoh: PT. Technology Indonesia / Dinas PUPR"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('company_name') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none"
                            required>
                        @error('company_name')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- GRID: TANGGAL MULAI & SELESAI -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- WAKTU MULAI -->
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-slate-800 mb-2">
                            Waktu Mulai <span class="text-rose-600">*</span>
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date) }}"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('start_date') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none"
                            required>
                        @error('start_date')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- WAKTU SELESAI -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="end_date" class="block text-sm font-semibold text-slate-800">
                                Waktu Selesai
                            </label>
                            <!-- Checkbox Masih Bekerja / Aktif -->
                            <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-800">
                                <input type="checkbox" name="is_current" value="1" x-model="isCurrent"
                                    class="rounded border-slate-300 text-rose-800 focus:ring-rose-800">
                                Masih Bekerja di Sini
                            </label>
                        </div>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date) }}"
                            :disabled="isCurrent"
                            :class="isCurrent ? 'bg-slate-100 text-slate-400 cursor-not-allowed border-slate-200' :
                                'border-slate-300 focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800'"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm transition outline-none">
                        @error('end_date')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- UPLOAD GAMBAR / FOTO KANTOR -->
                <div x-data="{ imagePreview: '{{ $experience->image ? asset('storage/' . $experience->image) : null }}' }">
                    <label class="block text-sm font-semibold text-slate-800 mb-2">
                        Foto / Logo Instansi (Opsional)
                    </label>

                    <div class="flex items-center gap-5">
                        <!-- Preview Box -->
                        <div class="w-20 h-20 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center overflow-hidden shrink-0">
                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!imagePreview">
                                <span class="text-2xl text-slate-400">💼</span>
                            </template>
                        </div>

                        <!-- Input File Custom -->
                        <div class="flex-1">
                            <input type="file" name="image" id="image" accept="image/*"
                                @change="const file = $event.target.files[0]; if (file) { imagePreview = URL.createObjectURL(file) }"
                                class="hidden">

                            <label for="image"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl cursor-pointer transition border border-slate-200">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Ubah Gambar
                            </label>
                            <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, WEBP (Maksimal 2MB). Biarkan kosong jika tidak ingin mengubah foto.</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESKRIPSI & TANGGUNG JAWAB -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-800 mb-2">
                        Deskripsi Pekerjaan & Tanggung Jawab (Opsional)
                    </label>
                    <textarea name="description" id="description" rows="4"
                        placeholder="Jelaskan peran utama, pencapaian, atau tugas-tugas selama bekerja..."
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 placeholder-slate-400 text-sm transition outline-none">{{ old('description', $experience->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FOOTER / TOMBOL SIMPAN -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.experiences.index') }}"
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