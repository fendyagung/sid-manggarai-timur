<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$all = Desa::all();

$desas = $all->filter(fn($d) => str_starts_with($d->nama_desa, 'Desa '));
$kelurahans = $all->filter(fn($d) => str_starts_with($d->nama_desa, 'Kelurahan '));

echo "--- STATS ---\n";
echo "Total Records: " . $all->count() . "\n";
echo "Total Desa (prefix 'Desa '): " . $desas->count() . " (Target: 159)\n";
echo "Total Kelurahan (prefix 'Kelurahan '): " . $kelurahans->count() . " (Target: 17)\n";

echo "\n--- DUPLICATES (Same Name) ---\n";
$duplicates = DB::table('desas')
    ->select('nama_desa', DB::raw('count(*) as count'))
    ->groupBy('nama_desa')
    ->having('count', '>', 1)
    ->get();

if ($duplicates->isEmpty()) {
    echo "No exact name duplicates found.\n";
} else {
    foreach ($duplicates as $dup) {
        echo "Duplicate Found: {$dup->nama_desa} ({$dup->count} times)\n";
        $records = Desa::where('nama_desa', $dup->nama_desa)->get();
        foreach ($records as $r) {
            echo "  - ID: {$r->id} | Kec: {$r->kecamatan} | User: " . ($r->user_id ?? 'NONE') . "\n";
        }
    }
}

echo "\n--- OTHERS (No matching prefix) ---\n";
$others = $all->filter(fn($d) => !str_starts_with($d->nama_desa, 'Desa ') && !str_starts_with($d->nama_desa, 'Kelurahan '));
foreach ($others as $o) {
    echo "  - ID: {$o->id} | Nama: {$o->nama_desa} | Kec: {$o->kecamatan}\n";
}
