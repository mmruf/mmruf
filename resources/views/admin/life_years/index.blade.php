@extends('layouts.admin')

@section('title', 'Data Life Years')
@section('page_heading', 'Daftar Perjalanan Tahun')

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
                <h2 class="text-xl font-bold text-slate-800">Timeline Perjalanan Hidup</h2>
                <p class="text-sm text-slate-500 mt-0.5">Kelola data tahunan dan rincian momen penting perjalanan hidup Anda.</p>
            </div>

            <a href="{{ route('admin.life-years.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Tahun
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
                            <th scope="col" class="py-4 px-6">Tahun</th>
                            <th scope="col" class="py-4 px-6">Judul / Tema</th>
                            <th scope="col" class="py-4 px-6">Ringkasan</th>
                            <th scope="col" class="py-4 px-6 text-center">Peristiwa</th>
                            <th scope="col" class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY TABEL -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($lifeYears as $item)
                            <tr class="hover:bg-rose-50/40 transition">

                                <!-- Tahun -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-rose-100 text-rose-800 font-bold flex items-center justify-center text-base border border-rose-200 shadow-sm">
                                            {{ $item->year }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-base">Tahun {{ $item->year }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Judul / Tema -->
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    <span class="text-slate-800 font-semibold text-base">
                                        {{ $item->title }}
                                    </span>
                                </td>

                                <!-- Ringkasan (Summary) -->
                                <td class="py-4 px-6 max-w-xs">
                                    <p class="text-slate-500 text-sm line-clamp-2">
                                        {{ $item->summary ?? '-' }}
                                    </p>
                                </td>

                                <!-- Jumlah Peristiwa (Relasi events) -->
                                <td class="py-4 px-6 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-rose-800 bg-rose-50 rounded-full border border-rose-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $item->events_count ?? $item->events->count() }} Peristiwa
                                    </span>
                                </td>

                                <!-- Tombol Aksi -->
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">

                                    

                                        <!-- Edit Data Tahun -->
                                        <a href="{{ route('admin.life-years.edit', $item->id) }}"
                                            class="p-2 text-slate-500 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition"
                                            title="Edit Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Hapus Data Tahun -->
                                        <form action="{{ route('admin.life-years.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tahun {{ $item->year }} beserta seluruh peristiwanya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
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
                                            📅
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-slate-800">Belum Ada Data Tahun</p>
                                            <p class="text-sm text-slate-500 mt-1">Klik tombol di bawah untuk menambahkan
                                                tahun perjalanan hidup baru.</p>
                                        </div>
                                        <a href="{{ route('admin.life-years.create') }}"
                                            class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-rose-800 hover:bg-rose-900 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                                            + Tambah Data Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- PAGINASI -->
            @if (method_exists($lifeYears, 'hasPages') && $lifeYears->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $lifeYears->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection