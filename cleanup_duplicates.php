<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$tables = [
    'laporans' => 'desa_id',
    'pesans' => 'desa_id',
    'potensis' => 'desa_id',
    'arsips' => 'desa_id',
    'desa_galleries' => 'desa_id',
    'users' => 'desa_id'
];

echo "=== CLEANING DUPLICATE KELURAHAN ===\n";

$duplicates = Desa::where('nama_desa', 'LIKE', 'Kelurahan %')->get();

foreach ($duplicates as $dup) {
    $cleanName = str_replace('Kelurahan ', '', $dup->nama_desa);
    $official = Desa::where('nama_desa', $cleanName)->where('kecamatan', $dup->kecamatan)->first();

    if ($official) {
        echo "Processing Duplicate: {$dup->nama_desa} -> {$official->nama_desa} in {$dup->kecamatan}\n";
        
        // Move data from duplicate to official
        foreach ($tables as $table => $column) {
            $updated = DB::table($table)->where($column, $dup->id)->update([$column => $official->id]);
            if ($updated > 0) {
                echo "  [V] Moved $updated records in table '$table'\n";
            }
        }
        
        // Special case for 'dokumens' table which uses 'receiver_desa_id'
        $docUpdated = DB::table('dokumens')->where('receiver_desa_id', $dup->id)->update(['receiver_desa_id' => $official->id]);
        if ($docUpdated > 0) {
            echo "  [V] Moved $docUpdated documents\n";
        }

        // Delete the duplicate
        $dup->delete();
        echo "  [DEL] Duplicate ID {$dup->id} deleted.\n";
    } else {
        echo "  [?] No official match for {$dup->nama_desa}. Renaming to clean name.\n";
        $dup->update(['nama_desa' => $cleanName, 'jenis' => 'kelurahan']);
    }
}

echo "\nDONE!\n";
