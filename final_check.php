<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

echo "=== BORONG KELURAHAN ===\n";
$borong = Desa::where('kecamatan', 'Borong')->where('jenis', 'kelurahan')->get();
foreach ($borong as $b) {
    echo "ID: {$b->id} | Name: [{$b->nama_desa}]\n";
}

echo "\n=== SAMBI RAMPAS KELURAHAN ===\n";
$sr = Desa::where('kecamatan', 'Sambi Rampas')->where('jenis', 'kelurahan')->get();
foreach ($sr as $s) {
    echo "ID: {$s->id} | Name: [{$s->nama_desa}]\n";
}
