<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$targetDesaId = 17; // ID for Ngampang Mas

echo "--- Cleaning up Reports ---\n";
// Delete all reports that are NOT for Ngampang Mas
$deletedReportsCount = \App\Models\Laporan::where('desa_id', '!=', $targetDesaId)->delete();
echo "Deleted $deletedReportsCount reports from other villages.\n";

// Ensure only ONE latest report remains for Ngampang Mas (if duplicates exist)
$ngampangReports = \App\Models\Laporan::where('desa_id', $targetDesaId)->orderBy('created_at', 'desc')->get();
if ($ngampangReports->count() > 1) {
    $toDelete = $ngampangReports->slice(1);
    foreach ($toDelete as $report) {
        $report->delete();
    }
    echo "Deleted " . $toDelete->count() . " duplicate reports for Ngampang Mas.\n";
}

echo "\n--- Cleaning up Featured Villages ---\n";
// Unmark all other villages as featured
$unmarkedCount = \App\Models\Desa::where('id', '!=', $targetDesaId)
    ->where('is_desa_wisata', true)
    ->update(['is_desa_wisata' => false]);
echo "Unmarked $unmarkedCount villages as 'Desa Wisata'.\n";

// Ensure Ngampang Mas IS featured
$ngampangDesa = \App\Models\Desa::find($targetDesaId);
if ($ngampangDesa) {
    $ngampangDesa->is_desa_wisata = true;
    $ngampangDesa->save();
    echo "Ensured Ngampang Mas (ID: $targetDesaId) is marked as Desa Wisata.\n";
}

echo "\nCleanup completed successfully.\n";
