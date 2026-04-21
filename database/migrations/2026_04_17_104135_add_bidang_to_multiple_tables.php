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
        Schema::table('users', function (Blueprint $table) {
            $table->string('bidang')->nullable()->after('role');
        });

        Schema::table('arsips', function (Blueprint $table) {
            $table->string('bidang')->nullable()->after('user_id');
        });

        Schema::table('laporans', function (Blueprint $table) {
            $table->string('bidang')->nullable()->after('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bidang');
        });

        Schema::table('arsips', function (Blueprint $table) {
            $table->dropColumn('bidang');
        });

        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('bidang');
        });
    }
};
