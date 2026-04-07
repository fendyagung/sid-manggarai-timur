<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$districts = ['Borong', 'Sambi Rampas', 'Elar', 'Kota Komba'];

echo "=== DEBUGGING NAMES ===\n";
foreach ($districts as $k) {
    echo "\nKecamatan: $k\n";
    $vils = Desa::where('kecamatan', $k)->get();
    foreach ($vils as $v) {
        echo "  - ID: {$v->id} | Name: [{$v->nama_desa}] | Jenis: {$v->jenis}\n";
    }
}
