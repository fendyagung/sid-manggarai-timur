<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$totalDesa = Desa::where('jenis', 'desa')->count();
$totalKel  = Desa::where('jenis', 'kelurahan')->count();

echo "Total Desa     : $totalDesa (target: 159)" . PHP_EOL;
echo "Total Kelurahan: $totalKel (target: 17)" . PHP_EOL;
echo PHP_EOL;

$kecs = [
    'Borong', 'Congkar', 'Elar', 'Elar Selatan',
    'Kota Komba', 'Kota Komba Utara', 'Lamba Leda',
    'Lamba Leda Selatan', 'Lamba Leda Timur', 'Lamba Leda Utara',
    'Rana Mese', 'Sambi Rampas'
];

echo str_pad("Kecamatan", 24) . str_pad("Desa", 8) . "Kelurahan" . PHP_EOL;
echo str_repeat("-", 44) . PHP_EOL;

foreach ($kecs as $k) {
    $d = Desa::where('kecamatan', $k)->where('jenis', 'desa')->count();
    $l = Desa::where('kecamatan', $k)->where('jenis', 'kelurahan')->count();
    echo str_pad($k, 24) . str_pad($d, 8) . $l . PHP_EOL;
}

echo str_repeat("-", 44) . PHP_EOL;
echo str_pad("TOTAL", 24) . str_pad($totalDesa, 8) . $totalKel . PHP_EOL;

$missingDesa = 159 - $totalDesa;
$missingKel  = 17 - $totalKel;
echo PHP_EOL;
echo "Selisih Desa     : $missingDesa (positif = kurang, negatif = lebih)" . PHP_EOL;
echo "Selisih Kelurahan: $missingKel" . PHP_EOL;
