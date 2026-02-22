<?php

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$counts = Desa::where('jenis', 'desa')
    ->select('kecamatan', DB::raw('count(*) as total'))
    ->groupBy('kecamatan')
    ->get();

echo "--- Desa Counts per Kecamatan ---\n";
foreach ($counts as $c) {
    echo "{$c->kecamatan}: {$c->total}\n";

    // Check against constraints
    $target = 0;
    switch ($c->kecamatan) {
        case 'Borong':
            $target = 15;
            break;
        case 'Poco Ranaka':
            $target = 21;
            break;
        case 'Lamba Leda':
            $target = 13;
            break;
        case 'Lamba Leda Utara':
            $target = 11;
            break;
        case 'Sambi Rampas':
            $target = 14;
            break;
        case 'Elar':
            $target = 14;
            break;
        case 'Kota Komba':
            $target = 19;
            break;
        case 'Rana Mese':
            $target = 21;
            break;
        case 'Poco Ranaka Timur':
            $target = 18;
            break;
        case 'Elar Selatan':
            $target = 13;
            break;
        case 'Kota Komba Utara':
            $target = 0; // Check if this exists?
    }

    if ($target > 0 && $c->total != $target) {
        echo " [MISMATCH] Target: $target, Diff: " . ($c->total - $target) . "\n";
        // List records for this kecamatan
        $recs = Desa::where('jenis', 'desa')->where('kecamatan', $c->kecamatan)->pluck('nama_desa')->toArray();
        echo "   List: " . implode(', ', $recs) . "\n";
    }
}
