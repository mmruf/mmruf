<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();

        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth'  => 'required|date',
            'email'          => 'nullable|email|max:255',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle upload foto jika ada file baru
        if ($request->hasFile('photo')) {
            if ($profile && $profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        // Simpan data (Update jika sudah ada ID-nya, Create jika belum)
        Profile::updateOrCreate(
            ['id' => $profile->id ?? null],
            $validated
        );

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
}
