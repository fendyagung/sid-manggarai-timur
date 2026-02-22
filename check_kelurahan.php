<?php

use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$kelurahans = Desa::where('jenis', 'kelurahan')->get();

$output = "Total Kelurahan: " . $kelurahans->count() . "\n";
foreach ($kelurahans as $index => $k) {
    $output .= ($index + 1) . ". " . $k->nama_desa . " (ID: " . $k->id . ")\n";
}

file_put_contents('kelurahan_list.txt', $output);
echo "List saved to kelurahan_list.txt";
