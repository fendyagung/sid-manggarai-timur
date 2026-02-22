<?php

use App\Models\User;
use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Update DPMD Admin (Set NIP/Username)
$dpmd = User::where('role', 'admin_dpmd')->first();
if ($dpmd) {
    $dpmd->update(['username' => '198801012015011001']);
    echo "DPMD Admin updated with NIP: 198801012015011001\n";
}

// 2. Update Desa Admins & Village Codes
$desaColol = Desa::where('nama_desa', 'LIKE', '%Colol%')->first();
if ($desaColol) {
    $desaColol->update(['kode_desa' => 'DS_COLOL']);
    $user = User::find($desaColol->user_id);
    if ($user) {
        $user->update(['username' => 'DS_COLOL']);
        echo "Desa Colol updated with Code: DS_COLOL\n";
    }
}

$desaGoloLoni = Desa::where('nama_desa', 'LIKE', '%Golo Loni%')->first();
if ($desaGoloLoni) {
    $desaGoloLoni->update(['kode_desa' => 'DS_GLONI']);
    $user = User::find($desaGoloLoni->user_id);
    if ($user) {
        $user->update(['username' => 'DS_GLONI']);
        echo "Desa Golo Loni updated with Code: DS_GLONI\n";
    }
}

echo "Setup complete. You can now login with these usernames!\n";
