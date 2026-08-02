<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'place_of_birth',
        'date_of_birth',
        'photo',
        'email',
        'phone',
        'address',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Accessor untuk menghitung umur secara otomatis.
     * Dipanggil di Blade dengan: $profile->age
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    /**
     * Accessor untuk format Tempat, Tanggal Lahir.
     * Dipanggil di Blade dengan: $profile->ttl
     */
    public function getTtlAttribute(): string
    {
        $formattedDate = Carbon::parse($this->date_of_birth)->translatedFormat('d F Y');
        return "{$this->place_of_birth}, {$formattedDate}";
    }
}
