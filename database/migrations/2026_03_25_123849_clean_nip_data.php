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
        // Clean DpmdStaff NIPs
        \DB::table('dpmd_staff')->chunkById(100, function ($staff) {
            foreach ($staff as $s) {
                if ($s->nip) {
                    \DB::table('dpmd_staff')
                        ->where('id', $s->id)
                        ->update(['nip' => str_replace(' ', '', $s->nip)]);
                }
            }
        });

        // Clean DpmdProfiles Kadis NIP
        $profile = \DB::table('dpmd_profiles')->first();
        if ($profile && $profile->nip_kadis) {
            \DB::table('dpmd_profiles')
                ->where('id', $profile->id)
                ->update(['nip_kadis' => str_replace(' ', '', $profile->nip_kadis)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed as we are cleaning up the data correctly.
    }
};
