<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeEvent;
use App\Models\LifeEventPhoto;
use App\Models\LifeYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LifeEventController extends Controller
{
    public function index()
    {
        $events = LifeEvent::with(['lifeYear', 'photos'])
            ->orderBy('event_date', 'desc')
            ->get();

        return view('admin.life_events.index', compact('events'));
    }

    public function create()
    {
        $years = LifeYear::orderBy('year', 'desc')->get();
        return view('admin.life_events.create', compact('years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'life_year_id' => 'required|exists:life_years,id',
            'event_date'   => 'required|date',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'category'     => 'nullable|string|max:100',
            
            // Validasi Multiple Photos
            'photos'       => 'nullable|array',
            'photos.*'     => 'image|mimes:jpeg,png,jpg,webp|max:3072', // Max 3MB per foto
            'captions'     => 'nullable|array',
        ]);

        // 1. Simpan Peristiwa Utama Terlebih Dahulu (agar mendapat $event->id)
        $event = LifeEvent::create([
            'life_year_id' => $request->life_year_id,
            'event_date'   => $request->event_date,
            'title'        => $request->title,
            'description'  => $request->description,
            'category'     => $request->category,
        ]);

        // 2. Loop Upload Multiple Photos ke Folder Spesifik Event (misal: life_events/12)
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photoFile) {
                // Foto disimpan ke dalam folder: public/storage/life_events/{event_id}
                $path = $photoFile->store('life_events/' . $event->id, 'public');
                $caption = $request->captions[$index] ?? null;

                LifeEventPhoto::create([
                    'life_event_id' => $event->id,
                    'photo_path'    => $path,
                    'caption'       => $caption,
                ]);
            }
        }

        return redirect()->route('admin.life-events.index')
            ->with('success', 'Peristiwa baru berhasil ditambahkan!');
    }

    public function edit(LifeEvent $lifeEvent)
    {
        $years = LifeYear::orderBy('year', 'desc')->get();
        $lifeEvent->load('photos'); // Load foto-foto yang sudah ada

        return view('admin.life_events.edit', compact('lifeEvent', 'years'));
    }

    public function update(Request $request, LifeEvent $lifeEvent)
    {
        $request->validate([
            'life_year_id' => 'required|exists:life_years,id',
            'event_date'   => 'required|date',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'category'     => 'nullable|string|max:100',
            
            'photos'       => 'nullable|array',
            'photos.*'     => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'captions'     => 'nullable|array',
        ]);

        // 1. Update Data Peristiwa
        $lifeEvent->update([
            'life_year_id' => $request->life_year_id,
            'event_date'   => $request->event_date,
            'title'        => $request->title,
            'description'  => $request->description,
            'category'     => $request->category,
        ]);

        // 2. Tambah Foto Baru ke Folder Spesifik Event (life_events/{event_id})
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photoFile) {
                // Simpan ke folder spesifik milik event ini
                $path = $photoFile->store('life_events/' . $lifeEvent->id, 'public');
                $caption = $request->captions[$index] ?? null;

                LifeEventPhoto::create([
                    'life_event_id' => $lifeEvent->id,
                    'photo_path'    => $path,
                    'caption'       => $caption,
                ]);
            }
        }

        return redirect()->route('admin.life-events.index')
            ->with('success', 'Data peristiwa berhasil diperbarui!');
    }

    public function destroy(LifeEvent $lifeEvent)
    {
        // Hapus berkas fisik semua foto dari storage
        foreach ($lifeEvent->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        // Opsional: Hapus folder event secara utuh jika sudah kosong
        Storage::disk('public')->deleteDirectory('life_events/' . $lifeEvent->id);

        $lifeEvent->delete();

        return redirect()->route('admin.life-events.index')
            ->with('success', 'Peristiwa berhasil dihapus!');
    }

    /**
     * Fitur Khusus: Hapus foto tertentu secara individual dari dalam form Edit Event
     */
    public function destroyPhoto(LifeEventPhoto $photo)
    {
        if ($photo->photo_path) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}