@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Total Education</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalEducation }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Total Experience</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalExperience }}</p>
            </div>
        </div>
    </div>
@endsection
