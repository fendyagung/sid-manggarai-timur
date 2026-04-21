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
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreignId('desa_id')->nullable()->change();
            $table->string('kategori')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreignId('desa_id')->nullable(false)->change();
            $table->enum('kategori', ['keuangan', 'penduduk', 'kejadian', 'lainnya'])->change();
        });
    }
};
