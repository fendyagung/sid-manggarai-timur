<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

$tables = ['laporans', 'pesans', 'potensis', 'arsips', 'desa_galleries', 'dokumens'];

foreach ($tables as $t) {
    if (Schema::hasTable($t)) {
        echo $t . ": " . implode(', ', Schema::getColumnListing($t)) . "\n";
    } else {
        echo $t . ": NOT FOUND\n";
    }
}
