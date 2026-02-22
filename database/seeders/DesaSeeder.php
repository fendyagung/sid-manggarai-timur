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

        // 2. Create Admin Desa 1 (Colol)
        $adminColol = User::create([
            'name' => 'Admin Desa Colol',
            'email' => 'colol@desa.id',
            'phone' => '08111111111',
            'role' => 'admin_desa',
            'password' => Hash::make('password'),
        ]);

        // 3. Create Admin Desa 2 (Golo Loni)
        $adminGoloLoni = User::create([
            'name' => 'Admin Desa Golo Loni',
            'email' => 'gololoni@desa.id',
            'phone' => '08222222222',
            'role' => 'admin_desa',
            'password' => Hash::make('password'),
        ]);

        // 4. Create Desa Colol
        $desaColol = Desa::create([
            'nama_desa' => 'Desa Colol',
            'kode_desa' => '5319012001',
            'kecamatan' => 'Lamba Leda Timur',
            'kepala_desa' => 'Paulus Namas',
            'deskripsi' => 'Colol merupakan pusat penghasil kopi terbaik di Flores.',
            'is_desa_wisata' => false,
            'user_id' => $adminColol->id,
        ]);

        // 5. Create Desa Golo Loni
        $desaGoloLoni = Desa::create([
            'nama_desa' => 'Desa Golo Loni',
            'kode_desa' => '5319012002',
            'kecamatan' => 'Rana Mese',
            'kepala_desa' => 'Yohanes Bosco',
            'deskripsi' => 'Golo Loni menawarkan keindahan sawah terasering dan agrowisata.',
            'is_desa_wisata' => false,
            'user_id' => $adminGoloLoni->id,
        ]);

        // 6. Create Sample Laporans for Colol
        Laporan::create([
            'desa_id' => $desaColol->id,
            'judul' => 'Laporan Keuangan Semester 1 2025',
            'kategori' => 'keuangan',
            'keterangan' => 'Laporan realisasi anggaran operasional desa.',
            'tanggal_laporan' => '2025-06-30',
            'status' => 'diterima',
        ]);

        // 7. Create Sample Laporans for Golo Loni
        Laporan::create([
            'desa_id' => $desaGoloLoni->id,
            'judul' => 'Update Data Penduduk Januari 2026',
            'kategori' => 'penduduk',
            'keterangan' => 'Penambahan data kelahiran dan mutasi penduduk.',
            'tanggal_laporan' => '2026-01-20',
            'status' => 'pending',
        ]);

        Laporan::create([
            'desa_id' => $desaGoloLoni->id,
            'judul' => 'Laporan Kejadian Bencana Alam',
            'kategori' => 'kejadian',
            'keterangan' => 'Terjadi tanah longsor di jalan utama desa.',
            'tanggal_laporan' => '2026-01-22',
            'status' => 'pending',
        ]);
    }
}
