@extends('layouts.admin')

@section('title', 'Data Experiences')
@section('page_heading', 'Daftar Pengalaman Kerja')

@section('content')
    <div class="space-y-6">

        <!-- ALERT NOTIFIKASI SUKSES -->
        @if (session('success'))
            <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- HEADER KONTEN & TOMBOL TAMBAH -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Riwayat Pengalaman Kerja</h2>
                <p class="text-sm text-slate-500 mt-0.5">Kelola data pengalaman kerja dan rekam jejak karier Anda di sini.</p>
            </div>
            
            <a href="{{ route('admin.experiences.create') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition border border-rose-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pengalaman
            </a>
        </div>

        <!-- CARD TABEL -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 border-collapse">
                    
                    <!-- HEADER TABEL -->
                    <thead class="bg-rose-950 text-white font-semibold text-xs uppercase tracking-wider border-b border-rose-900">
                        <tr>
                            <th scope="col" class="py-4 px-6">Perusahaan / Instansi</th>
                            <th scope="col" class="py-4 px-6">Posisi / Jabatan</th>
                            <th scope="col" class="py-4 px-6">Periode</th>
                            <th scope="col" class="py-4 px-6">Deskripsi Pekerjaan</th>
                            <th scope="col" class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY TABEL -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($experiences as $item)
                            <tr class="hover:bg-rose-50/40 transition">
                                
                                <!-- Nama Perusahaan & Logo -->
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" 
                                                 alt="{{ $item->company_name }}" 
                                                 class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-sm">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-800 font-bold flex items-center justify-center text-sm border border-rose-200">
                                                💼
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-slate-800 text-base">{{ $item->company_name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Posisi / Jabatan -->
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 text-xs font-semibold text-rose-800 bg-rose-50 rounded-md border border-rose-200 inline-block">
                                        {{ $item->position }}
                                    </span>
                                </td>

                                <!-- Periode (Start & End Date + Status Masih Bekerja) -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $item->start_date }} - {{ $item->is_current ? 'Sekarang' : ($item->end_date ?? '-') }}
                                        </span>

                                        @if ($item->is_current)
                                            <span class="inline-flex items-center text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full w-max border border-emerald-200">
                                                Masih Bekerja
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Deskripsi / Jobdesk -->
                                <td class="py-4 px-6 max-w-xs">
                                    <p class="text-slate-500 text-sm line-clamp-2">
                                        {{ $item->description ?? '-' }}
                                    </p>
                                </td>

                                <!-- Tombol Aksi -->
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        <!-- Edit -->
                                        <a href="{{ route('admin.experiences.edit', $item->id) }}" 
                                           class="p-2 text-slate-500 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition"
                                           title="Edit Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.experiences.destroy', $item->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengalaman kerja ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                    title="Hapus Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
                                        <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-800 flex items-center justify-center text-2xl">
                                            📂
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-slate-800">Belum Ada Data Pengalaman Kerja</p>
                                            <p class="text-sm text-slate-500 mt-1">Klik tombol di bawah untuk menambahkan data baru.</p>
                                        </div>
                                        <a href="{{ route('admin.experiences.create') }}" 
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
            @if (method_exists($experiences, 'hasPages') && $experiences->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $experiences->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection