<?php
// Script to check existing tables and create missing ones
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database simpro_desa\n\n";

    // Get all tables
    $result = $pdo->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);

    echo "Existing tables (" . count($tables) . "):\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }

    echo "\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
