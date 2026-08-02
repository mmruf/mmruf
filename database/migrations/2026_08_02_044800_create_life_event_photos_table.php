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
        Schema::create('life_event_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('life_event_id')->constrained('life_events')->onDelete('cascade');
            $table->string('photo_path'); // Path file foto
            $table->string('caption')->nullable(); // Penjelasan spesifik foto tersebut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_event_photos');
    }
};
