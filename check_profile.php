<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = \App\Models\DpmdProfile::first();
echo "--- Database Values ---\n";
echo "ID: " . $p->id . "\n";
echo "Logo: " . $p->logo_website . "\n";
echo "Photo: " . $p->foto_kadis . "\n";

echo "\n--- Storage Checks ---\n";
$logoPath = storage_path('app/public/' . $p->logo_website);
$photoPath = storage_path('app/public/' . $p->foto_kadis);

echo "Logo File Exists: " . (file_exists($logoPath) ? "YES" : "NO") . "\n";
echo "Photo File Exists: " . (file_exists($photoPath) ? "YES" : "NO") . "\n";

echo "\n--- Public Path Checks ---\n";
$publicStoragePath = public_path('storage');
echo "Public/Storage Exists: " . (file_exists($publicStoragePath) ? "YES" : "NO") . "\n";
echo "Public/Storage is Link: " . (is_link($publicStoragePath) ? "YES" : "NO") . "\n";

if (file_exists($publicStoragePath)) {
    echo "Public/Storage Type: " . filetype($publicStoragePath) . "\n";
}
