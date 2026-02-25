<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveCheck extends Model
{
     protected $table = 'love_checks';

    /**
     * Kolom yang boleh diisi secara massal.
     * Pastikan nama kolom di sini sama dengan di file migration.
     */
    protected $fillable = [
        'name',
        'love_status',
        'seriousness',
    ];
}
