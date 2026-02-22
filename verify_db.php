<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$profile = \App\Models\DpmdProfile::first();
if ($profile) {
    echo "CURRENT_DATA: " . $profile->sambutan_teks;
} else {
    echo "No profile found.";
}
