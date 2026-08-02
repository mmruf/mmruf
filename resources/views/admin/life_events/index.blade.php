@extends('layouts.admin')

@section('title', 'Data Peristiwa Hidup')
@section('page_heading', 'Daftar Peristiwa Hidup')

@section('content')
    <div class="space-y-6">

        <!-- ALERT NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div
                class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- HEADER KONTEN & TOMBOL TAMBAH -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Peristiwa Hidup</h2>
                <p class="text-sm text-slate-500 mt-0.5">Kelola momen penting dan riwayat peristiwa hidup Anda di sini.</p>
            </div>

            <a href="{{ route('admin.life-events.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Peristiwa
            </a>
        </div>

        <!-- CARD TABEL -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 border-collapse">

                    <!-- HEADER TABEL -->
                    <thead
                        class="bg-rose-950 text-white font-semibold text-xs uppercase tracking-wider border-b border-rose-900">
                        <tr>
                            <th scope="col" class="py-4 px-6">Peristiwa</th>
                            <th scope="col" class="py-4 px-6">Tanggal & Tahun</th>
                            <th scope="col" class="py-4 px-6">Kategori</th>
                            <th scope="col" class="py-4 px-6">Foto</th>
                            <th scope="col" class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY TABEL -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($events as $item)
                            <tr class="hover:bg-rose-50/40 transition">

                                <!-- Peristiwa & Deskripsi Singkat -->
                                <td class="py-4 px-6 font-medium text-slate-900 max-w-xs">
                                    <div class="space-y-1">
                                        <p class="font-bold text-slate-800 text-base">{{ $item->title }}</p>
                                        <p class="text-slate-500 text-xs line-clamp-2">
                                            {{ $item->description ?? 'Tidak ada deskripsi.' }}
                                        </p>
                                    </div>
                                </td>

                                <!-- Tanggal & Tahun Relasi -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $item->formatted_date }}
                                        </span>
                                        @if ($item->lifeYear)
                                            <span class="text-xs text-slate-400">
                                                Tahun Angkatan/Buku: <strong class="text-slate-600">{{ $item->lifeYear->year }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Kategori -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    @if ($item->category)
                                        <span class="px-2.5 py-1 text-xs font-semibold text-rose-800 bg-rose-50 rounded-md border border-rose-200">
                                            {{ $item->category }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 font-medium">-</span>
                                    @endif
                                </td>

                                <!-- Pratinjau Foto (Thumbnails) -->
                                <td class="py-4 px-6">
                                    @if ($item->photos->count() > 0)
                                        <div class="flex items-center -space-x-2 overflow-hidden">
                                            @foreach ($item->photos->take(3) as $photo)
                                                <img class="inline-block h-10 w-10 rounded-lg ring-2 ring-white object-cover shadow-sm"
                                                    src="{{ $photo->photo_url }}" alt="Foto Momen">
                                            @endforeach
                                            @if ($item->photos->count() > 3)
                                                <span class="flex items-center justify-center h-10 w-10 rounded-lg ring-2 ring-white bg-slate-100 text-xs font-bold text-slate-600">
                                                    +{{ $item->photos->count() - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Tanpa Foto</span>
                                    @endif
                                </td>

                                <!-- Tombol Aksi -->
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit -->
                                        <a href="{{ route('admin.life-events.edit', $item->id) }}"
                                            class="p-2 text-slate-500 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition"
                                            title="Edit Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.life-events.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus peristiwa ini? Semua foto terkait juga akan terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <!-- STATE JIKA DATA KOSONG -->
                            <tr>
                                <td colspan="5" class="py-12 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div
                                            class="w-16 h-16 rounded-full bg-rose-50 text-rose-800 flex items-center justify-center text-2xl">
                                            📷
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-slate-800">Belum Ada Peristiwa Hidup</p>
                                            <p class="text-sm text-slate-500 mt-1">Klik tombol di bawah untuk menambahkan
                                                momen peristiwa baru.</p>
                                        </div>
                                        <a href="{{ route('admin.life-events.create') }}"
                                            class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-rose-800 hover:bg-rose-900 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                                            + Tambah Peristiwa Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection