<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all();
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|required_without:is_current|date|after_or_equal:start_date',
            'is_current'   => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'  => 'nullable|string',
        ], [
            'company_name.required'   => 'Nama perusahaan / instansi wajib diisi.',
            'position.required'       => 'Posisi / jabatan wajib diisi.',
            'start_date.required'     => 'Waktu mulai wajib diisi.',
            'start_date.date'         => 'Format waktu mulai tidak valid.',
            'end_date.required_without' => 'Waktu selesai wajib diisi jika tidak sedang bekerja di sini.',
            'end_date.after_or_equal' => 'Waktu selesai tidak boleh kurang dari waktu mulai.',
            'image.image'             => 'File harus berupa gambar.',
            'image.mimes'             => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, WEBP.',
            'image.max'               => 'Ukuran gambar maksimal 2MB.',
        ]);

        // 2. Format checkbox 'is_current' dan atur 'end_date'
        $validated['is_current'] = $request->has('is_current');
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        // 3. Handle Upload Gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('experiences', 'public');
        }

        // 4. Simpan Data ke Database
        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman kerja berhasil ditambahkan.');
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
        $experience = Experience::findOrFail($id);
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|required_without:is_current|date|after_or_equal:start_date',
            'is_current'   => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'  => 'nullable|string',
        ], [
            // Custom Error Messages
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'start_date.required'   => 'Tanggal masuk wajib diisi.',
            'start_date.date'       => 'Tanggal masuk harus berupa tanggal yang valid.',
            'end_date.date'         => 'Tanggal keluar harus berupa tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal keluar tidak boleh sebelum tanggal masuk.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, WEBP.',
            'image.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);
        // 2. Format boolean 'is_current' & atur 'end_date'
         // Memastikan jika checkbox tidak dicentang, nilainya menjadi false (0)
        $validated['is_current'] = $request->has('is_current');
    
    if ($validated['is_current']) {
        $validated['end_date'] = null;
    }
        // 2. Handle Upload Gambar (jika ada)
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder public/storage/experiences
            $validated['image'] = $request->file('image')->store('experiences', 'public');
        }

        // 3. Update Data di Database
        $experience = Experience::findOrFail($id);
        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($experience->image) {
            Storage::disk('public')->delete($experience->image);
        }

        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman kerja berhasil dihapus.');
    }
}
