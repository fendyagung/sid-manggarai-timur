<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$counts = DB::table('desas')
    ->select('kecamatan', DB::raw('COUNT(*) as count'))
    ->groupBy('kecamatan')
    ->orderBy('count', 'desc')
    ->get();

echo "Counts per Kecamatan:\n";
foreach ($counts as $c) {
    echo "- \"{$c->kecamatan}\": {$c->count} records\n";
}
