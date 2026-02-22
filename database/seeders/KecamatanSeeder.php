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
            'Lamba Leda Selatan (Poco Ranaka)',
            'Lamba Leda Timur (Poco Ranaka Timur)',
            'Lamba Leda Utara',
            'Rana Mese',
            'Sambi Rampas',
        ];

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->updateOrInsert(
                ['nama' => $kecamatan],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
