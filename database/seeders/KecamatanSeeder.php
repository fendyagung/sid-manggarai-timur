<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            'Borong',
            'Congkar',
            'Elar',
            'Elar Selatan',
            'Kota Komba',
            'Kota Komba Utara',
            'Lamba Leda',
            'Lamba Leda Selatan',
            'Lamba Leda Timur',
            'Lamba Leda Utara',
            'Rana Mese',
            'Sambi Rampas',
        ];

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->updateOrInsert(
                ['nama' => $kecamatan],
                ['created_at' => now(), 'updated_at' => now()]
            );

            // Create Admin Kecamatan Account
            \App\Models\User::updateOrCreate(
                ['email' => strtolower(str_replace(' ', '', $kecamatan)) . '@kecamatan.com'],
                [
                    'name' => 'Admin Kec. ' . $kecamatan,
                    'password' => \Hash::make('password'),
                    'role' => 'admin_kecamatan',
                    'kecamatan' => $kecamatan
                ]
            );
        }
    }
}
