<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@dpmd.com'],
            [
                'name' => 'Admin DPMD Manggarai Timur',
                'password' => \Hash::make('password'),
                'role' => 'admin_dpmd',
            ]
        );

        $this->call([
            KecamatanSeeder::class,
            DaftarDesaSeeder::class,
            DpmdProfileSeeder::class,
        ]);
    }
}
