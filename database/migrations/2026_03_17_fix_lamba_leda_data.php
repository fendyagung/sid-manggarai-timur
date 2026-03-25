<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Set all in Lamba Leda to 'desa' (no kelurahan)
        DB::table('desas')
            ->where('kecamatan', 'Lamba Leda')
            ->update(['jenis' => 'desa']);

        // 2. Move specific villages/kelurahan to Lamba Leda Selatan
        $targets = ['Manoksawu', 'Nggalak Leleng', 'Bangka Leleng'];
        
        foreach ($targets as $name) {
            DB::table('desas')
                ->where('nama_desa', 'like', '%' . $name . '%')
                ->update([
                    'kecamatan' => 'Lamba Leda Selatan',
                    'jenis' => 'desa' // Ensure they are also set to desa as per general rule
                ]);
            
            // Also update the users table if any admin is assigned to these villages
            // Since the seeder uses the village name in the user name
            DB::table('users')
                ->where('name', 'like', '%' . $name . '%')
                ->where('role', 'admin_desa')
                ->update(['kecamatan' => 'Lamba Leda Selatan']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting this is tricky without knowing previous states, 
        // but for safety we can just leave it as is or do nothing.
    }
};
