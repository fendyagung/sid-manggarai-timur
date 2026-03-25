<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use App\Models\User;

$kelurahans = Desa::where('jenis', 'kelurahan')->get();

echo "--- Verifying Admin Accounts for Kelurahans ---\n";
foreach ($kelurahans as $k) {
    if ($k->user_id && User::find($k->user_id)) {
        $user = User::find($k->user_id);
        echo "[OK] {$k->nama_desa} ({$k->kecamatan}) -> User: {$user->email}\n";
    } else {
        echo "[FAIL] {$k->nama_desa} ({$k->kecamatan}) -> NO ADMIN LINKED\n";
    }
}

echo "\nTotal Kelurahans with Admin: " . $kelurahans->whereNotNull('user_id')->count() . " / " . $kelurahans->count() . "\n";
