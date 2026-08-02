<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LifeEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'life_year_id',
        'event_date',
        'title',
        'description',
        'category',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Relasi balik ke LifeYear
     */
    public function lifeYear(): BelongsTo
    {
        return $this->belongsTo(LifeYear::class);
    }

    /**
     * Relasi ke LifeEventPhoto: Satu peristiwa memiliki banyak foto
     */
    public function photos(): HasMany
    {
        return $this->hasMany(LifeEventPhoto::class);
    }

    /**
     * Accessor untuk format tanggal Indonesia (contoh: "17 Agustus 2024")
     * Dipanggil di Blade: $event->formatted_date
     */
    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->event_date)->translatedFormat('d F Y');
    }

    /**
     * Helper untuk mengecek apakah peristiwa ini memiliki foto
     * Dipanggil di Blade: $event->has_photos
     */
    public function getHasPhotosAttribute(): bool
    {
        return $this->photos()->exists();
    }
}
