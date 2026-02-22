<?php

use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Borong Desa (Total " . Desa::where('jenis', 'desa')->where('kecamatan', 'Borong')->count() . ") ---\n";
$borong = Desa::where('jenis', 'desa')->where('kecamatan', 'Borong')->get();
foreach ($borong as $d) {
    echo "{$d->nama_desa} (ID: {$d->id})\n";
}

echo "\n--- Lamba Leda Timur Desa ---\n";
$llt = Desa::where('jenis', 'desa')->where('kecamatan', 'Lamba Leda Timur')->get();
foreach ($llt as $d) {
    echo "{$d->nama_desa} ({$d->kecamatan}) (ID: {$d->id})\n";
}
