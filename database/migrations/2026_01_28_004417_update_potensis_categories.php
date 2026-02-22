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
            $table->enum('kategori', ['kuliner', 'kerajinan', 'event', 'alam', 'budaya', 'lainnya'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            $table->enum('kategori', ['alam', 'budaya', 'kuliner', 'buatan', 'lainnya'])->change();
        });
    }
};
