<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

echo "=== BINARY NAME DEBUG ===\n";
foreach (['Borong', 'Sambi Rampas'] as $k) {
    echo "\nKecamatan: $k\n";
    $vils = Desa::where('kecamatan', $k)->where('jenis', 'kelurahan')->get();
    foreach ($vils as $v) {
        echo "  - ID: {$v->id} | Name: [{$v->nama_desa}] | HEX: " . bin2hex($v->nama_desa) . "\n";
    }
}
