<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeYear;
use Illuminate\Http\Request;

class LifeYearController extends Controller
{
   public function index()
    {
        $lifeYears = LifeYear::withCount('events')->orderBy('year', 'asc')->get();
        return view('admin.life_years.index', compact('lifeYears'));
    }

    public function create()
    {
        return view('admin.life_years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year'    => 'required|integer|unique:life_years,year|min:1900|max:' . date('Y'),
            'title'   => 'nullable|string|max:255',
            'summary' => 'nullable|string',
        ], [
            'year.unique' => 'Tahun ini sudah pernah dibuat.',
        ]);

        LifeYear::create($validated);

        return redirect()->route('admin.life-years.index')
            ->with('success', 'Tahun berhasil ditambahkan!');
    }

    public function edit(LifeYear $lifeYear)
    {
        return view('admin.life_years.edit', compact('lifeYear'));
    }

    public function update(Request $request, LifeYear $lifeYear)
    {
        $validated = $request->validate([
            'year'    => 'required|integer|min:1900|max:' . date('Y') . '|unique:life_years,year,' . $lifeYear->id,
            'title'   => 'nullable|string|max:255',
            'summary' => 'nullable|string',
        ]);

        $lifeYear->update($validated);

        return redirect()->route('admin.life-years.index')
            ->with('success', 'Rangkuman tahun berhasil diperbarui!');
    }

    public function destroy(LifeYear $lifeYear)
    {
        $lifeYear->delete(); // Otomatis menghapus events & photos terkait jika CASCADE di-set
        return redirect()->route('admin.life-years.index')
            ->with('success', 'Data tahun beserta peristiwanya berhasil dihapus!');
    }
}
