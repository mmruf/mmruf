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
        Schema::create('life_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('life_year_id')->constrained('life_years')->onDelete('cascade');
            $table->date('event_date'); // Tanggal pasti kejadian
            $table->string('title'); // Judul peristiwa
            $table->text('description')->nullable(); // Penjelasan detail peristiwa
            $table->string('category')->nullable(); // e.g. Pendidikan, Karir, Hobi, Keluarga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_events');
    }
};
