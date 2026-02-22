<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('original_name')->nullable()->after('file_path');
        });

        Schema::table('dokumens', function (Blueprint $table) {
            $table->string('original_name')->nullable()->after('file_path');
        });

        Schema::table('regulasis', function (Blueprint $table) {
            $table->string('original_name')->nullable()->after('file_path');
        });

        Schema::table('pesans', function (Blueprint $table) {
            $table->string('original_name')->nullable()->after('lampiran');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('original_name'); });
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('original_name'); });
        Schema::table('regulasis', function (Blueprint $table) {
            $table->dropColumn('original_name'); });
        Schema::table('pesans', function (Blueprint $table) {
            $table->dropColumn('original_name'); });
    }
};
