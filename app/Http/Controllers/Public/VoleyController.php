<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoleyController extends Controller
{
    public function index()
    {
        // Menampilkan halaman utama skor
        return view('public.apps.score');
    }
    public function updateScore(Request $request)
    {
        // Logika memperbarui skor di database/session
        // Contoh sederhana menggunakan session:
        session([
            'score_a' => $request->score_a,
            'score_b' => $request->score_b,
        ]);

        return response()->json([
            'status' => 'success',
            'score_a' => $request->score_a,
            'score_b' => $request->score_b,
        ]);
    }
}
