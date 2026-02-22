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
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_total_desa INT NULL');
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_desa_wisata INT NULL');
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_spot_wisata INT NULL');
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_wisatawan VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_total_desa INT NOT NULL DEFAULT 159');
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_desa_wisata INT NOT NULL DEFAULT 45');
        DB::statement('ALTER TABLE dpmd_profiles MODIFY stat_spot_wisata INT NOT NULL DEFAULT 80');
        DB::statement("ALTER TABLE dpmd_profiles MODIFY stat_wisatawan VARCHAR(255) NOT NULL DEFAULT '12rb'");
    }
};
