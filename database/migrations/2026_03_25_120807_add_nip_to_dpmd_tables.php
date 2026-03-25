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
        Schema::table('dpmd_profiles', function (Blueprint $table) {
            $table->string('nip_kadis')->nullable();
            $table->string('pangkat_kadis')->nullable();
        });

        Schema::table('dpmd_staff', function (Blueprint $table) {
            $table->string('nip')->nullable();
            $table->string('pangkat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dpmd_profiles', function (Blueprint $table) {
            $table->dropColumn(['nip_kadis', 'pangkat_kadis']);
        });

        Schema::table('dpmd_staff', function (Blueprint $table) {
            $table->dropColumn(['nip', 'pangkat']);
        });
    }
};
