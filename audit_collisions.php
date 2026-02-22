<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$all = Desa::all();

$names = [];
foreach ($all as $d) {
    $cleanName = str_replace(['Desa ', 'Kelurahan '], '', $d->nama_desa);
    $names[$cleanName][] = $d;
}

$output = "Name Collision Analysis (ignoring prefix):\n";
foreach ($names as $name => $records) {
    if (count($records) > 1) {
        $output .= "Collision for '$name': " . count($records) . " records\n";
        foreach ($records as $r) {
            $output .= "  - ID: {$r->id} | Full Name: {$r->nama_desa} | Kec: {$r->kecamatan}\n";
        }
    }
}

file_put_contents('collision_audit.txt', $output);
echo "Output written to collision_audit.txt\n";
