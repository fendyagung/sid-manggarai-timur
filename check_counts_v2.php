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

foreach ($counts as $c) {
    echo "Kec: {$c->kecamatan} = {$c->total}\n";
    if ($c->kecamatan == 'Lamba Leda Timur' || $c->kecamatan == 'Elar') {
        $recs = Desa::where('jenis', 'desa')->where('kecamatan', $c->kecamatan)->get();
        foreach ($recs as $r) {
            echo " - {$r->nama_desa} ({$r->id})\n";
        }
    }
}
