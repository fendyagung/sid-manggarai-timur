<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use App\Models\Laporan;

echo "Final Verification of Reports:\n";
foreach (Laporan::with('desa')->get() as $l) {
    echo "Laporan ID: {$l->id}, Title: {$l->judul}, Linked Desa: " . ($l->desa ? $l->desa->nama_desa : "MISSING (Desa ID: {$l->desa_id})") . "\n";
}

echo "\nVillage Count: " . Desa::count() . "\n";
