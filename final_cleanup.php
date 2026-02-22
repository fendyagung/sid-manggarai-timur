<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 1. Target Desa ID for Ngampang Mas
$targetDesaId = 17;

echo "Cleaning up data to leave only Desa ID: $targetDesaId (Ngampang Mas)\n";

// 2. Delete all reports that are NOT for Ngampang Mas
$deletedReports = \App\Models\Laporan::where('desa_id', '!=', $targetDesaId)->delete();
echo "Deleted $deletedReports reports from other villages.\n";

// 3. Keep only the LATEST report for Ngampang Mas (if multiple)
$ngampangReports = \App\Models\Laporan::where('desa_id', $targetDesaId)->orderBy('created_at', 'desc')->get();
if ($ngampangReports->count() > 1) {
    $toKeep = $ngampangReports->shift();
    foreach ($ngampangReports as $r) {
        $r->delete();
    }
    echo "Removed " . $ngampangReports->count() . " duplicate reports for Ngampang Mas, kept ID: " . $toKeep->id . ".\n";
}

// 4. Unmark all other villages as Desa Wisata (Featured)
$unmarked = \App\Models\Desa::where('id', '!=', $targetDesaId)
    ->where('is_desa_wisata', true)
    ->update(['is_desa_wisata' => false]);
echo "Unmarked $unmarked other villages as 'Featured'.\n";

// 5. Ensure Ngampang Mas IS marked as Desa Wisata
\App\Models\Desa::where('id', $targetDesaId)->update(['is_desa_wisata' => true]);
echo "Confirmed Ngampang Mas is marked as Featured.\n";

echo "\nCleanup Complete.\n";
