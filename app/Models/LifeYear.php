<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LifeYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'title',
        'summary',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    /**
     * Relasi ke LifeEvent: Satu tahun memiliki banyak peristiwa
     */
    public function events(): HasMany
    {
        // Urutkan peristiwa berdasarkan tanggal kejadian dari yang terlama ke terbaru
        return $this->hasMany(LifeEvent::class)->orderBy('event_date', 'asc');
    }
}
