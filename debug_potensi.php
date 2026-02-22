<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$desa = \App\Models\Desa::where('nama_desa', 'LIKE', '%Ngampang Mas%')->first();
if ($desa) {
    echo "Desa ID: " . $desa->id . "\n";
    echo "Desa Foto Profil: " . $desa->foto_profil . "\n";
    $potensis = \App\Models\Potensi::where('desa_id', $desa->id)->get();
    foreach ($potensis as $p) {
        echo "Potensi: " . $p->nama_potensi . " - Foto: " . $p->foto_utama . "\n";
    }
} else {
    echo "Desa not found\n";
}
