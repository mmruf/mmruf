<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('life_years', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique(); // e.g. 1998
            $table->string('title')->nullable(); // e.g. "Lahir ke Dunia" atau "Memulai Karir Baru"
            $table->text('summary')->nullable(); // Deskripsi umum tahun tersebut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_years');
    }
};
