<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Total Kecamatan: " . \App\Models\Kecamatan::count() . "\n";
echo "Total Desa/Kel: " . \App\Models\Desa::count() . "\n";
echo "Breakdown Desa: " . \App\Models\Desa::where('jenis', 'desa')->count() . "\n";
echo "Breakdown Kel: " . \App\Models\Desa::where('jenis', 'kelurahan')->count() . "\n";
