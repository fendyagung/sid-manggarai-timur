<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$checks = [
    'Lamba Leda Selatan' => 'all',
    'Kota Komba Utara'   => 'all',
    'Kota Komba'         => 'all',
    'Borong'             => 'kelurahan',
    'Lamba Leda Timur'   => 'all',
    'Sambi Rampas'       => 'all',
    'Elar'               => 'kelurahan',
    'Elar Selatan'       => 'kelurahan',
];

foreach ($checks as $kec => $filter) {
    echo PHP_EOL . "=== $kec ===" . PHP_EOL;
    $q = Desa::where('kecamatan', $kec);
    if ($filter === 'kelurahan') {
        $q->where('jenis', 'kelurahan');
    }
    $recs = $q->orderBy('jenis')->orderBy('nama_desa')->get();
    foreach ($recs as $r) {
        echo "  ID={$r->id} | {$r->nama_desa} | {$r->jenis}" . PHP_EOL;
    }
    echo "  TOTAL: " . $recs->count() . PHP_EOL;
}
