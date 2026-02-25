<?php

namespace App\Http\Controllers;

use App\Models\LoveCheck;
use Illuminate\Http\Request;

class LoveController extends Controller
{
    public function index()
    {
        return view('apps.love');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'love_status' => 'required|string',
            'seriousness' => 'required|string',
        ]);

        // 2. Simpan ke database
        LoveCheck::create($validated);

        // 3. Respon balik ke Alpine.js
        return response()->json([
            'status' => 'success',
            'message' => 'Data cinta berhasil disimpan!'
        ]);
    }
}
