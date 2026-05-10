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
        Schema::table('desas', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('lokasi_maps');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });

        Schema::table('potensis', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('lokasi');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desas', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });

        Schema::table('potensis', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
