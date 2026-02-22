<?php

use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$idsToDelete = [1, 3, 4];
$count = Desa::destroy($idsToDelete);

echo "Deleted $count records (IDs: " . implode(', ', $idsToDelete) . ")\n";

echo "Final Counts:\n";
echo "Desa: " . Desa::where('jenis', 'desa')->count() . "\n";
echo "Kelurahan: " . Desa::where('jenis', 'kelurahan')->count() . "\n";
