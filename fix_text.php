<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$profile = \App\Models\DpmdProfile::first();
if ($profile) {
    $profile->sambutan_teks = str_replace('bumi Nusa Bunga', 'Kabupaten Manggarai Timur', $profile->sambutan_teks);
    $profile->save();
    echo "Update Success: " . $profile->sambutan_teks;
} else {
    echo "No profile found.";
}
