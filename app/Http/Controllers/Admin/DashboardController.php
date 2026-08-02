<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEducation = Education::count();
        $totalExperience = Experience::count();

        return view('admin.dashboard', compact('totalEducation', 'totalExperience'));
    }
}
