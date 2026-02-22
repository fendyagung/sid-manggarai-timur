<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$records = Desa::where('nama_desa', 'Desa Golo Nderu')->get();
$output = "Investigation for Desa Golo Nderu:\n";
foreach ($records as $r) {
    $output .= "ID: {$r->id} | Nama: {$r->nama_desa} | Kec: {$r->kecamatan} | User: " . ($r->user_id ?? 'NONE') . "\n";
}
file_put_contents('golo_nderu_audit.txt', $output);
echo "Output written to golo_nderu_audit.txt\n";
