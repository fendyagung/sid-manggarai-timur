<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ResetUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sid:reset-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus seluruh pengguna (termasuk yang didaftarkan manual) dan kembalikan ke akun default bawaan sistem (Dinas, Kecamatan, Desa).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('Memulai proses reset pengguna...');
        
        // Disable foreign key checks momentarily if needed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua user
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Semua akun pengguna telah dihapus.');

        // Jalankan seeder khusus pengguna
        $this->info('Membuat ulang akun default (Dinas, Kecamatan, Desa)...');
        
        // 1. Admin Dinas
        User::create([
            'name' => 'Admin DPMD Manggarai Timur',
            'email' => 'admin@dpmd.com',
            'password' => \Hash::make('AdminMatim2026'),
            'role' => 'admin_dpmd',
            'username' => 'admin_dpmd'
        ]);

        // 2. Admin Kecamatan & Desa
        $this->call('db:seed', ['--class' => 'Database\Seeders\KecamatanSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\DaftarDesaSeeder']);

        $this->info('Proses reset selesai! Seluruh akun uji coba telah dihapus.');
        $this->info('Anda sekarang bisa login menggunakan akun default bawaan sistem.');
    }
}
