<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$desas = Desa::where('nama_desa', 'like', '%Ngampang Mas%')->get();
$output = "";
foreach ($desas as $d) {
    $laporans = \App\Models\Laporan::where('desa_id', $d->id)->count();
    $potensis = \App\Models\Potensi::where('desa_id', $d->id)->count();
    $output .= "ID: {$d->id} | Nama: {$d->nama_desa} | Kec: {$d->kecamatan} | User: " . ($d->user_id ?? 'NONE') . " | Laporans: $laporans | Potensis: $potensis\n";
}
file_put_contents('duplicate_output.txt', $output);
echo "Output written to duplicate_output.txt\n";


