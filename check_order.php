<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$desas = Desa::withCount('laporans')->get();
echo "Total: " . $desas->count() . "\n";
echo "First 5 items:\n";
foreach ($desas->take(5) as $d) {
    echo "ID: {$d->id}, Name: {$d->nama_desa}, Kec: {$d->kecamatan}\n";
}

echo "\nSearch for Rana Loba:\n";
$target = Desa::where('nama_desa', 'LIKE', '%Rana Loba%')->first();
if ($target) {
    echo "Found! ID: {$target->id}, Full Name: {$target->nama_desa}\n";
    // Find its index in the collection
    $index = $desas->search(function ($item) use ($target) {
        return $item->id == $target->id;
    });
    echo "Position in table: " . ($index + 1) . " of 176\n";
} else {
    echo "Not found in DB!\n";
}
