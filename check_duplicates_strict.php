<?php

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check for duplicates (same name AND same kecamatan)
$duplicates = Desa::select('nama_desa', 'kecamatan', DB::raw('count(*) as total'))
    ->groupBy('nama_desa', 'kecamatan')
    ->having('total', '>', 1)
    ->get();

echo "--- Strict Duplicates (Same Name & Kecamatan) ---\n";
if ($duplicates->isEmpty()) {
    echo "No strict duplicates found.\n";
}
foreach ($duplicates as $d) {
    echo "{$d->nama_desa} in {$d->kecamatan} ({$d->total})\n";
    $records = Desa::where('nama_desa', $d->nama_desa)->where('kecamatan', $d->kecamatan)->get();
    foreach ($records as $r) {
        echo " - ID: {$r->id} | Jenis: {$r->jenis}\n";
    }
}
