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
        Schema::table('desas', function (Blueprint $table) {
            $table->integer('jumlah_penduduk')->nullable()->after('video_youtube');
            $table->integer('jumlah_kk')->nullable()->after('jumlah_penduduk');
            $table->string('luas_wilayah')->nullable()->after('jumlah_kk'); // e.g. "1500 Ha"
            $table->text('deskripsi_batas')->nullable()->after('luas_wilayah');
            $table->text('potensi_ekonomi')->nullable()->after('deskripsi_batas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_penduduk',
                'jumlah_kk',
                'luas_wilayah',
                'deskripsi_batas',
                'potensi_ekonomi'
            ]);
        });
    }
};
