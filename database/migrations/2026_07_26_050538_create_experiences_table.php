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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); // Nama instansi/perusahaan
            $table->string('position'); // Jabatan / Posisi
            $table->string('start_date'); // e.g. "Januari 2021" atau tipe date
            $table->string('end_date')->nullable(); // e.g. "Sekarang" atau tahun/bulan
            $table->boolean('is_current')->default(false); // Penanda jika masih bekerja di sini
            $table->string('image')->nullable(); // File gambar/foto kantor/instansi
            $table->text('description')->nullable(); // Deskripsi tugas / jobdesk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
