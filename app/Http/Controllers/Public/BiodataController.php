<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        // Mengambil data profil pertama untuk rangkuman singkat di kartu
        $profile = Profile::first();
        return view('public.biodata.index', compact('profile'));
    }

    /**
     * Sub-halaman Detail: Perkenalan Diri / Profil
     */
    public function profile()
    {
        $profile = Profile::first();

        return view('public.biodata.profile', compact('profile'));
    }

    /**
     * Sub-halaman Detail: Pendidikan
     */
    public function educations()
    {
        // Urutkan dari tahun pendidikan terbaru
        $educations = Education::orderBy('start_year', 'desc')->get();

        return view('public.biodata.educations', compact('educations'));
    }

    /**
     * Sub-halaman Detail: Pekerjaan / Pengalaman
     */
    public function experiences()
    {
        // Urutkan pekerjaan terbaru / yang masih berlangsung di atas
        $experiences = Experience::orderBy('is_current', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('public.biodata.experiences', compact('experiences'));
    }
}
