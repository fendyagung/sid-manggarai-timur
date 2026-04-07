<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$duplicates = DB::table('desas')
    ->select('nama_desa', 'kecamatan', DB::raw('COUNT(*) as count'))
    ->groupBy('nama_desa', 'kecamatan')
    ->having('count', '>', 1)
    ->get();

echo "Duplicate records:\n";
foreach ($duplicates as $d) {
    echo "- \"{$d->nama_desa}\" in Kec. \"{$d->kecamatan}\" ({$d->count} records)\n";
    
    // List individual record IDs for these duplicates
    $records = Desa::where('nama_desa', $d->nama_desa)
        ->where('kecamatan', $d->kecamatan)
        ->get();
    foreach ($records as $r) {
        echo "  - ID: {$r->id}, Kode: {$r->kode_desa}, Jenis: {$r->jenis}, Created At: {$r->created_at}\n";
    }
}
