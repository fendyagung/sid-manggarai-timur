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
        Schema::table('potensis', function (Blueprint $table) {
            // Using DB::statement for ENUM modification in MySQL as Doctrine doesn't support it well purely via Schema
            $table->enum('kategori', ['kuliner', 'kerajinan', 'event', 'alam', 'budaya', 'komoditi', 'lainnya'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            $table->enum('kategori', ['kuliner', 'kerajinan', 'event', 'alam', 'budaya', 'lainnya'])->change();
        });
    }
};
