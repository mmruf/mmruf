<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LifeEventPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'life_event_id',
        'photo_path',
        'caption',
    ];

    /**
     * Relasi balik ke LifeEvent
     */
    public function lifeEvent(): BelongsTo
    {
        return $this->belongsTo(LifeEvent::class, 'life_event_id');
    }

    /**
     * Accessor untuk mendapatkan URL lengkap foto dari storage
     * Dipanggil di Blade: $photo->photo_url
     */
    public function getPhotoUrlAttribute(): string
    {
        return asset('storage/' . $this->photo_path);
    }
}
