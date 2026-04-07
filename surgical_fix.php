<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$tablesWithDesaId = ['laporans', 'pesans', 'potensis', 'arsips', 'desa_galleries'];

echo "=== SURGICAL DUPLICATE MERGE ===\n";

// Get all name/kecamatan combinations that have more than 1 record
$duplicates = Desa::select('nama_desa', 'kecamatan')
    ->groupBy('nama_desa', 'kecamatan')
    ->havingRaw('COUNT(*) > 1')
    ->get();

foreach ($duplicates as $dup) {
    $matches = Desa::where('nama_desa', $dup->nama_desa)
                    ->where('kecamatan', $dup->kecamatan)
                    ->orderBy('id', 'asc')
                    ->get();
    
    $target = $matches->shift(); // The lowest ID is the target
    echo "Merging duplicates for '{$dup->nama_desa}' in '{$dup->kecamatan}' (Target ID: {$target->id})\n";

    foreach ($matches as $extra) {
        echo "  - Extra ID: {$extra->id} -> Merging into {$target->id}\n";
        
        foreach ($tablesWithDesaId as $table) {
            DB::table($table)->where('desa_id', $extra->id)->update(['desa_id' => $target->id]);
        }
        DB::table('dokumens')->where('receiver_desa_id', $extra->id)->update(['receiver_desa_id' => $target->id]);
        
        $extra->delete();
        echo "  [DEL] Extra ID {$extra->id} deleted.\n";
    }
}

echo "\nSyncing Jenis (Desa vs Kelurahan) according to Image 13...\n";
$kelurahans = [
    'Borong' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
    'Elar' => ['Tiwu Kondo'],
    'Elar Selatan' => ['Lempang Paji'],
    'Kota Komba' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
    'Lamba Leda' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
    'Sambi Rampas' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras']
];

foreach ($kelurahans as $kec => $vils) {
    Desa::where('kecamatan', $kec)->whereIn('nama_desa', $vils)->update(['jenis' => 'kelurahan']);
}

echo "\nDONE!\n";
