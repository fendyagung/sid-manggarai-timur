<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$total = Desa::count();
$desaCount = Desa::where('jenis', 'desa')->count();
$kelurahanCount = Desa::where('jenis', 'kelurahan')->count();
$unknownCount = Desa::whereNull('jenis')->orWhereNotIn('jenis', ['desa', 'kelurahan'])->count();

echo "Total: $total\n";
echo "Desa: $desaCount\n";
echo "Kelurahan: $kelurahanCount\n";
echo "Unknown: $unknownCount\n";

if ($unknownCount > 0) {
    echo "\nUnknown entries:\n";
    $unknowns = Desa::whereNull('jenis')->orWhereNotIn('jenis', ['desa', 'kelurahan'])->get();
    foreach ($unknowns as $u) {
        echo "- ID: {$u->id}, Nama: {$u->nama_desa}, Jenis: " . ($u->jenis ?? 'NULL') . "\n";
    }
}
