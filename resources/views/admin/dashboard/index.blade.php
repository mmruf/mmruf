@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Ringkasan Sistem</h1>
        <p class="text-slate-500">Pantau performa dan akses aplikasi MMRUF Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Total Aplikasi</p>
            <p class="text-3xl font-bold text-slate-900 mt-1">12</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">Pengguna Aktif</p>
            <p class="text-3xl font-bold text-slate-900 mt-1">158</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <p class="text-sm font-medium text-slate-500">System Uptime</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">99.9%</p>
        </div>
    </div>

    <div
        class="bg-white border-2 border-dashed border-slate-200 rounded-3xl h-64 flex items-center justify-center text-slate-400">
        Mulai tambahkan konten atau widget aplikasi di sini...
    </div>

@endsection
