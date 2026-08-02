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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('school_name'); // Nama Sekolah / Perguruan Tinggi
            $table->string('degree')->nullable(); // e.g. S1, SMA, D3
            $table->string('field_of_study')->nullable(); // Jurusan / Program Studi
            $table->integer('start_year');
            $table->integer('end_year')->nullable(); // Boleh null jika derajatmasih berlangsung
            $table->string('image')->nullable(); // File gambar/foto logo/bangunan sekolah
            $table->text('description')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
