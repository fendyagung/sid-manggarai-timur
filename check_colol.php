<?php

use App\Models\Desa;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Desa Records for 'Colol' ---\n";
$desas = Desa::where('nama_desa', 'like', '%Colol%')->get();
foreach ($desas as $d) {
    echo "ID: {$d->id} | Nama: {$d->nama_desa} | Jenis: {$d->jenis} | UserID: {$d->user_id}\n";
}

echo "\n--- User Accounts ---\n";
// Check if user_id from Valid Desa Colol exists
$validDesa = $desas->firstWhere('nama_desa', 'Desa Colol'); // Adjust if name varies
if ($validDesa) {
    $user = User::find($validDesa->user_id);
    if ($user) {
        echo "User for Desa Colol (ID {$validDesa->user_id}): {$user->name} ({$user->email})\n";
    } else {
        echo "User ID {$validDesa->user_id} not found for Desa Colol.\n";
    }
} else {
    echo "Valid 'Desa Colol' record not found (only checked '%Colol%').\n";
}
