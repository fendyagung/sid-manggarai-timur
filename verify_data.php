<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$districts = ['Borong', 'Congkar', 'Elar', 'Elar Selatan', 'Kota Komba', 'Kota Komba Utara', 'Lamba Leda', 'Lamba Leda Selatan', 'Lamba Leda Timur', 'Lamba Leda Utara', 'Rana Mese', 'Sambi Rampas'];

echo "=== FINAL DATA VERIFICATION ===\n";
foreach ($districts as $k) {
    $desa = Desa::where('kecamatan', $k)->where('jenis', 'desa')->count();
    $kel = Desa::where('kecamatan', $k)->where('jenis', 'kelurahan')->count();
    echo str_pad($k, 20) . ": $desa Desa, $kel Kelurahan\n";
}
