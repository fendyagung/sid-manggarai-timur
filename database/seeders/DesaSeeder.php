<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Desa;
use App\Models\Laporan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin DPMD
        $adminDpmd = User::create([
            'name' => 'Admin DPMD Matim',
            'email' => 'admin.dpmd@matimkab.go.id',
            'phone' => '08123456789',
            'role' => 'admin_dpmd',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Admin Desa 1 (Ngampang Mas)
        $adminNgampangMas = User::create([
            'name' => 'Admin Desa Ngampang Mas',
            'email' => 'ngampangmas@desa.id',
            'phone' => '08111111111',
            'role' => 'admin_desa',
            'password' => Hash::make('password'),
        ]);

        // 4. Create Desa Ngampang Mas
        $desaNgampangMas = Desa::create([
            'nama_desa' => 'Desa Ngampang Mas',
            'kode_desa' => '5319012001',
            'kecamatan' => 'Borong',
            'kepala_desa' => '',
            'deskripsi' => 'Desa Ngampang Mas terletak di Kecamatan Borong, Kabupaten Manggarai Timur.',
            'is_desa_wisata' => false,
            'user_id' => $adminNgampangMas->id,
        ]);

        // 5. Create Sample Laporan for Ngampang Mas
        Laporan::create([
            'desa_id' => $desaNgampangMas->id,
            'judul' => 'Laporan Keuangan Semester 1 2025',
            'kategori' => 'keuangan',
            'keterangan' => 'Laporan realisasi anggaran operasional desa.',
            'tanggal_laporan' => '2025-06-30',
            'status' => 'diterima',
        ]);
    }
}
