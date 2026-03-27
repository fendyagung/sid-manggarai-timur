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
        Schema::table('pengumumans', function (Blueprint $table) {
            $table->boolean('show_on_dashboard')->default(true)->after('is_active');
            $table->boolean('show_on_public')->default(true)->after('show_on_dashboard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumumans', function (Blueprint $table) {
            $table->dropColumn(['show_on_dashboard', 'show_on_public']);
        });
    }
};
