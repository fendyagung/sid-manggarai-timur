<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dpmd_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kadis')->nullable();
            $table->string('foto_kadis')->nullable();
            $table->string('sambutan_judul')->nullable();
            $table->text('sambutan_teks')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable(); // Multi-line or JSON
            $table->string('nama_sekretaris')->nullable();
            $table->string('nama_kabid_pemberdayaan')->nullable();
            $table->string('nama_kabid_pemerintahan')->nullable();
            $table->string('nama_kabid_ekonomi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpmd_profiles');
    }
};
