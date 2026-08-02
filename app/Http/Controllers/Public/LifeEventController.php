<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LifeEvent;
use App\Models\LifeYear;

class LifeEventController extends Controller
{
   public function index()
    {
        // Ambil data tahun terlama ke terbaru (asc) beserta peristiwa & fotonya
        $lifeYears = LifeYear::with(['events' => function ($query) {
                $query->orderBy('event_date', 'asc');
            }, 'events.photos'])
            ->orderBy('year', 'asc') // Urutan tahun terlama -> terbaru
            ->get();

        return view('public.life-events.index', compact('lifeYears'));
    }

    /**
     * Menampilkan detail satu peristiwa tertentu (lengkap dengan foto-fotonya)
     */
    public function show(LifeEvent $lifeEvent)
    {
        $lifeEvent->load(['photos', 'lifeYear']);

        return view('public.life-events.show', compact('lifeEvent'));
    }
}
