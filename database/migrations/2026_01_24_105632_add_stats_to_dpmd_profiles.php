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
        Schema::table('dpmd_profiles', function (Blueprint $table) {
            $table->integer('stat_total_desa')->default(159);
            $table->integer('stat_desa_wisata')->default(45);
            $table->integer('stat_spot_wisata')->default(80);
            $table->string('stat_wisatawan')->default('12rb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dpmd_profiles', function (Blueprint $table) {
            $table->dropColumn(['stat_total_desa', 'stat_desa_wisata', 'stat_spot_wisata', 'stat_wisatawan']);
        });
    }
};
