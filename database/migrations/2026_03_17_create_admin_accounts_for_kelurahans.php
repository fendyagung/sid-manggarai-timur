<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Desa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $kelurahans = Desa::where('jenis', 'kelurahan')->get();

        foreach ($kelurahans as $k) {
            // Consistent with DaftarDesaSeeder logic
            $email = strtolower(str_replace(' ', '', $k->nama_desa . '.' . $k->kecamatan)) . '@desa.com';
            
            // Create user for the Kelurahan
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin Kelurahan ' . $k->nama_desa,
                    'password' => Hash::make('password'),
                    'role' => 'admin_desa',
                    'kecamatan' => $k->kecamatan
                ]
            );

            // Link user to Desa record
            $k->update(['user_id' => $user->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible, though we could delete the specific users
    }
};
