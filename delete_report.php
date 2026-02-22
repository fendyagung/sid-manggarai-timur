<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$desa = \App\Models\Desa::where('nama_desa', 'LIKE', '%Golo Loni%')->first();
if ($desa) {
    echo "Desa ID: " . $desa->id . "\n";
    $laporan = \App\Models\Laporan::where('desa_id', $desa->id)->latest()->first();
    if ($laporan) {
        echo "Laporan ID: " . $laporan->id . " - Judul: " . $laporan->judul . "\n";
        $laporan->delete();
        echo "Laporan deleted successfully.\n";
    } else {
        echo "No laporan found for this desa.\n";
    }
} else {
    echo "Desa not found.\n";
}
