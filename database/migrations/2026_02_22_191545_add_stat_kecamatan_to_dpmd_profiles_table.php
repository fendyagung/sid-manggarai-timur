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
            $table->integer('stat_kecamatan')->nullable()->after('stat_total_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dpmd_profiles', function (Blueprint $table) {
            $table->dropColumn('stat_kecamatan');
        });
    }
};
