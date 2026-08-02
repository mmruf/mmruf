<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $educations = Education::all();
            return view('admin.educations.index', compact('educations'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.educations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'school_name'    => 'required|string|max:255',
            'degree'         => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_year'     => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
            'end_year'       => 'nullable|numeric|digits:4|gte:start_year',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'    => 'nullable|string',
        ], [
            // Custom Error Messages
            'school_name.required' => 'Nama sekolah / perguruan tinggi wajib diisi.',
            'start_year.required'  => 'Tahun masuk wajib diisi.',
            'start_year.numeric'   => 'Tahun masuk harus berupa angka.',
            'end_year.gte'         => 'Tahun lulus tidak boleh kurang dari tahun masuk.',
            'image.image'          => 'File harus berupa gambar.',
            'image.mimes'          => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, WEBP.',
            'image.max'            => 'Ukuran gambar maksimal 2MB.',
        ]);

        // 2. Handle Upload Gambar (jika ada)
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder public/storage/educations
            $validated['image'] = $request->file('image')->store('educations', 'public');
        }

        // 3. Simpan Data ke Database
        Education::create($validated);

        // 4. Redirect dengan Pesan Sukses
        return redirect()->route('admin.educations.index')
                         ->with('success', 'Data pendidikan berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = Education::findOrFail($id);
        return view('admin.educations.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $education = Education::findOrFail($id);

        $validated = $request->validate([
            'school_name'    => 'required|string|max:255',
            'degree'         => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_year'     => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
            'end_year'       => 'nullable|numeric|digits:4|gte:start_year',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'    => 'nullable|string',
        ], [
            // Custom Error Messages
            'school_name.required' => 'Nama sekolah / perguruan tinggi wajib diisi.',
            'start_year.required'  => 'Tahun masuk wajib diisi.',
            'start_year.numeric'   => 'Tahun masuk harus berupa angka.',
            'end_year.gte'         => 'Tahun lulus tidak boleh kurang dari tahun masuk.',
            'image.image'          => 'File harus berupa gambar.',
            'image.mimes'          => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, WEBP.',
            'image.max'            => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($education->image) {
                Storage::disk('public')->delete($education->image);
            }

            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('educations', 'public');
        }

        $education->update($validated);

        return redirect()->route('admin.educations.index')
                         ->with('success', 'Data pendidikan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $education = Education::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($education->image) {
            Storage::disk('public')->delete($education->image);
        }

        $education->delete();

        return redirect()->route('admin.educations.index')
                         ->with('success', 'Data pendidikan berhasil dihapus!');
    }
}
