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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('kode_desa')->unique()->nullable();
            $table->string('kecamatan');
            $table->string('kepala_desa')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('lokasi_maps')->nullable();
            $table->boolean('is_desa_wisata')->default(false);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Admin Desa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
