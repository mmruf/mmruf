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
        Schema::create('love_checks', function (Blueprint $table) {
        $table->id();
        $table->string('name');             // Nama pengisi
        $table->string('love_status');      // Jawaban: Cinta atau Tidak
        $table->string('seriousness');      // Jawaban: Serius atau Main-main
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('love_checks');
    }
};
