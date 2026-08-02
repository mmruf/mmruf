<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'position',
        'start_date',
        'end_date',
        'is_current',
        'image',
        'description',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    /**
     * Accessor untuk format status periode kerja.
     */
    public function getPeriodAttribute(): string
    {
        if ($this->is_current) {
            return "{$this->start_date} - Sekarang";
        }
        return "{$this->start_date} - " . ($this->end_date ?? 'Sekarang');
    }
}
