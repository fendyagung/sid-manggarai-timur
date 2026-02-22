<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "--- Featured Desas (Desa Wisata) ---\n";
$featured = \App\Models\Desa::where('is_desa_wisata', true)->get();
foreach ($featured as $d) {
    echo "ID: " . $d->id . " - Nama: " . $d->nama_desa . "\n";
}

echo "\n--- Recent Reports ---\n";
$reports = \App\Models\Laporan::with('desa')->latest()->take(10)->get();
foreach ($reports as $r) {
    echo "ID: " . $r->id . " - Desa: " . ($r->desa->nama_desa ?? 'Unknown') . " - Judul: " . $r->judul . "\n";
}
