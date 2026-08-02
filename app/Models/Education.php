<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'school_name',
        'degree',
        'field_of_study',
        'start_year',
        'end_year',
        'image',
        'description',
    ];

    /**
     * Accessor untuk menampilkan rentang tahun studi.
     * Contoh: "2018 - 2022" atau "2023 - Sekarang"
     */
    public function getPeriodAttribute(): string
    {
        $end = $this->end_year ? $this->end_year : 'Sekarang';
        return "{$this->start_year} - {$end}";
    }
}
