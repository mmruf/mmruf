@extends('layouts.admin')

@section('title', 'Kelola Profil')
@section('page_heading', 'Kelola Profil')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- CARD FORM -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

            <!-- HEADER CARD -->
            <div class="p-6 bg-rose-950 text-white border-b border-rose-900">
                <h2 class="text-lg font-bold">Informasi Profil Pribadi</h2>
                <p class="text-xs text-rose-200/80 mt-1">Perbarui informasi diri Anda yang akan ditampilkan pada sistem/portofolio.</p>
            </div>

            <!-- BODY FORM -->
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                <!-- FOTO PROFIL (PREVIEW & UPLOAD) -->
                <div x-data="{ photoPreview: '{{ $profile->photo ? asset('storage/' . $profile->photo) : '' }}' }">
                    <label class="block text-sm font-semibold text-slate-800 mb-2">Foto Profil</label>
                    <div class="flex items-center gap-5">
                        <!-- Preview Box -->
                        <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center overflow-hidden shrink-0">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                <span class="text-3xl text-slate-400">👤</span>
                            </template>
                        </div>

                        <!-- Input File -->
                        <div class="flex-1">
                            <input type="file" name="photo" id="photo" accept="image/*" class="hidden"
                                @change="const file = $event.target.files[0]; if (file) { photoPreview = URL.createObjectURL(file) }">

                            <label for="photo"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl cursor-pointer transition border border-slate-200">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Ganti Foto
                            </label>
                            <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, WEBP (Maksimal 2MB).</p>
                        </div>
                    </div>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NAMA LENGKAP -->
                <div>
                    <label for="full_name" class="block text-sm font-semibold text-slate-800 mb-2">
                        Nama Lengkap <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" name="full_name" id="full_name"
                        value="{{ old('full_name', $profile->full_name) }}"
                        placeholder="Contoh: Muhammad RUF"
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('full_name') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none"
                        required>
                    @error('full_name')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GRID: TEMPAT & TANGGAL LAHIR -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="place_of_birth" class="block text-sm font-semibold text-slate-800 mb-2">
                            Tempat Lahir <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" name="place_of_birth" id="place_of_birth"
                            value="{{ old('place_of_birth', $profile->place_of_birth) }}"
                            placeholder="Contoh: Buol"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('place_of_birth') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none"
                            required>
                        @error('place_of_birth')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_of_birth" class="block text-sm font-semibold text-slate-800 mb-2">
                            Tanggal Lahir <span class="text-rose-600">*</span>
                        </label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            value="{{ old('date_of_birth', optional($profile->date_of_birth)->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('date_of_birth') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none"
                            required>
                        @error('date_of_birth')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- GRID: EMAIL & NO HP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-800 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', $profile->email) }}"
                            placeholder="nama@email.com"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-800 mb-2">Nomor HP / WhatsApp</label>
                        <input type="text" name="phone" id="phone"
                            value="{{ old('phone', $profile->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('phone') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ALAMAT -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-slate-800 mb-2">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3"
                        placeholder="Masukkan alamat domisili..."
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('address') ? 'border-red-500' : 'border-slate-300' }} focus:border-rose-800 focus:ring-2 focus:ring-rose-800/20 text-slate-800 text-sm transition outline-none">{{ old('address', $profile->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FOOTER / TOMBOL SIMPAN -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                    <button type="submit"
                        class="px-6 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection