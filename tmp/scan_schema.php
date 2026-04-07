<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::getSchemaBuilder()->getTables();
echo "Tables with Desa/Kelurahan related columns:\n";

foreach ($tables as $table) {
    if (is_array($table)) {
        $tableName = $table['name'] ?? array_values($table)[0];
    } else {
        $tableName = $table->name ?? $table;
    }

    $columns = Schema::getColumnListing($tableName);
    foreach ($columns as $column) {
        if (in_array(strtolower($column), ['desa_id', 'receiver_desa_id', 'sender_desa_id', 'user_id'])) {
            // Note: user_id is in Desas table itself, we should be careful.
            echo "- Table: $tableName, Column: $column\n";
        }
    }
}
